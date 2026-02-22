<?php

use App\Livewire\MediaPickerModal;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

beforeEach(function () {
    Storage::fake('public');
    $this->actingAs(User::factory()->create());
});

test('can remove an uploaded file by index', function () {
    $fileA = UploadedFile::fake()->image('photo-a.jpg');
    $fileB = UploadedFile::fake()->image('photo-b.png');
    $fileC = UploadedFile::fake()->image('photo-c.gif');

    Livewire::test(MediaPickerModal::class)
        ->set('uploadedFiles', [$fileA, $fileB, $fileC])
        ->call('removeUploadedFile', 1)
        ->assertSet('uploadedFiles', fn ($files) => count($files) === 2);
});

test('removes the correct file when removing by index', function () {
    $fileA = UploadedFile::fake()->image('photo-a.jpg');
    $fileB = UploadedFile::fake()->image('photo-b.png');

    Livewire::test(MediaPickerModal::class)
        ->set('uploadedFiles', [$fileA, $fileB])
        ->call('removeUploadedFile', 0)
        ->assertSet('uploadedFiles', fn ($files) => count($files) === 1);
});

test('clearing all uploaded files resets the array', function () {
    $fileA = UploadedFile::fake()->image('photo-a.jpg');
    $fileB = UploadedFile::fake()->image('photo-b.png');

    Livewire::test(MediaPickerModal::class)
        ->set('uploadedFiles', [$fileA, $fileB])
        ->set('uploadedFiles', [])
        ->assertSet('uploadedFiles', []);
});

test('single mode can toggle selected media off', function () {
    Livewire::test(MediaPickerModal::class, ['multiple' => false])
        ->call('toggleSelect', 123)
        ->assertSet('selected', [123])
        ->call('toggleSelect', 123)
        ->assertSet('selected', []);
});
