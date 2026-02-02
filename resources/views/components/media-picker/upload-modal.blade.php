<div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
  <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
    <!-- Background overlay -->
    <div class="fixed inset-0 bg-gray-500 opacity-75 transition-opacity" wire:click="handleClickOutside"></div>

    <!-- Modal panel -->
    <div
      class="relative inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">

      <!-- Header -->
      <div class="bg-white px-4 pt-5 pb-4 sm:p-6 border-b border-gray-200">
        <div class="flex items-center justify-between">
          <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
            Upload Files
          </h3>
          <button wire:click="closeUploadModal" class="text-gray-400 hover:text-gray-500">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      </div>

      <!-- Content -->
      <div class="bg-white px-6 py-6">
        <div class="text-center mb-6">
          <svg class="mx-auto h-16 w-16 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
          </svg>
          <h3 class="mt-2 text-lg font-medium text-gray-900">Upload Assets</h3>
          <p class="mt-1 text-sm text-gray-500">
            @if ($currentFolder)
              Upload to folder: <span class="font-medium">{{ $currentFolder }}</span>
            @else
              Select files to upload
            @endif
          </p>
        </div>

        <!-- File Upload Area -->
        <div
          class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-indigo-400 transition-colors">
          <label class="cursor-pointer">
            <input type="file" wire:model="uploadedFiles" multiple class="hidden" accept="image/*">
            <div>
              <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
              </svg>
              <p class="mt-2 text-sm text-gray-600">
                <span class="font-medium text-indigo-600 hover:text-indigo-500">Click to upload</span> or drag and drop
              </p>
              <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
            </div>
          </label>
        </div>

        <!-- Selected Files Preview -->
        @if ($uploadedFiles)
          <div class="bg-gray-50 rounded-lg p-4 mt-4">
            <p class="text-sm font-medium text-gray-900 mb-2">{{ count($uploadedFiles) }} file(s) selected</p>
            <div class="flex gap-2 justify-end mt-4">
              <button type="button" wire:click="$set('uploadedFiles', [])"
                class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                Clear
              </button>
              <button type="button" wire:click="uploadFiles"
                class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700">
                Upload Files
              </button>
            </div>
          </div>
        @endif
      </div>

      <!-- Footer -->
      <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-gray-200">
        <button type="button" wire:click="closeUploadModal"
          class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:w-auto sm:text-sm">
          Close
        </button>
      </div>
    </div>
  </div>
</div>
