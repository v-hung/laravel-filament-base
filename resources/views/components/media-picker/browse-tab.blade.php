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
    <button wire:click="uploadFiles" class="px-4 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700">
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
    <x-media-picker.media-item :media="$media" :isSelected="$this->isSelected($media->id)" />
  @empty
    <div class="col-span-full text-center py-12">
      <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
