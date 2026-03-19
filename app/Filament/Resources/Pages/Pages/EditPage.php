<?php

namespace App\Filament\Resources\Pages\Pages;

use App\Enums\PageType;
use App\Filament\Resources\Pages\PageResource;
use App\Filament\Resources\Pages\Schemas\HomePageForm;
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

    public function form(Schema $schema): Schema
    {
        return match ($this->record->slug) {
            'home' => HomePageForm::configure($schema),
            default => parent::form($schema),
        };
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        return match ($this->record->slug) {
            'home' => HomePageForm::mutateDataBeforeFill($data),
            default => $data,
        };
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        return match ($this->record->slug) {
            'home' => HomePageForm::mutateDataBeforeSave($data),
            default => $data,
        };
    }

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
