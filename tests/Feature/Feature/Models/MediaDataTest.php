<?php

use App\Models\Media;
use Illuminate\Support\Facades\Storage;

test('it returns a normalized media payload shape', function () {
    Storage::fake('public');

    $media = Media::query()->create([
        'name' => 'Hero Banner',
        'file_name' => 'hero.jpg',
        'mime_type' => 'image/jpeg',
        'size' => 1024,
        'width' => 1200,
        'height' => 630,
        'custom_properties' => null,
    ]);

    $payload = $media->toMediaData();

    expect($payload)->toHaveKeys([
        'id',
        'name',
        'file_name',
        'url',
        'mime_type',
        'size',
        'width',
        'height',
        'dimensions',
        'custom_properties',
        'conversions',
    ]);

    expect($payload['custom_properties'])->toBe([
        'alt_text' => null,
        'caption' => null,
        'original_name' => null,
    ]);
    expect($payload['dimensions'])->toBe([1200, 630]);
    expect($payload['url'])->toEndWith('/media/'.$media->id.'/hero.jpg');
});

test('it keeps custom properties while applying default keys', function () {
    $media = Media::query()->create([
        'name' => 'Product Image',
        'file_name' => 'product.jpg',
        'mime_type' => 'image/jpeg',
        'size' => 2048,
        'custom_properties' => [
            'alt_text' => 'Sneaker product photo',
            'caption' => 'New collection',
            'credit' => 'Studio Team',
        ],
    ]);

    $payload = $media->toMediaData();

    expect($payload['custom_properties'])->toBe([
        'alt_text' => 'Sneaker product photo',
        'caption' => 'New collection',
        'original_name' => null,
        'credit' => 'Studio Team',
    ]);
    expect($payload['name'])->toBe('Product Image');
    expect($payload['file_name'])->toBe('product.jpg');
});
