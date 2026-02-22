@props([
    'media',
    'mode' => 'manager', // 'manager' or 'picker'
    'isSelected' => false,
    'showDelete' => true,
])

<div {{ $attributes->merge([
    'class' =>
        'relative group cursor-pointer overflow-hidden rounded-lg border bg-white shadow-sm transition-all hover:ring-2 hover:ring-primary-500 hover:shadow-md dark:bg-gray-800 dark:hover:border-primary-600' .
        ($isSelected ? ' ring-2 ring-primary-500 border-primary-500' : ' border-gray-200 dark:border-gray-700'),
]) }}
    @if ($mode === 'picker') wire:click="$dispatch('openMediaDetail', { mediaId: {{ $media->id }}, source: 'picker' })"
    @else
        wire:click="$dispatch('openMediaDetail', { mediaId: {{ $media->id }} })" @endif>

    @if ($showDelete)
        <div class="absolute left-2 top-2 z-10 opacity-0 transition-opacity group-hover:opacity-100">
            <button wire:click.stop="confirmDeleteMedia({{ $media->id }})" title="{{ __('media.delete') }}"
                class="rounded-full {{ $mode === 'picker' ? 'bg-red-600 hover:bg-red-700 dark:bg-red-700 dark:hover:bg-red-600' : 'bg-danger-600 hover:bg-danger-700 dark:bg-danger-500 dark:hover:bg-danger-600' }} p-1.5 text-white shadow-lg">
                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                        clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    @endif

    {{-- Selected Indicator for Picker Mode --}}
    @if ($mode === 'picker')
        <div class="absolute top-2 right-2 z-10">
            <button wire:click.stop="toggleSelect({{ $media->id }})"
                title="{{ $isSelected ? __('media.cancel') : __('media.picker.confirm_selection') }}"
                class="rounded-full p-1 shadow-lg transition-colors {{ $isSelected ? 'bg-primary-600 text-white dark:bg-primary-500' : 'bg-white text-gray-600 ring-1 ring-gray-200 hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:ring-gray-700/40 dark:hover:bg-gray-900/20' }}">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                        clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    @endif

    {{-- Image/Preview --}}
    <div class="aspect-4/3 flex items-center justify-center bg-gray-100 dark:bg-gray-800">
        @if (str_starts_with($media->mime_type ?? '', 'image/'))
            <img src="{{ $media->getUrl() }}" alt="{{ $media->name }}" class="h-full w-full object-cover">
        @else
            <div class="flex flex-col items-center justify-center p-4">
                <svg class="h-12 w-12 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                        clip-rule="evenodd" />
                </svg>
                <span
                    class="mt-2 text-xs text-gray-500">{{ strtoupper(pathinfo($media->file_name ?? '', PATHINFO_EXTENSION)) }}</span>
            </div>
        @endif
    </div>

    {{-- Info --}}
    <div class="bg-white p-2 dark:bg-gray-900">
        <p class="truncate text-xs font-medium text-gray-900 dark:text-white" title="{{ $media->name }}">
            {{ $media->name }}</p>
        <div class="mt-1 flex items-center justify-between">
            <span class="text-xs text-gray-500 dark:text-gray-400">{{ number_format($media->size / 1024, 1) }}
                KB</span>
            @if ($media->dimensions)
                <span
                    class="rounded bg-gray-100 px-1.5 py-0.5 text-xs text-gray-600 dark:bg-gray-800 dark:text-gray-400">{{ $media->dimensions[0] }}
                    x {{ $media->dimensions[1] }}</span>
            @endif
        </div>
    </div>

</div>
