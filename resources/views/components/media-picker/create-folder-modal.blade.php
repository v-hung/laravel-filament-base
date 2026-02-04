<x-media-picker.base-modal title="Create New Folder" maxWidth="lg">
  <div class="text-center mb-6">
    <svg class="mx-auto h-16 w-16 text-primary-400 dark:text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
    </svg>
    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Enter a name for your new collection/folder</p>
  </div>

  <div>
    <label for="folderName" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Folder Name</label>
    <input type="text" id="folderName" wire:model="newFolderName" placeholder="e.g. products, blog, avatars"
      class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full px-4 py-2.5 sm:text-sm border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400">
    @error('newFolderName')
      <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
  </div>

  <x-slot:footer>
    <button type="button" wire:click="createFolder"
      class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary-600 text-base font-medium text-white hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:focus:ring-offset-gray-800 sm:ml-3 sm:w-auto sm:text-sm">
      Create Folder
    </button>
    <button type="button" wire:click="closeModal"
      class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-700 text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:focus:ring-offset-gray-800 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
      Cancel
    </button>
  </x-slot:footer>
</x-media-picker.base-modal>
