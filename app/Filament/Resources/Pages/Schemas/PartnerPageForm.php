<?php

namespace App\Filament\Resources\Pages\Schemas;

use App\Enums\ContentStatus;
use App\Filament\Forms\Components\MediaPickerInline;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PartnerPageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Grid::make(3)->columnSpanFull()->schema([
                // Main content (left, 2/3)
                Grid::make(1)->columnSpan(2)->schema([
                    Section::make('Banner Chính')
                        ->statePath('sections.hero')
                        ->schema([
                            Grid::make(2)->schema([
                                MediaPickerInline::make('image_id')
                                    ->label('Ảnh Banner')
                                    ->folderPath('pages/partner')
                                    ->acceptedFileTypes(['image/*']),
                                Grid::make(1)->schema([
                                    TextInput::make('title')->label('Tiêu đề')->maxLength(255),
                                    Textarea::make('description')->label('Mô tả')->rows(3),
                                ]),
                            ]),
                        ]),

                    Section::make('Sự Đổi Mới')
                        ->statePath('sections.innovation')
                        ->schema([
                            Grid::make(2)->schema([
                                MediaPickerInline::make('image_id')
                                    ->label('Ảnh')
                                    ->folderPath('pages/partner')
                                    ->acceptedFileTypes(['image/*']),
                                Grid::make(1)->schema([
                                    TextInput::make('title')->label('Tiêu đề')->maxLength(255),
                                    Textarea::make('description')->label('Mô tả')->rows(5),
                                ]),
                            ]),
                        ]),

                    Section::make('Thống Kê')
                        ->statePath('sections.stats')
                        ->schema([
                            Repeater::make('items')
                                ->label('Các Chỉ Số')
                                ->schema([
                                    Grid::make(3)->schema([
                                        TextInput::make('value')->label('Giá trị (vd: 500+)')->maxLength(50),
                                        TextInput::make('unit')->label('Đơn vị (vd: years)')->maxLength(50),
                                        TextInput::make('label')->label('Nhãn mô tả')->maxLength(255),
                                    ]),
                                ])
                                ->addActionLabel('Thêm chỉ số')
                                ->columnSpanFull(),
                        ]),

                    Section::make('Định Hướng Phát Triển')
                        ->statePath('sections.direction')
                        ->schema([
                            Grid::make(2)->schema([
                                MediaPickerInline::make('image_id')
                                    ->label('Ảnh')
                                    ->folderPath('pages/partner')
                                    ->acceptedFileTypes(['image/*']),
                                Grid::make(1)->schema([
                                    TextInput::make('title')->label('Tiêu đề')->maxLength(255),
                                    Textarea::make('description')->label('Mô tả')->rows(5),
                                ]),
                            ]),
                        ]),

                    Section::make('Giá Trị Cốt Lõi')
                        ->statePath('sections.core_values')
                        ->schema([
                            TextInput::make('title')->label('Tiêu đề section')->maxLength(255),
                            Repeater::make('values')
                                ->label('Các Giá Trị')
                                ->schema([
                                    MediaPickerInline::make('image_id')
                                        ->label('Icon / Hình ảnh')
                                        ->folderPath('pages/partner')
                                        ->acceptedFileTypes(['image/*']),
                                    TextInput::make('title')->label('Tiêu đề')->maxLength(255),
                                    Textarea::make('description')->label('Mô tả')->rows(3),
                                ])
                                ->maxItems(4)
                                ->addActionLabel('Thêm giá trị')
                                ->columnSpanFull(),
                        ]),

                    Section::make('Thiết Kế & Phát Triển Sản Phẩm')
                        ->statePath('sections.design')
                        ->schema([
                            Grid::make(2)->schema([
                                MediaPickerInline::make('image_id')
                                    ->label('Ảnh')
                                    ->folderPath('pages/partner')
                                    ->acceptedFileTypes(['image/*']),
                                Grid::make(1)->schema([
                                    TextInput::make('title')->label('Tiêu đề')->maxLength(255),
                                    Textarea::make('description')->label('Mô tả')->rows(5),
                                ]),
                            ]),
                        ]),

                    Section::make('Tinh Thần Cải Tiến')
                        ->statePath('sections.improvement')
                        ->schema([
                            Grid::make(2)->schema([
                                MediaPickerInline::make('image_id')
                                    ->label('Ảnh')
                                    ->folderPath('pages/partner')
                                    ->acceptedFileTypes(['image/*']),
                                Grid::make(1)->schema([
                                    TextInput::make('title')->label('Tiêu đề')->maxLength(255),
                                    Textarea::make('description')->label('Mô tả')->rows(5),
                                    TextInput::make('button_text')->label('Text nút')->maxLength(100),
                                ]),
                            ]),
                        ]),

                    Section::make('Vật Liệu Bền Vững')
                        ->statePath('sections.materials')
                        ->schema([
                            Grid::make(2)->schema([
                                MediaPickerInline::make('image_id')
                                    ->label('Ảnh')
                                    ->folderPath('pages/partner')
                                    ->acceptedFileTypes(['image/*']),
                                Grid::make(1)->schema([
                                    TextInput::make('title')->label('Tiêu đề')->maxLength(255),
                                    Textarea::make('description')->label('Mô tả')->rows(5),
                                ]),
                            ]),
                        ]),

                    Section::make('Quy Trình Sản Xuất Tuần Hoàn')
                        ->statePath('sections.process')
                        ->schema([
                            Grid::make(2)->schema([
                                MediaPickerInline::make('image_id')
                                    ->label('Ảnh')
                                    ->folderPath('pages/partner')
                                    ->acceptedFileTypes(['image/*']),
                                Grid::make(1)->schema([
                                    TextInput::make('title')->label('Tiêu đề')->maxLength(255),
                                    Textarea::make('description')->label('Mô tả')->rows(5),
                                ]),
                            ]),
                            Repeater::make('features')
                                ->label('Các Tính Năng Quy Trình')
                                ->schema([
                                    MediaPickerInline::make('image_id')
                                        ->label('Icon / Hình ảnh')
                                        ->folderPath('pages/partner')
                                        ->acceptedFileTypes(['image/*']),
                                    TextInput::make('title')->label('Tên tính năng')->maxLength(255),
                                ])
                                ->addActionLabel('Thêm tính năng')
                                ->columnSpanFull(),
                        ]),
                ]),
                // Sidebar (right, 1/3)
                Grid::make(1)->columnSpan(1)->schema([
                    Section::make(__('filament.sections.organization'))
                        ->schema([
                            Select::make('status')
                                ->label(__('filament.fields.status'))
                                ->options(ContentStatus::class)
                                ->default(ContentStatus::Published),
                            // Select::make('page_type')
                            //     ->label(__('filament.fields.page_type'))
                            //     ->options(
                            //         fn() => Collection::make(PageType::cases())
                            //             ->reject(fn(PageType $type) => $type === PageType::System)
                            //             ->mapWithKeys(fn(PageType $type) => [$type->value => $type->getLabel()])
                            //     )
                            //     ->default(PageType::Regular)
                            //     ->helperText(__('filament.helpers.page_type')),
                        ]),
                ]),
            ]),

        ]);
    }
}
