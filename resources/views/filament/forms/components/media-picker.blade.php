<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
  <div x-data="{
      state: $wire.entangle('{{ $getStatePath() }}'),
      multiple: {{ $isMultiple() ? 'true' : 'false' }},
      mediaItems: {{ json_encode($getMediaItems()) }},
  
      openPicker() {
          const selectedIds = this.multiple ? (Array.isArray(this.state) ? this.state : []) : (this.state ? [this.state] : []);
          Livewire.dispatch('openMediaPicker', { selectedIds });
      },
  
      removeMedia(id) {
          if (this.multiple) {
              this.state = this.state.filter(itemId => itemId !== id);
              this.mediaItems = this.mediaItems.filter(item => item.id !== id);
          } else {
              this.state = null;
              this.mediaItems = [];
          }
      }
  }" x-init="Livewire.on('mediaSelected', (selectedIds) => {
      if (multiple) {
          state = selectedIds[0];
      } else {
          state = selectedIds[0] && selectedIds[0].length > 0 ? selectedIds[0][0] : null;
      }
  
      // Reload media items
      $wire.call('getMediaItems').then(items => {
          mediaItems = items;
      });
  });" class="space-y-2">

    <!-- Selected Media Display -->
    <template x-if="mediaItems && mediaItems.length > 0">
      <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 mb-4">
        <template x-for="media in mediaItems" :key="media.id">
          <div class="relative group bg-white border-2 border-gray-200 rounded-lg overflow-hidden">
            <div class="aspect-square bg-gray-100 flex items-center justify-center">
              <template x-if="media.mime_type && media.mime_type.startsWith('image/')">
                <img :src="media.url" :alt="media.name" class="w-full h-full object-cover">
              </template>
              <template x-if="!media.mime_type || !media.mime_type.startsWith('image/')">
                <svg class="w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd"
                    d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                    clip-rule="evenodd" />
                </svg>
              </template>
            </div>
            <div class="p-2">
              <p class="text-xs font-medium text-gray-900 truncate" x-text="media.file_name"></p>
            </div>

            <!-- Remove Button -->
            <button type="button" @click="removeMedia(media.id)"
              class="absolute top-2 right-2 p-1 bg-red-600 text-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity hover:bg-red-700">
              <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                  clip-rule="evenodd" />
              </svg>
            </button>
          </div>
        </template>
      </div>
    </template>

    <!-- Add Media Button -->
    <div class="flex items-center justify-center w-full">
      <button type="button" @click="openPicker()"
        class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors">
        <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        <p class="text-sm text-gray-500 font-medium">
          <span x-show="!mediaItems || mediaItems.length === 0">Click to add an asset or drag and drop one in this
            area</span>
          <span x-show="mediaItems && mediaItems.length > 0">Add more assets</span>
        </p>
      </button>
    </div>
  </div>

  @once
    @push('scripts')
      <script>
        // Initialize media picker modal if not already present
        if (!window.mediaPickerInitialized) {
          window.mediaPickerInitialized = true;
        }
      </script>
    @endpush
  @endonce
</x-dynamic-component>
