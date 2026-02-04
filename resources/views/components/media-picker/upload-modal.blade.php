@props(['uploadedFiles', 'currentFolder', 'breadcrumbs' => []])

<x-media-picker.base-modal title="Upload Files" maxWidth="2xl">
    <div class="text-center mb-6">
        <svg class="mx-auto h-16 w-16 text-primary-400 dark:text-primary-500" fill="none" stroke="currentColor"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
        </svg>
        <h3 class="mt-2 text-lg font-medium text-gray-900 dark:text-white">Upload Assets</h3>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
            Upload to:
            <span class="font-medium text-gray-700 dark:text-gray-300">
                @if (count($breadcrumbs) > 0)
                    {{ collect($breadcrumbs)->pluck('name')->join(' / ') }}
                @else
                    Root
                @endif
            </span>
        </p>
    </div>

    <!-- File Upload Area -->
    <x-media-picker.form.file-input name="uploadedFiles" wire:model="uploadedFiles" multiple accept="image/*" />

    <!-- Selected Files Preview -->
    @if ($uploadedFiles)
        <div class="bg-gray-50 dark:bg-gray-800/50 rounded-lg p-4 mt-4">
            <p class="text-sm font-medium text-gray-900 dark:text-white mb-2">{{ count($uploadedFiles) }} file(s)
                selected</p>
            <div class="flex gap-2 justify-end mt-4">
                <x-media-picker.form.button type="button" wire:click="$set('uploadedFiles', [])" variant="secondary"
                    size="sm">
                    Clear
                </x-media-picker.form.button>
                <x-media-picker.form.button type="button" wire:click="uploadFiles" variant="primary" size="sm">
                    Upload Files
                </x-media-picker.form.button>
            </div>
        </div>
    @endif

    <x-slot:footer>
        <x-media-picker.form.button type="button" wire:click="closeModal" variant="secondary">
            Close
        </x-media-picker.form.button>
    </x-slot:footer>
</x-media-picker.base-modal>
