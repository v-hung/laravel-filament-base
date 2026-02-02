@if ($view === 'browse')
  <!-- Search Bar -->
  <div class="mb-4">
    <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search media..."
      class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
  </div>

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
@else
  <!-- Selected Files View -->
  <div class="text-center py-12">
    <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
    </svg>
    <h3 class="mt-2 text-sm font-medium text-gray-900">
      @if (count($selected) > 0)
        {{ count($selected) }} file(s) selected
      @else
        No files selected
      @endif
    </h3>
    <p class="mt-1 text-sm text-gray-500">
      @if (count($selected) > 0)
        Click "Finish" to use selected files
      @else
        Go to Browse tab to select files
      @endif
    </p>
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
          <button wire:click="toggleSelect({{ $media->id }})"
            class="absolute top-2 right-2 p-1 bg-red-600 text-white rounded-full hover:bg-red-700">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd"
                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                clip-rule="evenodd" />
            </svg>
          </button>
        </div>
      @endforeach
    </div>
  @endif
@endif
