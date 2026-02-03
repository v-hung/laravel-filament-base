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
          <div
            class="group relative overflow-hidden rounded-lg border-2 bg-white shadow-sm transition-all hover:shadow-md {{ $this->isSelected($media->id) ? 'border-primary-600 ring-2 ring-primary-600 dark:border-primary-400 dark:ring-primary-400' : 'border-gray-200 hover:border-primary-500 dark:border-gray-700 dark:hover:border-primary-600' }} dark:bg-gray-800">

            {{-- Top Action Buttons --}}
            <div class="absolute left-2 top-2 z-10 opacity-0 transition-opacity group-hover:opacity-100">
              <button wire:click.stop="toggleSelect({{ $media->id }})" title="Select"
                class="rounded-full p-1.5 shadow-lg transition-colors {{ $this->isSelected($media->id) ? 'bg-primary-600 text-white dark:bg-primary-400' : 'bg-white text-gray-600 hover:bg-gray-100 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700' }}">
                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd"
                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                    clip-rule="evenodd" />
                </svg>
              </button>
            </div>

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
            <div wire:click="openMediaDetail({{ $media->id }})"
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

  {{-- Detail Modal --}}
  @if ($showDetailModal && $this->getDetailMedia())
    @php
      $detailMedia = $this->getDetailMedia();
      $imageInfo = @getimagesize($detailMedia->getPath());
    @endphp
    <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
      <div class="flex min-h-screen items-end justify-center px-4 pb-20 pt-4 text-center sm:block sm:p-0">
        {{-- Background overlay --}}
        <div wire:click="closeDetailModal"
          class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity dark:bg-gray-900 dark:bg-opacity-80">
        </div>

        {{-- Modal panel --}}
        <div
          class="inline-block w-full max-w-4xl transform overflow-hidden rounded-lg bg-white text-left align-bottom shadow-xl transition-all dark:bg-gray-800 sm:my-8 sm:align-middle">

          {{-- Header --}}
          <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
            <div class="flex items-center justify-between">
              <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Details</h3>
              <button wire:click="closeDetailModal"
                class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
              </button>
            </div>
          </div>

          {{-- Content --}}
          <div class="grid gap-6 p-6 md:grid-cols-2">
            {{-- Left: Preview --}}
            <div class="space-y-4">
              <div
                class="flex aspect-square items-center justify-center overflow-hidden rounded-lg border-2 border-gray-200 bg-gray-50 dark:border-gray-700 dark:bg-gray-900"
                style="background-image: repeating-conic-gradient(#e5e7eb 0% 25%, transparent 0% 50%) 50% / 20px 20px;">
                @if (str_starts_with($detailMedia->mime_type ?? '', 'image/'))
                  <img src="{{ $detailMedia->getUrl() }}" alt="{{ $detailMedia->name }}"
                    class="max-h-full max-w-full object-contain">
                @else
                  <div class="flex flex-col items-center justify-center p-8">
                    <svg class="h-24 w-24 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd"
                        d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                        clip-rule="evenodd" />
                    </svg>
                    <span class="mt-4 text-sm text-gray-500 dark:text-gray-400">{{ $detailMedia->mime_type }}</span>
                  </div>
                @endif
              </div>

              {{-- Action Buttons --}}
              <div class="flex justify-center gap-2">
                <button wire:click="deleteDetailMedia" wire:confirm="Are you sure you want to delete this media?"
                  title="Delete"
                  class="rounded-lg bg-gray-100 p-2 text-gray-600 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-400 dark:hover:bg-gray-600">
                  <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                      d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                      clip-rule="evenodd" />
                  </svg>
                </button>
                <a href="{{ $detailMedia->getUrl() }}" download="{{ $detailMedia->file_name }}" title="Download"
                  class="rounded-lg bg-gray-100 p-2 text-gray-600 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-400 dark:hover:bg-gray-600">
                  <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                  </svg>
                </a>
                <button onclick="navigator.clipboard.writeText('{{ $detailMedia->getUrl() }}')" title="Copy link"
                  class="rounded-lg bg-gray-100 p-2 text-gray-600 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-400 dark:hover:bg-gray-600">
                  <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                  </svg>
                </button>
                <a href="{{ $detailMedia->getUrl() }}" target="_blank" title="Open in new tab"
                  class="rounded-lg bg-gray-100 p-2 text-gray-600 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-400 dark:hover:bg-gray-600">
                  <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                  </svg>
                </a>
              </div>
            </div>

            {{-- Right: Information --}}
            <div class="space-y-4">
              {{-- File Info Grid --}}
              <div class="grid grid-cols-2 gap-4">
                <div>
                  <label
                    class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Size</label>
                  <p class="mt-1 text-sm font-medium text-gray-900 dark:text-white">
                    {{ number_format($detailMedia->size / 1024, 1) }} KB</p>
                </div>
                @if ($imageInfo)
                  <div>
                    <label
                      class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Dimensions</label>
                    <p class="mt-1 text-sm font-medium text-gray-900 dark:text-white">
                      {{ $imageInfo[0] }}×{{ $imageInfo[1] }}</p>
                  </div>
                @endif
                <div>
                  <label
                    class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Date</label>
                  <p class="mt-1 text-sm font-medium text-gray-900 dark:text-white">
                    {{ $detailMedia->created_at->format('n/j/Y') }}</p>
                </div>
                <div>
                  <label
                    class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Extension</label>
                  <p class="mt-1 text-sm font-medium text-gray-900 dark:text-white">
                    {{ pathinfo($detailMedia->file_name, PATHINFO_EXTENSION) }}</p>
                </div>
                <div class="col-span-2">
                  <label class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Asset
                    ID</label>
                  <p class="mt-1 text-sm font-medium text-gray-900 dark:text-white">{{ $detailMedia->id }}</p>
                </div>
              </div>

              {{-- Divider --}}
              <div class="border-t border-gray-200 dark:border-gray-700"></div>

              {{-- Editable Fields --}}
              <div class="space-y-4">
                {{-- File name --}}
                <div>
                  <label for="detail-filename" class="block text-sm font-medium text-gray-700 dark:text-gray-300">File
                    name</label>
                  <input type="text" id="detail-filename" wire:model="detailFileName"
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                </div>

                {{-- Alternative text --}}
                <div>
                  <label for="detail-alt"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alternative text</label>
                  <textarea id="detail-alt" wire:model="detailAltText" rows="2"
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm"
                    placeholder="An image uploaded to Strapi called favicon"></textarea>
                  <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">This text will be displayed if the asset
                    can't
                    be shown.</p>
                </div>

                {{-- Caption --}}
                <div>
                  <label for="detail-caption"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Caption</label>
                  <input type="text" id="detail-caption" wire:model="detailCaption"
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                </div>

                {{-- Location --}}
                <div>
                  <label for="detail-location"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Location</label>
                  <select id="detail-location" wire:model="detailLocation"
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                    @foreach ($collections as $collection)
                      <option value="{{ $collection }}">{{ ucfirst($collection) }}</option>
                    @endforeach
                  </select>
                </div>

                {{-- Replace Media --}}
                <div>
                  <label for="replacement-file"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Replace media</label>
                  <input type="file" id="replacement-file" wire:model="replacementFile"
                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:rounded-lg file:border-0 file:bg-primary-50 file:px-4 file:py-2 file:text-sm file:font-medium file:text-primary-700 hover:file:bg-primary-100 dark:text-gray-400 dark:file:bg-primary-900/20 dark:file:text-primary-400">
                  @if ($replacementFile)
                    <p class="mt-1 text-xs text-green-600 dark:text-green-400">New file selected:
                      {{ $replacementFile->getClientOriginalName() }}</p>
                  @endif
                </div>
              </div>
            </div>
          </div>

          {{-- Footer --}}
          <div class="border-t border-gray-200 bg-gray-50 px-6 py-4 dark:border-gray-700 dark:bg-gray-900">
            <div class="flex items-center justify-between">
              <button wire:click="closeDetailModal" type="button"
                class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                Cancel
              </button>
              <div class="flex gap-2">
                @if ($replacementFile)
                  <button wire:click="replaceMedia" type="button"
                    class="rounded-lg border border-primary-600 bg-white px-4 py-2 text-sm font-medium text-primary-600 hover:bg-primary-50 dark:border-primary-400 dark:bg-gray-800 dark:text-primary-400 dark:hover:bg-primary-900/20">
                    Replace Media
                  </button>
                @endif
                <button wire:click="saveMediaDetails" type="button"
                  class="rounded-lg bg-primary-600 px-4 py-2 text-sm font-medium text-white hover:bg-primary-700 dark:bg-primary-500 dark:hover:bg-primary-600">
                  Finish
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endif
</div>
