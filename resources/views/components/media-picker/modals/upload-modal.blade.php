@props(['uploadedFiles', 'currentFolder', 'breadcrumbs' => []])

<x-media-picker.base-modal title="{{ __('media.upload.title') }}" maxWidth="2xl">
    <div class="text-center mb-6">
        <svg class="mx-auto h-16 w-16 text-primary-400 dark:text-primary-500" fill="none" stroke="currentColor"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
        </svg>
        <h3 class="mt-2 text-lg font-medium text-gray-900 dark:text-white">{{ __('media.upload.heading') }}</h3>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
            {{ __('media.upload.upload_to') }}
            <span class="font-medium text-gray-700 dark:text-gray-300">
                @if (count($breadcrumbs) > 0)
                    {{ collect($breadcrumbs)->pluck('name')->join(' / ') }}
                @else
                    {{ __('media.root') }}
                @endif
            </span>
        </p>
    </div>

    <!-- File Upload Area -->
    <x-media-picker.form.file-input name="uploadedFiles" wire:model="uploadedFiles" multiple accept="image/*" />

    <!-- Selected Files Preview -->
    @if ($uploadedFiles)
        <div class="bg-gray-50 dark:bg-gray-800/50 rounded-lg p-4 mt-4">
            <div class="flex items-center justify-between mb-3">
                <p class="text-sm font-medium text-gray-900 dark:text-white">
                    {{ __('media.upload.files_selected', ['count' => count($uploadedFiles)]) }}
                </p>
                <x-media-picker.form.button type="button" wire:click="$set('uploadedFiles', [])" variant="secondary"
                    size="sm">
                    {{ __('media.clear') }}
                </x-media-picker.form.button>
            </div>

            <div class="grid grid-cols-3 gap-3 sm:grid-cols-4 md:grid-cols-5">
                @foreach ($uploadedFiles as $index => $file)
                    @php
                        $isImage = str_starts_with($file->getMimeType(), 'image/');
                        $fileName = $file->getClientOriginalName();
                        $fileSize = $file->getSize();
                        $fileSizeFormatted =
                            $fileSize >= 1048576
                                ? number_format($fileSize / 1048576, 1) . ' MB'
                                : number_format($fileSize / 1024, 0) . ' KB';
                    @endphp
                    <div
                        class="relative group rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 overflow-hidden">
                        {{-- Preview --}}
                        <div
                            class="aspect-square w-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center overflow-hidden">
                            @if ($isImage)
                                <img src="{{ $file->temporaryUrl() }}" alt="{{ $fileName }}"
                                    class="w-full h-full object-cover">
                            @else
                                <svg class="w-10 h-10 text-gray-400 dark:text-gray-500" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            @endif
                        </div>

                        {{-- File info --}}
                        <div class="p-1.5">
                            <p class="text-xs text-gray-700 dark:text-gray-300 font-medium truncate"
                                title="{{ $fileName }}">
                                {{ $fileName }}
                            </p>
                            <p class="text-xs text-gray-400 dark:text-gray-500">{{ $fileSizeFormatted }}</p>
                        </div>

                        {{-- Remove button --}}
                        <button type="button" wire:click="removeUploadedFile({{ $index }})"
                            wire:loading.attr="disabled"
                            class="absolute top-1 right-1 w-5 h-5 rounded-full bg-red-500 hover:bg-red-600 text-white flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-150 focus:opacity-100"
                            title="{{ __('media.delete') }}">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                @endforeach
            </div>

            <div class="flex justify-end mt-4">
                <x-media-picker.form.button type="button" wire:click="uploadFiles" variant="primary" size="sm">
                    {{ __('media.upload.upload_files_btn') }}
                </x-media-picker.form.button>
            </div>
        </div>
    @endif

    <x-slot:footer>
        <x-media-picker.form.button type="button" wire:click="closeModal" variant="secondary">
            {{ __('media.close') }}
        </x-media-picker.form.button>
    </x-slot:footer>
</x-media-picker.base-modal>
