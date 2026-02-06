<x-media-picker.base-modal title="Folder Details" maxWidth="2xl">
    <div class="text-center mb-6">
        <div class="flex h-20 w-20 items-center justify-center rounded-lg bg-primary-100 dark:bg-primary-900/30 mx-auto">
            <svg class="h-10 w-10 text-primary-600 dark:text-primary-400" fill="currentColor" viewBox="0 0 20 20">
                <path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" />
            </svg>
        </div>
        <h3 class="mt-2 text-lg font-medium text-gray-900 dark:text-white">{{ $this->detailFolderName }}</h3>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
            Location:
            <span class="font-medium text-gray-700 dark:text-gray-300">
                {{ $this->detailFolderLocation }}
            </span>
        </p>
        <div class="mt-2 flex items-center justify-center gap-4 text-sm">
            <div class="flex items-center gap-1.5 text-gray-600 dark:text-gray-400">
                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" />
                </svg>
                <span>{{ $this->detailFolderSubfoldersCount }}
                    {{ Str::plural('folder', $this->detailFolderSubfoldersCount) }}</span>
            </div>
            <div class="flex items-center gap-1.5 text-gray-600 dark:text-gray-400">
                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                        clip-rule="evenodd" />
                </svg>
                <span>{{ $this->detailFolderMediaCount }}
                    {{ Str::plural('file', $this->detailFolderMediaCount) }}</span>
            </div>
        </div>
    </div>

    <!-- Editable Fields -->
    <div class="space-y-4">
        <x-media-picker.form.input label="Folder Name" name="detailFolderName" wire:model="detailFolderName"
            placeholder="e.g. products, blog, avatars" required />
    </div>

    <!-- Delete Action -->
    <div
        class="mt-6 flex items-center justify-between rounded-lg border border-red-200 bg-red-50 p-4 dark:border-red-800/30 dark:bg-red-900/10">
        <div>
            <p class="text-sm font-medium text-gray-900 dark:text-white">Delete this folder</p>
            <p class="text-xs text-gray-500 dark:text-gray-400">Contents will be moved to parent folder</p>
        </div>
        <button wire:click="confirmDeleteDetailFolder" type="button"
            class="inline-flex items-center rounded-lg bg-red-600 px-3 py-1.5 text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
            <svg class="mr-1.5 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                    clip-rule="evenodd" />
            </svg>
            Delete
        </button>
    </div>

    <x-slot:footer>
        <x-media-picker.form.button type="button" wire:click="saveFolderDetails" variant="primary">
            Save Changes
        </x-media-picker.form.button>
        <x-media-picker.form.button type="button" wire:click="closeModal" variant="secondary">
            Cancel
        </x-media-picker.form.button>
    </x-slot:footer>
</x-media-picker.base-modal>
