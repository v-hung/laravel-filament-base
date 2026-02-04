<x-media-picker.base-modal title="Media Details" maxWidth="4xl" :showFooter="false">
  <div class="grid gap-6 md:grid-cols-2">
    <!-- Left: Preview -->
    <div class="space-y-4">
      <div
        class="flex aspect-square items-center justify-center overflow-hidden rounded-lg border border-gray-200 bg-gray-50 dark:border-gray-700 dark:bg-gray-900"
        style="background-image: repeating-conic-gradient(#e5e7eb 0% 25%, transparent 0% 50%) 50% / 20px 20px;">
        @if (str_starts_with($this->getDetailMedia()->mime_type ?? '', 'image/'))
          <img src="{{ $this->getDetailMedia()->getUrl() }}" alt="{{ $this->getDetailMedia()->name }}"
            class="max-h-full max-w-full object-contain">
        @else
          <div class="flex flex-col items-center justify-center p-8">
            <svg class="h-24 w-24 text-gray-400 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd"
                d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                clip-rule="evenodd" />
            </svg>
            <span class="mt-4 text-sm text-gray-500 dark:text-gray-400">{{ $this->getDetailMedia()->mime_type }}</span>
          </div>
        @endif
      </div>

      <!-- Action Buttons -->
      <div class="flex justify-center gap-2">
        <button wire:click="deleteDetailMedia" wire:confirm="Are you sure you want to delete this media?" title="Delete"
          class="rounded-lg bg-gray-100 p-2 text-gray-600 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-400 dark:hover:bg-gray-600">
          <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
              d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
              clip-rule="evenodd" />
          </svg>
        </button>
        <a href="{{ $this->getDetailMedia()->getUrl() }}" download="{{ $this->getDetailMedia()->file_name }}"
          title="Download"
          class="rounded-lg bg-gray-100 p-2 text-gray-600 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-400 dark:hover:bg-gray-600">
          <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
          </svg>
        </a>
        <button onclick="navigator.clipboard.writeText('{{ $this->getDetailMedia()->getUrl() }}')" title="Copy link"
          class="rounded-lg bg-gray-100 p-2 text-gray-600 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-400 dark:hover:bg-gray-600">
          <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
          </svg>
        </button>
        <a href="{{ $this->getDetailMedia()->getUrl() }}" target="_blank" title="Open in new tab"
          class="rounded-lg bg-gray-100 p-2 text-gray-600 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-400 dark:hover:bg-gray-600">
          <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
          </svg>
        </a>
      </div>
    </div>

    <!-- Right: Information -->
    <div class="space-y-4">
      <!-- File Info Grid -->
      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Size</label>
          <p class="mt-1 text-sm font-medium text-gray-900 dark:text-white">
            {{ number_format($this->getDetailMedia()->size / 1024, 1) }} KB</p>
        </div>
        @if ($this->imageInfo)
          <div>
            <label
              class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Dimensions</label>
            <p class="mt-1 text-sm font-medium text-gray-900 dark:text-white">
              {{ $this->imageInfo[0] }}×{{ $this->imageInfo[1] }}</p>
          </div>
        @endif
        <div>
          <label class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Date</label>
          <p class="mt-1 text-sm font-medium text-gray-900 dark:text-white">
            {{ $this->getDetailMedia()->created_at->format('n/j/Y') }}</p>
        </div>
        <div>
          <label class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Extension</label>
          <p class="mt-1 text-sm font-medium text-gray-900 dark:text-white">
            {{ pathinfo($this->getDetailMedia()->file_name, PATHINFO_EXTENSION) }}</p>
        </div>
        <div class="col-span-2">
          <label class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Asset ID</label>
          <p class="mt-1 text-sm font-medium text-gray-900 dark:text-white">{{ $this->getDetailMedia()->id }}</p>
        </div>
      </div>

      <!-- Divider -->
      <div class="border-t border-gray-200 dark:border-gray-700"></div>

      <!-- Editable Fields -->
      <div class="space-y-4">
        <!-- File name -->
        <div>
          <label for="detail-filename" class="block text-sm font-medium text-gray-700 dark:text-gray-300">File
            name</label>
          <input type="text" id="detail-filename" wire:model="detailFileName"
            class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 px-4 py-2.5 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:text-white sm:text-sm">
        </div>

        <!-- Alternative text -->
        <div>
          <label for="detail-alt" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alternative
            text</label>
          <textarea id="detail-alt" wire:model="detailAltText" rows="2"
            class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 px-4 py-2.5 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:text-white sm:text-sm"
            placeholder="An image uploaded to Strapi called favicon"></textarea>
          <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">This text will be displayed if the asset can't be
            shown.</p>
        </div>

        <!-- Caption -->
        <div>
          <label for="detail-caption" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Caption</label>
          <input type="text" id="detail-caption" wire:model="detailCaption"
            class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 px-4 py-2.5 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:text-white sm:text-sm">
        </div>

        <!-- Location -->
        <div>
          <label for="detail-location"
            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Location</label>
          <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $this->detailLocation }}</p>
        </div>

        <!-- Replace Media -->
        <div>
          <label for="replacement-file" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Replace
            media</label>
          <input type="file" id="replacement-file" wire:model="replacementFile"
            class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:rounded-lg file:border-0 file:bg-primary-50 dark:file:bg-primary-900/20 file:px-4 file:py-2 file:text-sm file:font-medium file:text-primary-700 dark:file:text-primary-400 hover:file:bg-primary-100 dark:hover:file:bg-primary-900/30">
          @if ($this->replacementFile)
            <p class="mt-1 text-xs text-green-600 dark:text-green-400">New file selected:
              {{ $this->replacementFile->getClientOriginalName() }}</p>
          @endif
        </div>
      </div>
    </div>
  </div>

  <!-- Custom Footer inside content -->
  <div
    class="mt-6 pt-4 border-t border-gray-200 dark:border-gray-700 flex flex-col sm:flex-row sm:justify-end gap-2">
    <button wire:click="closeModal" type="button"
      class="inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-700 text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:focus:ring-offset-gray-800 sm:text-sm">
      Cancel
    </button>
    @if ($this->replacementFile)
      <button wire:click="replaceMedia" type="button"
        class="inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary-600 text-base font-medium text-white hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:focus:ring-offset-gray-800 sm:text-sm">
        Replace Media
      </button>
    @endif
    <button wire:click="saveMediaDetails" type="button"
      class="inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary-600 text-base font-medium text-white hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:focus:ring-offset-gray-800 sm:text-sm">
      Save Changes
    </button>
  </div>
</x-media-picker.base-modal>
