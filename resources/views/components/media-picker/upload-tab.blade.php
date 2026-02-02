@if ($mode === 'manager')
  <!-- Manager Upload Mode -->
  <div class="max-w-2xl mx-auto py-12">
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
        <div class="bg-gray-50 rounded-lg p-4">
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
  </div>
@else
  <!-- Picker Selected Files View -->
  <div class="text-center py-12">
    <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
    <p class="mt-1 text-sm text-gray-500">Click "Finish" to use selected assets</p>
  </div>

  @if (count($selected) > 0)
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 mt-6">
      @foreach (Media::whereIn('id', $selected)->get() as $media)
        <div class="relative bg-white border-2 border-indigo-600 rounded-lg overflow-hidden">
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
          <div class="p-2">
            <p class="text-xs font-medium text-gray-900 truncate">{{ $media->name }}</p>
          </div>
        </div>
      @endforeach
    </div>
  @endif
@endif
