<?php

namespace App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks;

use App\Filament\Forms\Components\MediaPicker;
use App\Models\Media;
use Filament\Actions\Action;
use Filament\Forms\Components\RichEditor\RichContentCustomBlock;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Support\Icons\Heroicon;

class TwoColumnBlock extends RichContentCustomBlock
{
    public static function getId(): string
    {
        return 'two_column';
    }

    public static function getLabel(): string
    {
        return __('filament.blocks.two_column.label');
    }

    public static function getIcon(): string
    {
        return Heroicon::TableCells->value;
    }

    public static function configureEditorAction(Action $action): Action
    {
        return $action
            ->modalWidth('2xl')
            ->schema([
                Select::make('image_position')
                    ->label(__('filament.blocks.two_column.image_position'))
                    ->options([
                        'right' => __('filament.blocks.two_column.position_right'),
                        'left' => __('filament.blocks.two_column.position_left'),
                    ])
                    ->default('right')
                    ->required(),
                TextInput::make('title')
                    ->label(__('filament.blocks.two_column.title')),
                Textarea::make('text')
                    ->label(__('filament.blocks.two_column.text'))
                    ->rows(6)
                    ->required(),
                Grid::make(1)->schema([
                    MediaPicker::make('image_id')
                        ->label(__('filament.blocks.two_column.image'))
                        ->dehydrated(true)
                        ->loadStateFromRelationshipsUsing(null)
                        ->folderPath('posts')
                        ->acceptedFileTypes(['image/*']),
                ]),
            ]);
    }

    /**
     * @param  array<string, mixed>  $config
     */
    public static function toPreviewHtml(array $config): string
    {
        return view('filament.forms.components.rich-editor.rich-content-custom-blocks.two-column.preview', [
            'title' => $config['title'] ?? '',
            'text' => $config['text'] ?? '',
            'imageUrl' => self::resolveImageUrl($config),
            'imageOnLeft' => ($config['image_position'] ?? 'right') === 'left',
        ])->render();
    }

    /**
     * @param  array<string, mixed>  $config
     * @param  array<string, mixed>  $data
     */
    public static function toHtml(array $config, array $data): string
    {
        return view('filament.forms.components.rich-editor.rich-content-custom-blocks.two-column.index', [
            'title' => $config['title'] ?? '',
            'text' => $config['text'] ?? '',
            'imageUrl' => self::resolveImageUrl($config),
            'imageAlt' => self::resolveImageAlt($config),
            'imageOnLeft' => ($config['image_position'] ?? 'right') === 'left',
        ])->render();
    }

    private static function resolveImageUrl(array $config): ?string
    {
        $mediaId = $config['image_id'] ?? null;
        if (! $mediaId) {
            return null;
        }

        return Media::find($mediaId)?->getUrl();
    }

    private static function resolveImageAlt(array $config): string
    {
        $mediaId = $config['image_id'] ?? null;
        if (! $mediaId) {
            return '';
        }

        $media = Media::find($mediaId);

        return $media?->getCustomProperty('alt_text') ?? $media?->name ?? '';
    }
}
