<div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-900">
  <div class="space-y-6">
    {{-- Success Message --}}
    @if (session()->has('message'))
      <div class="rounded-lg bg-success-50 p-4 dark:bg-success-400/10">
        <div class="flex">
          <div class="shrink-0">
            <svg class="h-5 w-5 text-success-400" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd"
                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                clip-rule="evenodd" />
            </svg>
          </div>
          <div class="ml-3">
            <p class="text-sm font-medium text-success-800 dark:text-success-400">{{ session('message') }}</p>
          </div>
        </div>
      </div>
    @endif

    {{-- Toolbar --}}
    <div class="border-b border-gray-200 pb-6 dark:border-gray-700">
      <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex flex-1 flex-wrap gap-3">
          {{-- Search --}}
          <div class="flex-1 min-w-[250px] max-w-md">
            <label for="search" class="sr-only">Search</label>
            <div class="relative">
              <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd"
                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                    clip-rule="evenodd" />
                </svg>
              </div>
              <input type="text" wire:model.live.debounce.300ms="search" id="search"
                class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 pl-10 text-sm shadow-sm transition-colors focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-400"
                placeholder="Search media...">
            </div>
          </div>

          {{-- Collection Filter --}}
          <div class="min-w-[200px]">
            <select wire:model.live="collectionFilter"
              class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm shadow-sm transition-colors focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-primary-400">
              <option value="">All Collections</option>
              @foreach ($collections as $collection)
                <option value="{{ $collection }}">{{ ucfirst($collection) }}</option>
              @endforeach
            </select>
          </div>
        </div>

        {{-- Action Buttons --}}
        <div class="flex flex-wrap gap-2">
          @if ($selectedCount > 0)
            <button wire:click="deleteSelected"
              wire:confirm="Are you sure you want to delete {{ $selectedCount }} selected item(s)?"
              class="inline-flex items-center gap-2 rounded-lg bg-danger-600 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition-colors hover:bg-danger-700 focus:ring-2 focus:ring-danger-500/20">
              <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                  d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                  clip-rule="evenodd" />
              </svg>
              Delete Selected
            </button>
            <button wire:click="deselectAll"
              class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 shadow-sm transition-colors hover:bg-gray-50 focus:ring-2 focus:ring-gray-500/20 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
              Clear
            </button>
          @endif

          {{-- Add Folder Button --}}
          <button wire:click="openFolderCreator"
            class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 shadow-sm transition-colors hover:bg-gray-50 focus:ring-2 focus:ring-gray-500/20 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
            </svg>
            Add Folder
          </button>

          {{-- Add Asset Button --}}
          <button wire:click="openAssetUploader"
            class="inline-flex items-center gap-2 rounded-lg bg-primary-600 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition-colors hover:bg-primary-700 focus:ring-2 focus:ring-primary-500/20">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add Asset
          </button>
        </div>
      </div>
    </div>

    {{-- Media Grid --}}
    <div>
      <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6">
        @forelse($mediaItems as $media)
          <div wire:click="toggleSelect({{ $media->id }})"
            class="group relative cursor-pointer overflow-hidden rounded-lg border-2 bg-white shadow-sm transition-all hover:shadow-md {{ $this->isSelected($media->id) ? 'border-primary-600 ring-2 ring-primary-600 dark:border-primary-400 dark:ring-primary-400' : 'border-gray-200 hover:border-primary-500 dark:border-gray-700 dark:hover:border-primary-600' }} dark:bg-gray-800">

            {{-- Checkbox --}}
            @if ($this->isSelected($media->id))
              <div class="absolute right-2 top-2 z-10">
                <div class="rounded-full bg-primary-600 p-1 text-white dark:bg-primary-400">
                  <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                      d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                      clip-rule="evenodd" />
                  </svg>
                </div>
              </div>
            @endif

            {{-- Image/Preview --}}
            <div class="aspect-square flex items-center justify-center bg-gray-100 dark:bg-gray-800">
              @if (str_starts_with($media->mime_type ?? '', 'image/'))
                <img src="{{ $media->getUrl() }}" alt="{{ $media->name }}" class="h-full w-full object-cover">
              @else
                <div class="flex flex-col items-center justify-center p-4">
                  <svg class="h-12 w-12 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                      d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                      clip-rule="evenodd" />
                  </svg>
                  <span
                    class="mt-2 text-xs text-gray-500">{{ strtoupper(pathinfo($media->file_name, PATHINFO_EXTENSION)) }}</span>
                </div>
              @endif
            </div>

            {{-- Info --}}
            <div class="bg-white p-2 dark:bg-gray-900">
              <p class="truncate text-xs font-medium text-gray-900 dark:text-white" title="{{ $media->name }}">
                {{ $media->name }}</p>
              <div class="mt-1 flex items-center justify-between">
                <span class="text-xs text-gray-500 dark:text-gray-400">{{ number_format($media->size / 1024, 1) }}
                  KB</span>
                <span
                  class="rounded bg-gray-100 px-1.5 py-0.5 text-xs text-gray-600 dark:bg-gray-800 dark:text-gray-400">{{ $media->collection_name }}</span>
              </div>
            </div>

            {{-- Hover Actions --}}
            <div
              class="absolute inset-0 flex items-center justify-center bg-black/50 opacity-0 transition-opacity group-hover:opacity-100">
              <button wire:click.stop="deleteMedia({{ $media->id }})"
                wire:confirm="Are you sure you want to delete this media?"
                class="rounded-full bg-danger-600 p-2 text-white hover:bg-danger-700">
                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd"
                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                    clip-rule="evenodd" />
                </svg>
              </button>
            </div>
          </div>
        @empty
          <div
            class="col-span-full rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 py-16 text-center dark:border-gray-600 dark:bg-gray-800/50">
            <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">No media found</p>
            <p class="text-xs text-gray-400 dark:text-gray-500">Upload some files to get started</p>
          </div>
        @endforelse
      </div>

      {{-- Pagination --}}
      @if ($mediaItems->hasPages())
        <div class="mt-6 flex justify-center">
          {{ $mediaItems->links() }}
        </div>
      @endif
    </div>

    {{-- Stats Footer --}}
    <div class="border-t border-gray-200 pt-6 dark:border-gray-700">
      <div class="flex flex-wrap items-center justify-between gap-2 text-sm text-gray-600 dark:text-gray-400">
        <div>
          Showing <span class="font-medium text-gray-900 dark:text-white">{{ $mediaItems->firstItem() ?? 0 }}</span>
          to
          <span class="font-medium text-gray-900 dark:text-white">{{ $mediaItems->lastItem() ?? 0 }}</span> of
          <span class="font-medium text-gray-900 dark:text-white">{{ $mediaItems->total() }}</span> results
        </div>
        @if ($selectedCount > 0)
          <div>
            <span class="font-medium text-primary-600 dark:text-primary-400">{{ $selectedCount }}</span> item(s)
            selected
          </div>
        @endif
      </div>
    </div>
  </div>
</div>
