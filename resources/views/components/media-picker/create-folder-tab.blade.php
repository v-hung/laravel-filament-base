<div class="max-w-md mx-auto py-12">
  <div class="text-center mb-6">
    <svg class="mx-auto h-16 w-16 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
    </svg>
    <h3 class="mt-2 text-lg font-medium text-gray-900">Create New Folder</h3>
    <p class="mt-1 text-sm text-gray-500">Enter a name for your new collection/folder</p>
  </div>

  <div class="space-y-4">
    <div>
      <label for="folderName" class="block text-sm font-medium text-gray-700 mb-2">Folder Name</label>
      <input type="text" id="folderName" wire:model="newFolderName" placeholder="e.g. products, blog, avatars"
        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
      @error('newFolderName')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
      @enderror
    </div>

    <div class="flex gap-2 justify-end">
      <button type="button" wire:click="switchView('browse')"
        class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
        Cancel
      </button>
      <button type="button" wire:click="createFolder"
        class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700">
        Create Folder
      </button>
    </div>
  </div>
</div>
