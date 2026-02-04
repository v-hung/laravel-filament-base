<x-media-picker.base-modal title="Upload Files" maxWidth="2xl">
  <div class="text-center mb-6">
    <svg class="mx-auto h-16 w-16 text-primary-400 dark:text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
    </svg>
    <h3 class="mt-2 text-lg font-medium text-gray-900 dark:text-white">Upload Assets</h3>
    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
      @if ($currentFolder)
        Upload to folder: <span class="font-medium dark:text-gray-300">{{ $currentFolder }}</span>
      @else
        Select files to upload
      @endif
    </p>
  </div>

  <!-- File Upload Area -->
  <div
    class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-8 text-center hover:border-primary-400 dark:hover:border-primary-500 transition-colors bg-white dark:bg-gray-800">
    <label class="cursor-pointer">
      <input type="file" wire:model="uploadedFiles" multiple class="hidden" accept="image/*">
      <div>
        <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">
          <span class="font-medium text-primary-600 hover:text-primary-500 dark:text-primary-400 dark:hover:text-primary-300">Click to upload</span> or drag and drop
        </p>
        <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, GIF up to 10MB</p>
      </div>
    </label>
  </div>

  <!-- Selected Files Preview -->
  @if ($uploadedFiles)
    <div class="bg-gray-50 dark:bg-gray-800/50 rounded-lg p-4 mt-4">
      <p class="text-sm font-medium text-gray-900 dark:text-white mb-2">{{ count($uploadedFiles) }} file(s) selected</p>
      <div class="flex gap-2 justify-end mt-4">
        <button type="button" wire:click="$set('uploadedFiles', [])"
          class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
          Clear
        </button>
        <button type="button" wire:click="uploadFiles"
          class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700">
          Upload Files
        </button>
      </div>
    </div>
  @endif

  <x-slot:footer>
    <button type="button" wire:click="closeModal"
      class="w-full inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-700 text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:focus:ring-offset-gray-800 sm:w-auto sm:text-sm">
      Close
    </button>
  </x-slot:footer>
</x-media-picker.base-modal>
