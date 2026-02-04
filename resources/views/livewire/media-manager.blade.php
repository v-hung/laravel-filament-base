<div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-900">
  <div class="space-y-6">
    {{-- Toolbar --}}
    <div class="border-b border-gray-200 pb-6 dark:border-gray-700">
      {{-- Breadcrumb Navigation --}}
      @if ($currentFolderId || count($folderPath) > 0)
        <div class="mb-4 flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
          <button wire:click="goToRootFolder"
            class="hover:text-primary-600 dark:hover:text-primary-400 transition-colors">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
          </button>

          @foreach ($folderPath as $folder)
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <button wire:click="enterFolder({{ $folder['id'] }})"
              class="hover:text-primary-600 dark:hover:text-primary-400 transition-colors font-medium">
              {{ $folder['name'] }}
            </button>
          @endforeach
        </div>
      @endif

      <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex flex-1 flex-wrap gap-3">
          {{-- Search --}}
          <div class="flex-1 min-w-62.5 max-w-md">
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
        </div>

        {{-- Action Buttons --}}
        <div class="flex flex-wrap gap-2">
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
        {{-- Folders --}}
        @foreach ($folders as $folder)
          <div wire:click="enterFolder({{ $folder->id }})"
            class="group relative cursor-pointer overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm transition-all hover:shadow-md hover:ring-2 hover:ring-primary-500 dark:border-gray-700 dark:bg-gray-800 dark:hover:border-primary-600">

            <div
              class="aspect-square flex items-center justify-center bg-linear-to-br from-primary-50 to-primary-100 dark:from-primary-900/20 dark:to-primary-800/20">
              <svg class="h-16 w-16 text-primary-500 dark:text-primary-400" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
              </svg>
            </div>

            <div class="bg-white p-2 dark:bg-gray-900">
              <p class="truncate text-xs font-medium text-gray-900 dark:text-white" title="{{ $folder->name }}">
                {{ $folder->name }}
              </p>
              <div class="mt-1 flex items-center justify-between">
                <span class="text-xs text-gray-500 dark:text-gray-400">
                  {{ $folder->medias()->count() }} items
                </span>
                <span
                  class="rounded bg-primary-100 px-1.5 py-0.5 text-xs text-primary-600 dark:bg-primary-800/30 dark:text-primary-400">
                  Folder
                </span>
              </div>
            </div>
          </div>
        @endforeach

        {{-- Media Files --}}
        @forelse($mediaItems as $media)
          <div
            class="group relative overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm transition-all hover:ring-2 hover:ring-primary-500 hover:shadow-md dark:border-gray-700 dark:bg-gray-800 dark:hover:border-primary-600">

            {{-- Top Action Button --}}
            <div class="absolute right-2 top-2 z-10 opacity-0 transition-opacity group-hover:opacity-100">
              <button wire:click.stop="deleteMedia({{ $media->id }})"
                wire:confirm="Are you sure you want to delete this media?" title="Delete"
                class="rounded-full bg-danger-600 p-1.5 text-white shadow-lg hover:bg-danger-700 dark:bg-danger-500 dark:hover:bg-danger-600">
                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd"
                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                    clip-rule="evenodd" />
                </svg>
              </button>
            </div>

            {{-- Image/Preview --}}
            <div wire:click="$dispatch('openMediaDetail', { mediaId: {{ $media->id }} })"
              class="aspect-square flex cursor-pointer items-center justify-center bg-gray-100 dark:bg-gray-800">
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
          </div>
        @empty
          <div
            class="col-span-full rounded-lg border border-dashed border-gray-300 bg-gray-50 py-16 text-center dark:border-gray-600 dark:bg-gray-800/50">
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
      <div class="text-sm text-gray-600 dark:text-gray-400">
        Showing <span class="font-medium text-gray-900 dark:text-white">{{ $mediaItems->firstItem() ?? 0 }}</span>
        to
        <span class="font-medium text-gray-900 dark:text-white">{{ $mediaItems->lastItem() ?? 0 }}</span> of
        <span class="font-medium text-gray-900 dark:text-white">{{ $mediaItems->total() }}</span> results
      </div>
    </div>
  </div>
</div>
