<?php

namespace App\Filament\Resources\Pages\Pages;

use App\Filament\Actions\AutoTranslateAction;
use App\Filament\Resources\Pages\PageResource;
use App\Filament\Resources\Pages\Schemas\AboutPageForm;
use App\Filament\Resources\Pages\Schemas\ContactPageForm;
use App\Filament\Resources\Pages\Schemas\HomePageForm;
use App\Filament\Resources\Pages\Schemas\PartnerPageForm;
use App\Filament\Resources\Pages\Schemas\ShopPageForm;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Schemas\Schema;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use LaraZeus\SpatieTranslatable\Resources\Pages\EditRecord\Concerns\Translatable;

class EditPage extends EditRecord
{
    use Translatable;

    protected static string $resource = PageResource::class;

    /**
     * Maps a slug value to a dedicated form schema class.
     * Add entries here when a page needs its own custom form.
     *
     * @var array<string, class-string>
     */
    protected array $pageFormMap = [
        'home' => HomePageForm::class,
        'about' => AboutPageForm::class,
        'contact' => ContactPageForm::class,
        'partner' => PartnerPageForm::class,
        'shop' => ShopPageForm::class,
    ];

    public function form(Schema $schema): Schema
    {
        $slugs = $this->record->getTranslations('slug');

        foreach ($this->pageFormMap as $slug => $formClass) {
            if (in_array($slug, $slugs, true)) {
                return $formClass::configure($schema);
            }
        }

        return parent::form($schema);
    }

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            AutoTranslateAction::make()
                ->htmlFields(['content'])
                ->jsonFields(['sections']),
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
