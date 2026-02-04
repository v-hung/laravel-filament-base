@props(['folder', 'showDelete' => true])

<div class="relative group">
    <button wire:click="enterFolder({{ $folder->id }})"
        {{ $attributes->merge(['class' => 'w-full flex flex-col items-center p-4 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 hover:border-primary-500 dark:hover:border-primary-500 hover:shadow-md transition-all']) }}>
        <svg class="h-12 w-12 text-yellow-500 dark:text-yellow-400 mb-2" fill="currentColor" viewBox="0 0 24 24">
            <path d="M10 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2h-8l-2-2z" />
        </svg>
        <span class="text-sm font-medium text-gray-900 dark:text-white truncate w-full text-center">
            {{ $folder->name }}
        </span>
    </button>

    @if ($showDelete)
        <button wire:click.stop="confirmDeleteFolder({{ $folder->id }})"
            class="absolute top-2 right-2 p-1.5 bg-red-600 text-white rounded-full hover:bg-red-700 dark:bg-red-700 dark:hover:bg-red-600 opacity-0 group-hover:opacity-100 transition-opacity shadow-lg"
            title="Delete Folder">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                    clip-rule="evenodd" />
            </svg>
        </button>
    @endif
</div>
