<?php

namespace App\Filament\Resources\Pages\Schemas;

use App\Filament\Forms\Components\MediaPickerInline;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class HomePageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Banner Chính')
                ->statePath('sections.banner')
                ->schema([
                    MediaPickerInline::make('image_id')
                        ->label('Ảnh Banner')
                        ->folderPath('pages/home')
                        ->acceptedFileTypes(['image/*']),
                ]),

            Section::make('Về Chúng Tôi')
                ->statePath('sections.about')
                ->schema([
                    Grid::make(2)->schema([
                        MediaPickerInline::make('image_id')
                            ->label('Ảnh')
                            ->folderPath('pages/home')
                            ->acceptedFileTypes(['image/*']),
                        Grid::make(1)->schema([
                            TextInput::make('label')->label('Nhãn section')->maxLength(255),
                            TextInput::make('title')->label('Tiêu đề')->maxLength(255),
                            Textarea::make('description')->label('Mô tả')->rows(3),
                        ]),
                    ]),
                    Repeater::make('features')
                        ->label('Điểm Nổi Bật')
                        ->schema([
                            MediaPickerInline::make('image_id')
                                ->label('Ảnh')
                                ->folderPath('pages/home')
                                ->acceptedFileTypes(['image/*']),
                            TextInput::make('label')->label('Nhãn')->maxLength(255),
                        ])
                        ->columns(2)
                        ->maxItems(4)
                        ->addActionLabel('Thêm mục')
                        ->columnSpanFull(),
                ]),

            Section::make('Sản Phẩm Nổi Bật')
                ->statePath('sections.featured')
                ->schema([
                    TextInput::make('title')->label('Tiêu đề')->maxLength(255),
                    Textarea::make('description')->label('Mô tả')->rows(4),
                ]),

            Section::make('Banner Sản Xuất')
                ->statePath('sections.banner2')
                ->schema([
                    Grid::make(2)->schema([
                        MediaPickerInline::make('image_id')
                            ->label('Ảnh Banner')
                            ->folderPath('pages/home')
                            ->acceptedFileTypes(['image/*']),
                        Grid::make(1)->schema([
                            TextInput::make('title')->label('Tiêu đề')->maxLength(255),
                            Textarea::make('description')->label('Mô tả')->rows(3),
                        ]),
                    ]),
                ]),

            Section::make('Danh Mục Sản Phẩm')
                ->statePath('sections.collections')
                ->schema([
                    TextInput::make('title')->label('Tiêu đề')->maxLength(255),
                    Textarea::make('description')->label('Mô tả')->rows(4),
                ]),

            Section::make('CTA – Vì Sao Chọn Chúng Tôi')
                ->statePath('sections.cta')
                ->schema([
                    Grid::make(2)->schema([
                        MediaPickerInline::make('image_id')
                            ->label('Ảnh nền')
                            ->folderPath('pages/home')
                            ->acceptedFileTypes(['image/*']),
                        Grid::make(1)->schema([
                            TextInput::make('title')->label('Tiêu đề')->maxLength(255),
                            Textarea::make('description')->label('Mô tả')->rows(3),
                        ]),
                    ]),
                ]),

            Section::make('Cảm Hứng Trang Trí')
                ->statePath('sections.inspiration')
                ->schema([
                    TextInput::make('title')->label('Tiêu đề')->maxLength(255),
                ]),
        ]);
    }
}
