<?php

namespace App\Filament\Resources\Pages\Schemas;

use App\Filament\Forms\Components\MediaPickerInline;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AboutPageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Banner Chính')
                ->statePath('sections.hero')
                ->schema([
                    Grid::make(2)->schema([
                        MediaPickerInline::make('image_id')
                            ->label('Ảnh Banner')
                            ->folderPath('pages/about')
                            ->acceptedFileTypes(['image/*']),
                        Grid::make(1)->schema([
                            TextInput::make('title')->label('Tiêu đề')->maxLength(255),
                            Textarea::make('description')->label('Mô tả')->rows(3),
                        ]),
                    ]),
                ]),

            Section::make('Chúng Tôi Là Ai')
                ->statePath('sections.who_we_are')
                ->schema([
                    Grid::make(2)->schema([
                        MediaPickerInline::make('image_id')
                            ->label('Ảnh')
                            ->folderPath('pages/about')
                            ->acceptedFileTypes(['image/*']),
                        Grid::make(1)->schema([
                            TextInput::make('title')->label('Tiêu đề')->maxLength(255),
                            Textarea::make('description')->label('Mô tả')->rows(5),
                        ]),
                    ]),
                ]),

            Section::make('Tầm Nhìn')
                ->statePath('sections.vision')
                ->schema([
                    Grid::make(2)->schema([
                        MediaPickerInline::make('image_id')
                            ->label('Ảnh')
                            ->folderPath('pages/about')
                            ->acceptedFileTypes(['image/*']),
                        Grid::make(1)->schema([
                            TextInput::make('title')->label('Tiêu đề')->maxLength(255),
                            Textarea::make('description')->label('Mô tả')->rows(5),
                        ]),
                    ]),
                ]),

            Section::make('Sứ Mệnh')
                ->statePath('sections.mission')
                ->schema([
                    Grid::make(2)->schema([
                        MediaPickerInline::make('image_id')
                            ->label('Ảnh')
                            ->folderPath('pages/about')
                            ->acceptedFileTypes(['image/*']),
                        Grid::make(1)->schema([
                            TextInput::make('title')->label('Tiêu đề')->maxLength(255),
                            Textarea::make('description')->label('Mô tả')->rows(5),
                        ]),
                    ]),
                ]),

            Section::make('Sự Phát Triển')
                ->statePath('sections.development')
                ->schema([
                    Grid::make(2)->schema([
                        MediaPickerInline::make('image_id')
                            ->label('Ảnh')
                            ->folderPath('pages/about')
                            ->acceptedFileTypes(['image/*']),
                        Grid::make(1)->schema([
                            TextInput::make('title')->label('Tiêu đề')->maxLength(255),
                            Textarea::make('description')->label('Mô tả')->rows(5),
                        ]),
                    ]),
                ]),

            Section::make('Đội Ngũ')
                ->statePath('sections.team')
                ->schema([
                    TextInput::make('title')->label('Tiêu đề section')->maxLength(255),
                    Repeater::make('members')
                        ->label('Thành Viên')
                        ->schema([
                            Grid::make(2)->schema([
                                MediaPickerInline::make('image_id')
                                    ->label('Ảnh')
                                    ->folderPath('pages/about/team')
                                    ->acceptedFileTypes(['image/*']),
                                Grid::make(1)->schema([
                                    TextInput::make('name')->label('Tên')->maxLength(255),
                                    TextInput::make('role')->label('Chức vụ')->maxLength(255),
                                ]),
                            ]),
                        ])
                        ->addActionLabel('Thêm thành viên')
                        ->columnSpanFull(),
                ]),

            Section::make('Giá Trị Cốt Lõi')
                ->statePath('sections.core_values')
                ->schema([
                    TextInput::make('title')->label('Tiêu đề section')->maxLength(255),
                    Repeater::make('values')
                        ->label('Các Giá Trị')
                        ->schema([
                            TextInput::make('title')->label('Tiêu đề')->maxLength(255),
                            Textarea::make('description')->label('Mô tả')->rows(3),
                        ])
                        ->maxItems(4)
                        ->addActionLabel('Thêm giá trị')
                        ->columnSpanFull(),
                ]),
        ]);
    }
}
