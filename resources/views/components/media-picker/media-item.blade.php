<div wire:click="toggleSelect({{ $media->id }})"
    class="relative group cursor-pointer bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden hover:ring-2 hover:ring-primary-500 dark:hover:ring-primary-400 transition-all @if ($isSelected) ring-primary-500 dark:ring-primary-400 ring-2 @endif">

    <!-- Checkbox -->
    @if ($isSelected)
        <div class="absolute top-2 right-2 z-10">
            <div class="bg-primary-600 dark:bg-primary-500 text-white rounded-full p-1">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                        clip-rule="evenodd" />
                </svg>
            </div>
        </div>
    @endif

    <!-- Image -->
    <div class="aspect-4/3 bg-gray-100 dark:bg-gray-900 flex items-center justify-center">
        @if (str_starts_with($media->mime_type ?? '', 'image/'))
            <img src="{{ $media->getUrl() }}" alt="{{ $media->name }}" class="w-full h-full object-cover">
        @else
            <svg class="w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                    clip-rule="evenodd" />
            </svg>
        @endif
    </div>

    <!-- Info -->
    <div class="p-2 bg-white dark:bg-gray-900">
        <p class="text-xs font-medium text-gray-900 dark:text-white truncate">{{ $media->name }}</p>
        <p class="text-xs text-gray-500 dark:text-gray-400">{{ number_format($media->size / 1024, 2) }} KB</p>
    </div>

    <!-- Hover Actions -->
    <div
        class="absolute inset-0 bg-black/60 transition-all flex items-center justify-center opacity-0 group-hover:opacity-100">
        <button wire:click.stop="deleteMedia({{ $media->id }})"
            class="p-2 bg-red-600 text-white rounded-full hover:bg-red-700 mr-2">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                    clip-rule="evenodd" />
            </svg>
        </button>
    </div>
</div>
