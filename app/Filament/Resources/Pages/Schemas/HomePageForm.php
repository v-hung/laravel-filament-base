<?php

namespace App\Filament\Resources\Pages\Schemas;

use App\Filament\Forms\Components\MediaPicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class HomePageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Banner Chính')->schema([
                MediaPicker::make('banner')
                    ->label('Ảnh Banner')
                    ->folderPath('pages/home')
                    ->acceptedFileTypes(['image/*']),
            ])->columnSpanFull(),

            Section::make('Về Chúng Tôi')->schema([
                MediaPicker::make('about_image')
                    ->label('Ảnh')
                    ->folderPath('pages/home')
                    ->acceptedFileTypes(['image/*']),
            ])->columnSpanFull(),

            Section::make('Sản Phẩm Nổi Bật')->schema([
                TextInput::make('featured_title')
                    ->label('Tiêu đề')
                    ->maxLength(255),
                Textarea::make('featured_description')
                    ->label('Mô tả')
                    ->rows(4),
            ])->columnSpanFull(),

            Section::make('Banner Sản Xuất')->schema([
                MediaPicker::make('banner2')
                    ->label('Ảnh Banner')
                    ->folderPath('pages/home')
                    ->acceptedFileTypes(['image/*']),
                TextInput::make('banner2_title')
                    ->label('Tiêu đề')
                    ->maxLength(255),
                Textarea::make('banner2_description')
                    ->label('Mô tả')
                    ->rows(4),
            ])->columnSpanFull(),

            Section::make('Danh Mục Sản Phẩm')->schema([
                TextInput::make('collections_title')
                    ->label('Tiêu đề')
                    ->maxLength(255),
                Textarea::make('collections_description')
                    ->label('Mô tả')
                    ->rows(4),
            ])->columnSpanFull(),

            Section::make('CTA – Vì Sao Chọn Chúng Tôi')->schema([
                MediaPicker::make('cta')
                    ->label('Ảnh nền')
                    ->folderPath('pages/home')
                    ->acceptedFileTypes(['image/*']),
                TextInput::make('cta_title')
                    ->label('Tiêu đề')
                    ->maxLength(255),
                Textarea::make('cta_description')
                    ->label('Mô tả')
                    ->rows(4),
            ])->columnSpanFull(),

            Section::make('Cảm Hứng Trang Trí')->schema([
                TextInput::make('inspiration_title')
                    ->label('Tiêu đề')
                    ->maxLength(255),
            ])->columnSpanFull(),
        ]);
    }

    /**
     * Flatten sections JSON into top-level keys for the form.
     */
    public static function mutateDataBeforeFill(array $data): array
    {
        $sections = $data['sections'] ?? [];

        foreach (self::sectionKeys() as $section => $keys) {
            foreach ($keys as $key) {
                $data["{$section}_{$key}"] = $sections[$section][$key] ?? null;
            }
        }

        unset($data['sections']);

        return $data;
    }

    /**
     * Restructure flat form keys back into sections JSON before save.
     */
    public static function mutateDataBeforeSave(array $data): array
    {
        $sections = [];

        foreach (self::sectionKeys() as $section => $keys) {
            foreach ($keys as $key) {
                $flatKey = "{$section}_{$key}";
                $sections[$section][$key] = $data[$flatKey] ?? null;
                unset($data[$flatKey]);
            }
        }

        $data['sections'] = $sections;

        return $data;
    }

    private static function sectionKeys(): array
    {
        return [
            'featured' => ['title', 'description'],
            'banner2' => ['title', 'description'],
            'collections' => ['title', 'description'],
            'cta' => ['title', 'description'],
            'inspiration' => ['title'],
        ];
    }
}
