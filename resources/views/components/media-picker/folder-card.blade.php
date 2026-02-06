@props(['folder', 'showDelete' => true])

<div class="relative group">
    <button wire:click="navigateToFolder({{ $folder->id }})"
        {{ $attributes->merge(['class' => 'w-full flex flex-col items-center p-4 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 hover:border-primary-500 dark:hover:border-primary-500 hover:shadow-md transition-all']) }}>
        <svg class="h-12 w-12 text-yellow-500 dark:text-yellow-400 mb-2" fill="currentColor" viewBox="0 0 24 24">
            <path d="M10 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2h-8l-2-2z" />
        </svg>
        <span class="text-sm font-medium text-gray-900 dark:text-white truncate w-full text-center mb-1">
            {{ $folder->name }}
        </span>
        <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
            <span class="flex items-center gap-0.5">
                <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" />
                </svg>
                {{ $folder->children_count ?? 0 }}
            </span>
            <span class="flex items-center gap-0.5">
                <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                        clip-rule="evenodd" />
                </svg>
                {{ $folder->medias_count ?? 0 }}
            </span>
        </div>
    </button>

    @if ($showDelete)
        <div class="absolute top-2 right-2 flex gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
            <button wire:click="$dispatch('openFolderDetail', { folderId: {{ $folder->id }} })"
                class="p-1.5 bg-primary-600 text-white rounded-full hover:bg-primary-700 dark:bg-primary-700 dark:hover:bg-primary-600 shadow-lg"
                title="Folder Details">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    @endif
</div>
