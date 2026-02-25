<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <div x-data="{
        state: $wire.entangle('{{ $getStatePath() }}'),
        multiple: {{ $isMultiple() ? 'true' : 'false' }},
        mediaItems: {{ json_encode($getMediaItems()) }},
        currentIndex: 0,
    
        init() {
            Livewire.on('mediaSelected', (args) => {
                const ids = args[0] || [];
                const items = args[1] || [];
                this.mediaItems = items;
                this.currentIndex = 0;
                if (this.multiple) {
                    this.state = ids;
                } else {
                    this.state = ids.length > 0 ? ids[0] : null;
                }
            });
        },
    
        openPicker() {
            const selectedIds = this.multiple ?
                (Array.isArray(this.state) ? this.state : []) :
                (this.state ? [this.state] : []);
            Livewire.dispatch('openMediaPicker', { selectedIds });
        },
    
        removeMedia(id) {
            if (this.multiple) {
                const removedIndex = this.mediaItems.findIndex(item => item.id === id);
                this.state = this.state.filter(itemId => itemId !== id);
                this.mediaItems = this.mediaItems.filter(item => item.id !== id);
                if (this.mediaItems.length === 0) {
                    this.currentIndex = 0;
                } else if (removedIndex < this.currentIndex) {
                    this.currentIndex = this.currentIndex - 1;
                } else if (this.currentIndex >= this.mediaItems.length) {
                    this.currentIndex = this.mediaItems.length - 1;
                }
            } else {
                this.state = null;
                this.mediaItems = [];
            }
        },
    
        prev() {
            if (this.currentIndex > 0) this.currentIndex--;
        },
    
        next() {
            if (this.currentIndex < this.mediaItems.length - 1) this.currentIndex++;
        }
    }" class="space-y-2">

        <!-- Media preview card -->
        <template x-if="mediaItems && mediaItems.length > 0">
            <div class="rounded-lg overflow-hidden border border-gray-200">

                <!-- Image preview with navigation arrows -->
                <div class="bg-gray-100 relative">
                    <template
                        x-if="mediaItems[currentIndex].mime_type && mediaItems[currentIndex].mime_type.startsWith('image/')">
                        <img :src="mediaItems[currentIndex].url" :alt="mediaItems[currentIndex].name"
                            class="w-full h-48 object-contain">
                    </template>
                    <template
                        x-if="!mediaItems[currentIndex].mime_type || !mediaItems[currentIndex].mime_type.startsWith('image/')">
                        <div class="w-full h-48 flex flex-col items-center justify-center text-gray-400 gap-2">
                            <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </template>

                    <!-- Navigation arrows (only when multiple items) -->
                    <template x-if="mediaItems.length > 1">
                        <div>
                            <button type="button" @click="prev()" :disabled="currentIndex === 0"
                                class="absolute left-2 top-1/2 -translate-y-1/2 p-1.5 bg-white/80 border border-gray-200 rounded-md text-gray-500 hover:text-gray-700 hover:bg-white disabled:opacity-30 shadow-sm transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>
                            <button type="button" @click="next()" :disabled="currentIndex === mediaItems.length - 1"
                                class="absolute right-2 top-1/2 -translate-y-1/2 p-1.5 bg-white/80 border border-gray-200 rounded-md text-gray-500 hover:text-gray-700 hover:bg-white disabled:opacity-30 shadow-sm transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </template>

                    <!-- Action toolbar -->
                    <div class="absolute bottom-0 left-0 right-0 px-3 py-2 flex items-center justify-center gap-2">
                        <!-- Replace/Add button -->
                        <button type="button" @click="openPicker()"
                            class="p-2 bg-white border border-gray-200 rounded-md text-gray-500 hover:text-blue-600 hover:border-blue-300 hover:bg-blue-50 transition-colors shadow-sm"
                            title="{{ __('media.field.replace') }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                        </button>

                        <!-- View URL button -->
                        <a :href="mediaItems[currentIndex].url" target="_blank"
                            class="p-2 bg-white border border-gray-200 rounded-md text-gray-500 hover:text-gray-700 hover:border-gray-300 hover:bg-gray-50 transition-colors shadow-sm"
                            title="{{ __('media.field.view_file') }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                            </svg>
                        </a>

                        <!-- Remove button -->
                        <button type="button" @click="removeMedia(mediaItems[currentIndex].id)"
                            class="p-2 bg-white border border-gray-200 rounded-md text-gray-500 hover:text-red-600 hover:border-red-300 hover:bg-red-50 transition-colors shadow-sm"
                            title="{{ __('media.field.remove') }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                </div>



                <!-- File name + counter -->
                <div class="px-3 py-1.5 bg-white border-t border-gray-100 flex items-center gap-2 text-center">
                    <p class="text-xs text-gray-500 truncate flex-1" x-text="mediaItems[currentIndex].file_name"></p>
                    <template x-if="mediaItems.length > 1">
                        <span class="text-xs text-gray-400 shrink-0"
                            x-text="(currentIndex + 1) + ' / ' + mediaItems.length"></span>
                    </template>
                </div>
            </div>
        </template>

        <!-- Add Media Button: only show when no media selected -->
        <template x-if="!mediaItems || mediaItems.length === 0">
            <div class="flex items-center justify-center w-full">
                <button type="button" @click="openPicker()"
                    class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-white hover:bg-gray-50 transition-colors">
                    <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <p class="text-sm text-gray-500 font-medium">{{ __('media.field.click_to_add') }}</p>
                </button>
            </div>
        </template>
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
