<?php

use App\Filament\Resources\Menus\MenuResource;
use App\Filament\Resources\Menus\Pages\CreateMenu;
use App\Filament\Resources\Menus\Pages\EditMenu;
use App\Filament\Resources\Menus\Pages\ListMenus;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\User;
use Filament\Facades\Filament;
use Livewire\Livewire;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

use function Pest\Laravel\actingAs;

function createAdminUser(): User
{
    app()[PermissionRegistrar::class]->forgetCachedPermissions();

    $resources = ['Menu', 'MenuItem'];
    $actions = ['View', 'ViewAny', 'Create', 'Update', 'Delete', 'Restore', 'ForceDelete', 'ForceDeleteAny', 'RestoreAny', 'Replicate', 'Reorder'];

    $permissions = [];
    foreach ($resources as $resource) {
        foreach ($actions as $action) {
            $permissions[] = Permission::firstOrCreate([
                'name' => "{$action}:{$resource}",
                'guard_name' => 'web',
            ]);
        }
    }

    $role = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
    $role->syncPermissions($permissions);

    $user = User::factory()->create(['is_admin' => true]);
    $user->assignRole($role);

    return $user;
}

beforeEach(function () {
    actingAs(createAdminUser());
    Filament::setCurrentPanel(Filament::getPanel('admin'));
});

it('can render the menu list page', function () {
    $this->get(MenuResource::getUrl('index'))->assertSuccessful();
});

it('can render the create menu page', function () {
    $this->get(MenuResource::getUrl('create'))->assertSuccessful();
});

it('can create a menu', function () {
    Livewire::test(CreateMenu::class)
        ->set('data.name', 'Header Menu')
        ->set('data.slug', 'header')
        ->call('create')
        ->assertHasNoFormErrors();

    $this->assertDatabaseHas(Menu::class, [
        'slug' => 'header',
    ]);
});

it('validates required fields when creating a menu', function () {
    Livewire::test(CreateMenu::class)
        ->fillForm([
            'name' => null,
            'slug' => null,
        ])
        ->call('create')
        ->assertHasFormErrors([
            'name' => 'required',
            'slug' => 'required',
        ]);
});

it('validates slug is unique when creating a menu', function () {
    Menu::factory()->create(['slug' => 'header']);

    Livewire::test(CreateMenu::class)
        ->set('data.name', 'Another Header')
        ->set('data.slug', 'header')
        ->call('create')
        ->assertHasFormErrors(['slug']);
});

it('can render the edit menu page', function () {
    $menu = Menu::factory()->create();

    $this->get(MenuResource::getUrl('edit', ['record' => $menu]))->assertSuccessful();
});

it('can update a menu', function () {
    $menu = Menu::factory()->create(['slug' => 'header']);

    Livewire::test(EditMenu::class, ['record' => $menu->getRouteKey()])
        ->set('data.name', 'Updated Header')
        ->set('data.slug', 'header')
        ->call('save')
        ->assertHasNoFormErrors();

    $this->assertDatabaseHas(Menu::class, [
        'id' => $menu->id,
        'slug' => 'header',
    ]);
});

it('can list menus in the table', function () {
    $menus = Menu::factory()->count(3)->create();

    Livewire::test(ListMenus::class)
        ->assertCanSeeTableRecords($menus);
});

it('saves menu items via the menu builder when editing', function () {
    $menu = Menu::factory()->create();

    $items = [
        [
            'id' => null,
            'temp_id' => 'new_001',
            'parent_temp_id' => null,
            'title' => 'Home',
            'title_locale' => 'en',
            'title_translations' => ['en' => 'Home', 'vi' => 'Trang chủ'],
            'type' => 'custom',
            'linkable_type' => null,
            'linkable_id' => null,
            'url' => '/',
            'target' => '_self',
            'icon' => '',
            'depth' => 0,
            'is_active' => true,
        ],
        [
            'id' => null,
            'temp_id' => 'new_002',
            'parent_temp_id' => null,
            'title' => 'About',
            'title_locale' => 'en',
            'title_translations' => ['en' => 'About'],
            'type' => 'custom',
            'linkable_type' => null,
            'linkable_id' => null,
            'url' => '/about',
            'target' => '_blank',
            'icon' => '',
            'depth' => 0,
            'is_active' => true,
        ],
        [
            'id' => null,
            'temp_id' => 'new_003',
            'parent_temp_id' => 'new_002',
            'title' => 'Team',
            'title_locale' => 'en',
            'title_translations' => [],
            'type' => 'custom',
            'linkable_type' => null,
            'linkable_id' => null,
            'url' => '/about/team',
            'target' => '_self',
            'icon' => '',
            'depth' => 1,
            'is_active' => true,
        ],
    ];

    Livewire::test(EditMenu::class, ['record' => $menu->getRouteKey()])
        ->set('data.menu_items', $items)
        ->call('save')
        ->assertHasNoFormErrors();

    expect($menu->fresh()->items()->count())->toBe(3);

    $home = $menu->items()->where('url', '/')->first();
    expect($home)->not->toBeNull();
    expect($home->parent_id)->toBeNull();
    expect($home->sort_order)->toBe(0);
    expect($home->getTranslation('title', 'en'))->toBe('Home');
    expect($home->getTranslation('title', 'vi'))->toBe('Trang chủ');

    $about = $menu->items()->where('url', '/about')->first();
    expect($about->target)->toBe('_blank');
    expect($about->getTranslation('title', 'en'))->toBe('About');

    $team = $menu->items()->where('url', '/about/team')->first();
    expect($team->parent_id)->toBe($about->id);
    // title_translations was empty; active locale (en) title should be saved
    expect($team->getTranslation('title', 'en'))->toBe('Team');
});

it('loads existing menu items into the menu builder on edit', function () {
    $menu = Menu::factory()->create();
    $parent = MenuItem::factory()->for($menu)->create([
        'title' => ['en' => 'Home', 'vi' => 'Trang chủ'],
        'url' => '/',
        'sort_order' => 0,
    ]);
    MenuItem::factory()->for($menu)->create([
        'parent_id' => $parent->id,
        'title' => ['en' => 'Sub Page', 'vi' => 'Trang con'],
        'url' => '/sub',
        'sort_order' => 1,
    ]);

    $component = Livewire::test(EditMenu::class, ['record' => $menu->getRouteKey()]);

    $state = $component->get('data.menu_items');

    expect($state)->toHaveCount(2);
    expect($state[0]['depth'])->toBe(0);
    expect($state[0]['parent_temp_id'])->toBeNull();
    expect($state[0]['title_translations'])->toBe(['en' => 'Home', 'vi' => 'Trang chủ']);
    expect($state[0]['title_locale'])->toBe('en');
    expect($state[1]['depth'])->toBe(1);
    expect($state[1]['url'])->toBe('/sub');
    expect($state[1]['parent_temp_id'])->toBe('item_'.$parent->id);
    expect($state[1]['title_translations'])->toBe(['en' => 'Sub Page', 'vi' => 'Trang con']);
    expect($state[1]['title_locale'])->toBe('en');
});

it('can store a child menu item directly', function () {
    $menu = Menu::factory()->create();
    $parent = MenuItem::factory()->for($menu)->create(['title' => ['en' => 'Parent', 'vi' => 'Cha']]);
    $child = MenuItem::factory()->for($menu)->create([
        'parent_id' => $parent->id,
        'title' => ['en' => 'Child', 'vi' => 'Con'],
        'url' => '/child',
    ]);

    $this->assertDatabaseHas(MenuItem::class, [
        'menu_id' => $menu->id,
        'parent_id' => $parent->id,
        'url' => '/child',
    ]);

    expect($child->parent->id)->toBe($parent->id);
    expect($parent->children()->count())->toBe(1);
});
