@props([
    'folders' => collect(),
    'mediaItems',
    'variant' => 'manager',
    'selected' => [],
    'breadcrumbs' => [],
])
<div class="space-y-6">
    @if (count($breadcrumbs) > 0)
        <div class="mb-4 flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
            <button wire:click="{{ $variant === 'picker' ? 'navigateToFolder(null)' : 'goToRootFolder' }}"
                class="hover:text-primary-600 dark:hover:text-primary-400 transition-colors">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
            </button>

            @foreach ($breadcrumbs as $crumb)
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <button
                    wire:click="{{ $variant === 'picker' ? 'navigateToFolder(' . $crumb['id'] . ')' : 'enterFolder(' . $crumb['id'] . ')' }}"
                    class="hover:text-primary-600 dark:hover:text-primary-400 transition-colors font-medium">
                    {{ $crumb['name'] }}
                </button>
            @endforeach
        </div>
    @endif

    <div class="mb-4 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex flex-1 flex-wrap gap-3">
            <div class="flex-1 min-w-62.5 max-w-md">
                <label for="media-browser-search" class="sr-only">{{ __('media.manager.search_label') }}</label>
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="text" wire:model.live.debounce.300ms="search" id="media-browser-search"
                        class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 pl-10 text-sm shadow-sm transition-colors focus:border-primary-500 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-400 outline-none"
                        placeholder="{{ __('media.search_placeholder') }}">
                </div>
            </div>
        </div>

        <div class="flex flex-wrap gap-2">
            <button wire:click="{{ $variant === 'picker' ? 'openCreateFolderModal' : 'openFolderCreator' }}"
                class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 shadow-sm transition-colors hover:bg-gray-50 focus:ring-2 focus:ring-gray-500/20 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                </svg>
                {{ $variant === 'picker' ? __('media.picker.new_folder') : __('media.manager.add_folder') }}
            </button>

            <button wire:click="{{ $variant === 'picker' ? 'openUploadModal' : 'openAssetUploader' }}"
                class="inline-flex items-center gap-2 rounded-lg bg-primary-600 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition-colors hover:bg-primary-700 focus:ring-2 focus:ring-primary-500/20">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                {{ $variant === 'picker' ? __('media.picker.upload_files') : __('media.manager.add_asset') }}
            </button>
        </div>
    </div>

    @if (count($folders) === 0 && $mediaItems->count() === 0)
        <div
            class="rounded-lg border border-dashed border-gray-300 bg-gray-50 py-16 text-center dark:border-gray-600 dark:bg-gray-800/50">
            <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">{{ __('media.no_media_found') }}</p>
            <p class="text-xs text-gray-400 dark:text-gray-500">{{ __('media.manager.empty_hint') }}</p>
        </div>
    @else
        @if (count($folders) > 0)
            <div class="mb-6">
                <h3 class="mb-3 text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('media.manager.folders') }}
                </h3>
                <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6">
                    @foreach ($folders as $folder)
                        <x-media-picker.folder-card :folder="$folder" />
                    @endforeach
                </div>
            </div>
        @endif

        @if ($mediaItems->count() > 0)
            <div @if (count($folders) > 0) class="border-t border-gray-200 pt-6 dark:border-gray-700" @endif>
                <h3 class="mb-3 text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('media.manager.files') }}
                </h3>
                <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6">
                    @foreach ($mediaItems as $media)
                        @if ($variant === 'picker')
                            <x-media-picker.media-card :media="$media" mode="picker" :isSelected="in_array($media->id, $selected)" />
                        @else
                            <x-media-picker.media-card :media="$media" mode="manager" />
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
    @endif

    @if ($mediaItems->hasPages())
        <div class="mt-6 flex justify-center">
            {{ $mediaItems->links() }}
        </div>
    @endif

    @if ($mediaItems->count() > 0)
        <div class="mt-6 border-t border-gray-200 pt-6 text-sm text-gray-600 dark:border-gray-700 dark:text-gray-400">
            {{ __('media.manager.showing') }} <span
                class="font-medium text-gray-900 dark:text-white">{{ $mediaItems->firstItem() ?? 0 }}</span>
            {{ __('media.manager.to') }}
            <span class="font-medium text-gray-900 dark:text-white">{{ $mediaItems->lastItem() ?? 0 }}</span>
            {{ __('media.manager.of') }}
            <span class="font-medium text-gray-900 dark:text-white">{{ $mediaItems->total() }}</span>
            {{ __('media.manager.results') }}
        </div>
    @endif
</div>
