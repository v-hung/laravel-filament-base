<div>
  @if ($isOpen)
    <div class="top-0 left-0 right-0 bottom-0 fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title"
      role="dialog" aria-modal="true">
      <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" wire:click="close"></div>

        <!-- Modal panel -->
        <div
          class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-6xl sm:w-full">
          <!-- Header -->
          <div class="bg-white px-4 pt-5 pb-4 sm:p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
              <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                Add new assets
              </h3>
              <button wire:click="close" class="text-gray-400 hover:text-gray-500">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
              </button>
            </div>
          </div>

          <!-- Tabs -->
          <div class="border-b border-gray-200 bg-white px-6">
            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
              <button wire:click="switchView('browse')"
                class="@if ($view === 'browse') border-indigo-500 text-indigo-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm uppercase">
                Browse
              </button>
              <button wire:click="switchView('upload')"
                class="@if ($view === 'upload') border-indigo-500 text-indigo-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm uppercase">
                @if ($mode === 'manager')
                  Upload
                @else
                  Selected Files
                @endif
                @if (count($selected) > 0 && $mode === 'picker')
                  <span
                    class="ml-2 bg-indigo-100 text-indigo-600 py-0.5 px-2 rounded-full text-xs">{{ count($selected) }}</span>
                @endif
              </button>
              @if ($mode === 'manager')
                <button wire:click="switchView('create-folder')"
                  class="@if ($view === 'create-folder') border-indigo-500 text-indigo-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm uppercase">
                  Create Folder
                </button>
              @endif
            </nav>
          </div>

          <!-- Content -->
          <div class="bg-gray-50 px-6 py-4" style="min-height: 500px; max-height: 600px; overflow-y: auto;">
            @if ($view === 'browse')
              <!-- Search and Filters -->
              <div class="mb-4 flex items-center justify-between">
                <div class="flex-1 max-w-lg">
                  <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search media..."
                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="ml-4">
                  <label class="inline-flex items-center">
                    <input type="file" wire:model="uploadedFiles" multiple class="hidden" id="quick-upload">
                    <button type="button" onclick="document.getElementById('quick-upload').click()"
                      class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                      <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                      </svg>
                      Add more assets
                    </button>
                  </label>
                </div>
              </div>

              @if ($uploadedFiles)
                <div class="mb-4 p-4 bg-blue-50 border border-blue-200 rounded-md">
                  <p class="text-sm text-blue-800 mb-2">{{ count($uploadedFiles) }} file(s) ready to upload</p>
                  <button wire:click="uploadFiles"
                    class="px-4 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700">
                    Upload Now
                  </button>
                </div>
              @endif

              @if (session()->has('message'))
                <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-md">
                  <p class="text-sm text-green-800">{{ session('message') }}</p>
                </div>
              @endif

              <!-- Media Grid -->
              <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                @forelse($mediaItems as $media)
                  <div wire:click="toggleSelect({{ $media->id }})"
                    class="relative group cursor-pointer bg-white border-2 rounded-lg overflow-hidden hover:border-indigo-500 transition-all @if ($this->isSelected($media->id)) border-indigo-600 ring-2 ring-indigo-600 @else border-gray-200 @endif">

                    <!-- Checkbox -->
                    @if ($this->isSelected($media->id))
                      <div class="absolute top-2 right-2 z-10">
                        <div class="bg-indigo-600 text-white rounded-full p-1">
                          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                              d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                              clip-rule="evenodd" />
                          </svg>
                        </div>
                      </div>
                    @endif

                    <!-- Image -->
                    <div class="aspect-square bg-gray-100 flex items-center justify-center">
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
                    <div class="p-2 bg-white">
                      <p class="text-xs font-medium text-gray-900 truncate">{{ $media->name }}</p>
                      <p class="text-xs text-gray-500">{{ number_format($media->size / 1024, 2) }} KB</p>
                    </div>

                    <!-- Hover Actions -->
                    <div
                      class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all flex items-center justify-center opacity-0 group-hover:opacity-100">
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
                @empty
                  <div class="col-span-full text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                      viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <p class="mt-2 text-sm text-gray-500">No media found</p>
                  </div>
                @endforelse
              </div>

              <!-- Pagination -->
              @if ($mediaItems->hasPages())
                <div class="mt-4">
                  {{ $mediaItems->links() }}
                </div>
              @endif
            @elseif($view === 'create-folder')
              <!-- Create Folder View -->
              <div class="max-w-md mx-auto py-12">
                <div class="text-center mb-6">
                  <svg class="mx-auto h-16 w-16 text-indigo-400" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                  </svg>
                  <h3 class="mt-2 text-lg font-medium text-gray-900">Create New Folder</h3>
                  <p class="mt-1 text-sm text-gray-500">Enter a name for your new collection/folder</p>
                </div>

                <div class="space-y-4">
                  <div>
                    <label for="folderName" class="block text-sm font-medium text-gray-700 mb-2">Folder Name</label>
                    <input type="text" id="folderName" wire:model="newFolderName"
                      placeholder="e.g. products, blog, avatars"
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
            @else
              <!-- Upload View -->
              @if ($mode === 'manager')
                <!-- Manager Upload Mode -->
                <div class="max-w-2xl mx-auto py-12">
                  <div class="text-center mb-6">
                    <svg class="mx-auto h-16 w-16 text-indigo-400" fill="none" stroke="currentColor"
                      viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                    </svg>
                    <h3 class="mt-2 text-lg font-medium text-gray-900">Upload Assets</h3>
                    <p class="mt-1 text-sm text-gray-500">
                      @if ($currentFolder)
                        Upload to folder: <span class="font-medium">{{ $currentFolder }}</span>
                      @else
                        Upload media files
                      @endif
                    </p>
                  </div>

                  <div class="space-y-4">
                    <!-- File Upload Area -->
                    <div
                      class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-indigo-400 transition-colors">
                      <label class="cursor-pointer">
                        <input type="file" wire:model="uploadedFiles" multiple class="hidden" accept="image/*">
                        <div>
                          <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                          </svg>
                          <p class="mt-2 text-sm text-gray-600">
                            <span class="font-medium text-indigo-600 hover:text-indigo-500">Click to upload</span> or
                            drag and drop
                          </p>
                          <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                        </div>
                      </label>
                    </div>

                    <!-- Selected Files Preview -->
                    @if ($uploadedFiles)
                      <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-sm font-medium text-gray-900 mb-2">{{ count($uploadedFiles) }} file(s) selected
                        </p>
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
                </div>
              @else
                <!-- Picker Selected Files View -->
                <div class="text-center py-12">
                  <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                  </svg>
                  <h3 class="mt-2 text-sm font-medium text-gray-900">
                    @if (count($selected) > 0)
                      {{ count($selected) }} asset(s) selected
                    @else
                      No assets selected
                    @endif
                  </h3>
                  <p class="mt-1 text-sm text-gray-500">
                    Click "Finish" to use selected assets
                  </p>
                </div>

                @if (count($selected) > 0)
                  <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 mt-6">
                    @foreach (Media::whereIn('id', $selected)->get() as $media)
                      <div class="relative bg-white border-2 border-indigo-600 rounded-lg overflow-hidden">
                        <div class="aspect-square bg-gray-100 flex items-center justify-center">
                          @if (str_starts_with($media->mime_type ?? '', 'image/'))
                            <img src="{{ $media->getUrl() }}" alt="{{ $media->name }}"
                              class="w-full h-full object-cover">
                          @else
                            <svg class="w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd"
                                d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                                clip-rule="evenodd" />
                            </svg>
                          @endif
                        </div>
                        <div class="p-2">
                          <p class="text-xs font-medium text-gray-900 truncate">{{ $media->name }}</p>
                        </div>
                      </div>
                    @endforeach
                  </div>
                @endif
              @endif
            @endif
          </div>

          <!-- Footer -->
          <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-gray-200">
            @if ($mode === 'picker')
              <button type="button" wire:click="confirm"
                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                Finish
              </button>
            @endif
            <button type="button" wire:click="close"
              class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
              {{ $mode === 'manager' ? 'Close' : 'Cancel' }}
            </button>
          </div>
        </div>
      </div>
    </div>
  @endif
</div>
