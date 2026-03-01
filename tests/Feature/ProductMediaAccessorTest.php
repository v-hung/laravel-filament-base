<?php

use App\Models\Media;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

test('product images accessor returns normalized media data payload', function () {
    Storage::fake('public');

    $product = Product::query()->create([
        'name' => ['en' => 'Sneaker'],
        'slug' => ['en' => 'sneaker'],
        'description' => ['en' => 'Sneaker description'],
        'content' => ['en' => 'Sneaker content'],
        'price' => 120,
        'compare_at_price' => 150,
    ]);

    $media = Media::query()->create([
        'name' => 'Sneaker Hero',
        'file_name' => 'hero.jpg',
        'mime_type' => 'image/jpeg',
        'size' => 1024,
        'width' => 1200,
        'height' => 630,
        'generated_conversions' => [
            'Product_images_thumb' => [
                'file_name' => 'thumb.jpg',
                'width' => 200,
                'height' => 200,
            ],
        ],
        'custom_properties' => null,
    ]);

    $product->attachMedia($media, 'images');

    $images = $product->fresh()->images;

    expect($images)->toBeArray()->toHaveCount(1);

    $payload = $images[0];

    expect($payload)->toBeArray()->toHaveKeys([
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

    expect($payload['conversions'])->toBeArray();
    expect($payload['conversions'])->toHaveKey('thumb');
    expect($payload['conversions']['thumb'])->toMatchArray([
        'file_name' => 'thumb.jpg',
        'width' => 200,
        'height' => 200,
    ]);

    expect($payload['custom_properties'])->toMatchArray([
        'alt_text' => null,
        'caption' => null,
        'original_name' => null,
    ]);
});
