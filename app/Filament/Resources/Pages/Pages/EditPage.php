<?php

namespace App\Filament\Resources\Pages\Pages;

use App\Enums\PageType;
use App\Filament\Actions\AutoTranslateAction;
use App\Filament\Resources\Pages\PageResource;
use App\Filament\Resources\Pages\Schemas\AboutPageForm;
use App\Filament\Resources\Pages\Schemas\ContactPageForm;
use App\Filament\Resources\Pages\Schemas\HomePageForm;
use App\Filament\Resources\Pages\Schemas\PartnerPageForm;
use App\Filament\Resources\Pages\Schemas\ShopPageForm;
use App\Models\Page;
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

    protected function afterSave(): void
    {
        $sharedPaths = $this->getSharedSectionPaths();

        if (empty($sharedPaths)) {
            return;
        }

        static::syncSharedSections($this->record, $this->activeLocale, $sharedPaths);
    }

    /**
     * Syncs shared (non-translatable) section fields from $fromLocale to all other locales.
     *
     * @param  string[]  $sharedPaths  Dot-notation paths; supports `*` wildcard for repeater items.
     */
    public static function syncSharedSections(Page $page, string $fromLocale, array $sharedPaths): void
    {
        $page->refresh();

        $sourceSections = $page->getTranslation('sections', $fromLocale);
        $allTranslations = $page->getTranslations('sections');
        $updated = false;

        foreach ($allTranslations as $locale => $sections) {
            if ($locale === $fromLocale) {
                continue;
            }

            foreach ($sharedPaths as $path) {
                if (str_contains($path, '.*')) {
                    static::syncWildcardSectionPath($path, $sourceSections, $allTranslations[$locale]);
                } else {
                    data_set($allTranslations[$locale], $path, data_get($sourceSections, $path));
                }
            }

            $page->setTranslation('sections', $locale, $allTranslations[$locale]);
            $updated = true;
        }

        if ($updated) {
            $page->saveQuietly();
        }
    }

    /**
     * Sync a wildcard path (e.g. `features.*.image_id`) from source to target by index.
     *
     * @param  array<string, mixed>  $source
     * @param  array<string, mixed>  $target
     */
    private static function syncWildcardSectionPath(string $path, array $source, array &$target): void
    {
        [$arrayPath, $fieldPath] = explode('.*', $path, 2);
        $fieldPath = ltrim($fieldPath, '.');

        $sourceItems = data_get($source, $arrayPath, []);
        $targetItems = data_get($target, $arrayPath, []);

        foreach ($sourceItems as $index => $sourceItem) {
            if (array_key_exists($index, $targetItems)) {
                $item = $targetItems[$index];
                $item[$fieldPath] = data_get($sourceItem, $fieldPath);
                $targetItems[$index] = $item;
            }
        }

        data_set($target, $arrayPath, $targetItems);
    }

    /**
     * Returns shared (non-translatable) section field paths for the current page.
     *
     * @return string[]
     */
    private function getSharedSectionPaths(): array
    {
        $slugs = $this->record->getTranslations('slug');

        foreach ($this->pageFormMap as $slug => $formClass) {
            if (in_array($slug, $slugs, true) && method_exists($formClass, 'sharedSectionPaths')) {
                return $formClass::sharedSectionPaths();
            }
        }

        return [];
    }

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            AutoTranslateAction::make()
                ->htmlFields(['content'])
                ->jsonFields(['sections']),
            ViewAction::make(),
            DeleteAction::make()
                ->hidden(fn () => $this->record->page_type === PageType::System),
        ];
    }
}
