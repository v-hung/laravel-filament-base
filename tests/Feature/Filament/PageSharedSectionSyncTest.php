<?php

use App\Enums\ContentStatus;
use App\Filament\Resources\Pages\Pages\EditPage;
use App\Filament\Resources\Pages\Schemas\AboutPageForm;
use App\Filament\Resources\Pages\Schemas\HomePageForm;
use App\Models\Page;
use App\Models\User;
use Filament\Facades\Filament;
use Livewire\Livewire;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

use function Pest\Laravel\actingAs;

function createPageAdminUser(): User
{
    app()[PermissionRegistrar::class]->forgetCachedPermissions();

    $actions = ['View', 'ViewAny', 'Create', 'Update', 'Delete', 'Restore', 'ForceDelete', 'ForceDeleteAny', 'RestoreAny', 'Replicate', 'Reorder'];

    $permissions = [];
    foreach ($actions as $action) {
        $permissions[] = Permission::firstOrCreate([
            'name' => "{$action}:Page",
            'guard_name' => 'web',
        ]);
    }

    $role = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
    $role->givePermissionTo($permissions);

    $user = User::factory()->create(['is_admin' => true]);
    $user->assignRole($role);

    return $user;
}

function makeHomePage(array $localeOverrides = []): Page
{
    $page = new Page;
    $page->status = ContentStatus::Published;

    $defaultSections = [
        'banner' => ['image_id' => 1],
        'about' => ['image_id' => 10, 'title' => 'About'],
        'banner2' => ['image_id' => 2],
        'cta' => ['image_id' => 3],
        'inspiration' => ['title' => 'Inspiration', 'image_ids' => [100, 101]],
    ];

    foreach (['en', 'vi', 'zh'] as $locale) {
        $page->setTranslation('title', $locale, 'Home');
        $page->setTranslation('slug', $locale, 'home');
        $page->setTranslation('sections', $locale, $localeOverrides[$locale] ?? $defaultSections);
    }

    $page->save();

    return $page;
}

beforeEach(function () {
    session()->flush();
    actingAs(createPageAdminUser());
    Filament::setCurrentPanel(Filament::getPanel('admin'));
});

it('can mount the edit page component for home page', function () {
    $page = makeHomePage();

    Livewire::test(EditPage::class, ['record' => $page->getRouteKey()])
        ->assertSuccessful();
});

it('syncs flat shared image fields from EN to all other locales via Livewire save', function () {
    $page = makeHomePage();

    $newSections = [
        'banner' => ['image_id' => 99],
        'about' => ['image_id' => 88, 'title' => 'About EN'],
        'banner2' => ['image_id' => 66],
        'cta' => ['image_id' => 55],
        'inspiration' => ['title' => 'Inspiration EN', 'image_ids' => [200, 201]],
    ];

    Livewire::test(EditPage::class, ['record' => $page->getRouteKey()])
        ->fillForm(['sections' => $newSections])
        ->call('save')
        ->assertHasNoFormErrors();

    $page->refresh();

    foreach (['vi', 'zh'] as $locale) {
        $sections = $page->getTranslation('sections', $locale);

        expect($sections['banner']['image_id'])->toBe(99)
            ->and($sections['about']['image_id'])->toBe(88)
            ->and($sections['banner2']['image_id'])->toBe(66)
            ->and($sections['cta']['image_id'])->toBe(55)
            ->and($sections['inspiration']['image_ids'])->toBe([200, 201]);
    }
});

// Direct unit tests for syncSharedSections (bypasses Livewire/Filament internals)

it('syncSharedSections syncs flat image fields from source locale to others', function () {
    $page = makeHomePage([
        'en' => [
            'banner' => ['image_id' => 99],
            'about' => ['image_id' => 88, 'title' => 'About EN'],
            'banner2' => ['image_id' => 66],
            'cta' => ['image_id' => 55],
            'inspiration' => ['title' => 'Inspiration EN', 'image_ids' => [200, 201]],
        ],
        'vi' => [
            'banner' => ['image_id' => 1],
            'about' => ['image_id' => 10, 'title' => 'About VI'],
            'banner2' => ['image_id' => 2],
            'cta' => ['image_id' => 3],
            'inspiration' => ['title' => 'Inspiration VI', 'image_ids' => [100, 101]],
        ],
        'zh' => [
            'banner' => ['image_id' => 1],
            'about' => ['image_id' => 10, 'title' => 'About ZH'],
            'banner2' => ['image_id' => 2],
            'cta' => ['image_id' => 3],
            'inspiration' => ['title' => 'Inspiration ZH', 'image_ids' => [100, 101]],
        ],
    ]);

    EditPage::syncSharedSections($page, 'en', HomePageForm::sharedSectionPaths());

    $page->refresh();

    foreach (['vi', 'zh'] as $locale) {
        $sections = $page->getTranslation('sections', $locale);

        expect($sections['banner']['image_id'])->toBe(99)
            ->and($sections['about']['image_id'])->toBe(88)
            ->and($sections['banner2']['image_id'])->toBe(66)
            ->and($sections['cta']['image_id'])->toBe(55)
            ->and($sections['inspiration']['image_ids'])->toBe([200, 201]);
    }
});

it('syncSharedSections does not overwrite non-shared text fields in other locales', function () {
    $page = makeHomePage([
        'en' => [
            'banner' => ['image_id' => 99],
            'about' => ['image_id' => 88, 'title' => 'About EN'],
            'inspiration' => ['title' => 'Inspiration EN', 'image_ids' => [200, 201]],
        ],
        'vi' => [
            'banner' => ['image_id' => 1],
            'about' => ['image_id' => 10, 'title' => 'About VI'],
            'inspiration' => ['title' => 'Inspiration VI', 'image_ids' => [100, 101]],
        ],
        'zh' => [
            'banner' => ['image_id' => 1],
            'about' => ['image_id' => 10, 'title' => 'About ZH'],
            'inspiration' => ['title' => 'Inspiration ZH', 'image_ids' => [100, 101]],
        ],
    ]);

    EditPage::syncSharedSections($page, 'en', HomePageForm::sharedSectionPaths());

    $page->refresh();

    // Image fields synced
    expect($page->getTranslation('sections', 'vi')['banner']['image_id'])->toBe(99)
        ->and($page->getTranslation('sections', 'vi')['about']['image_id'])->toBe(88)
        ->and($page->getTranslation('sections', 'vi')['inspiration']['image_ids'])->toBe([200, 201]);

    // Text fields untouched
    expect($page->getTranslation('sections', 'vi')['about']['title'])->toBe('About VI')
        ->and($page->getTranslation('sections', 'vi')['inspiration']['title'])->toBe('Inspiration VI')
        ->and($page->getTranslation('sections', 'zh')['about']['title'])->toBe('About ZH');
});

it('syncSharedSections syncs repeater image fields by index without overwriting other fields', function () {
    $page = makeHomePage([
        'en' => [
            'about' => [
                'image_id' => 10,
                'features' => [
                    ['image_id' => 77, 'label' => 'Feature EN'],
                    ['image_id' => 88, 'label' => 'Feature 2 EN'],
                ],
            ],
        ],
        'vi' => [
            'about' => [
                'image_id' => 10,
                'features' => [
                    ['image_id' => 20, 'label' => 'Feature VI'],
                    ['image_id' => 30, 'label' => 'Feature 2 VI'],
                ],
            ],
        ],
        'zh' => [
            'about' => [
                'image_id' => 10,
                'features' => [
                    ['image_id' => 20, 'label' => 'Feature ZH'],
                ],
            ],
        ],
    ]);

    EditPage::syncSharedSections($page, 'en', HomePageForm::sharedSectionPaths());

    $page->refresh();

    $viSections = $page->getTranslation('sections', 'vi');
    $zhSections = $page->getTranslation('sections', 'zh');

    // Repeater image_id synced by index
    expect($viSections['about']['features'][0]['image_id'])->toBe(77)
        ->and($viSections['about']['features'][1]['image_id'])->toBe(88);

    // Labels untouched
    expect($viSections['about']['features'][0]['label'])->toBe('Feature VI')
        ->and($viSections['about']['features'][1]['label'])->toBe('Feature 2 VI');

    // ZH only has 1 item — only index 0 synced, no index 1
    expect($zhSections['about']['features'][0]['image_id'])->toBe(77)
        ->and($zhSections['about']['features'][0]['label'])->toBe('Feature ZH');
});

it('sharedSectionPaths contains expected paths for home page', function () {
    expect(HomePageForm::sharedSectionPaths())
        ->toContain('banner.image_id')
        ->toContain('about.image_id')
        ->toContain('about.features.*.image_id')
        ->toContain('banner2.image_id')
        ->toContain('cta.image_id')
        ->toContain('inspiration.image_ids');
});

it('sharedSectionPaths contains expected paths for about page', function () {
    expect(AboutPageForm::sharedSectionPaths())
        ->toContain('hero.image_id')
        ->toContain('who_we_are.image_id')
        ->toContain('vision.image_id')
        ->toContain('mission.image_id')
        ->toContain('development.image_id')
        ->toContain('team.members.*.image_id')
        ->toContain('core_values.values.*.image_id');
});
