@props(['view', 'selected', 'mediaItems', 'folders' => [], 'breadcrumbs' => []])

<div class="fixed inset-0 z-50 overflow-y-auto bg-gray-500/75 dark:bg-gray-900/80 transition-opacity"
    aria-labelledby="modal-title" role="dialog" aria-modal="true" x-data="{
        init() {
            document.body.classList.add('overflow-hidden');
            const observer = new MutationObserver(() => {
                if (!document.body.contains(this.$el)) {
                    document.body.classList.remove('overflow-hidden');
                    observer.disconnect();
                }
            });
            observer.observe(document.body, { childList: true, subtree: true });
        }
    }">
    {{-- Confirmation Modal --}}
    <x-confirm-modal name="picker-confirm-modal" />

    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
        wire:click.self="closeModal">

        {{-- <!-- Background overlay -->
        <div class="fixed inset-0 bg-gray-500/75 dark:bg-gray-900/80 transition-opacity -z-10"></div> --}}

        <!-- Modal panel -->
        <div
            class="relative inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-6xl sm:w-full">

            <x-media-picker.header :title="__('media.picker.title')" />

            <!-- Tabs: Browse & Selected -->
            <div class="border-b border-gray-200 bg-white px-6">
                <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                    <button wire:click="switchView('browse')"
                        class="@if ($view === 'browse') border-primary-500 text-primary-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm uppercase">
                        {{ __('media.picker.tab_browse') }}
                    </button>
                    <button wire:click="switchView('selected')"
                        class="@if ($view === 'selected') border-primary-500 text-primary-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm uppercase">
                        {{ __('media.picker.tab_selected') }}
                        @if (count($selected) > 0)
                            <span
                                class="ml-2 bg-primary-100 text-primary-600 py-0.5 px-2 rounded-full text-xs">{{ count($selected) }}</span>
                        @endif
                    </button>
                </nav>
            </div>

            <!-- Content -->
            <div class="bg-gray-50 px-6 py-4" style="min-height: 500px; max-height: 600px; overflow-y: auto;">
                @if ($view === 'browse')
                    <x-media-picker.browser-panel :folders="$folders" :mediaItems="$mediaItems" variant="picker" :selected="$selected"
                        :breadcrumbs="$breadcrumbs" />
                @else
                    <div class="text-center py-12">
                        <svg class="mx-auto h-16 w-16 text-gray-400 dark:text-gray-500" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">
                            @if (count($selected) > 0)
                                {{ __('media.picker.files_selected', ['count' => count($selected)]) }}
                            @else
                                {{ __('media.picker.no_files_selected') }}
                            @endif
                        </h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            @if (count($selected) > 0)
                                {{ __('media.picker.click_finish') }}
                            @else
                                {{ __('media.picker.go_to_browse') }}
                            @endif
                        </p>
                    </div>

                    @if (count($selected) > 0)
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 mt-6">
                            @foreach (\App\Models\Media::whereIn('id', $selected)->get() as $media)
                                <div
                                    class="relative bg-white dark:bg-gray-800 border-2 border-primary-600 dark:border-primary-500 rounded-lg overflow-hidden">
                                    <div
                                        class="aspect-square bg-gray-100 dark:bg-gray-900 flex items-center justify-center">
                                        @if (str_starts_with($media->mime_type ?? '', 'image/'))
                                            <img src="{{ $media->getUrl() }}" alt="{{ $media->name }}"
                                                class="w-full h-full object-cover">
                                        @else
                                            <svg class="w-12 h-12 text-gray-400 dark:text-gray-500" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="p-2 bg-white dark:bg-gray-900">
                                        <p class="text-xs font-medium text-gray-900 dark:text-white truncate">
                                            {{ $media->name }}</p>
                                    </div>
                                    <button wire:click="toggleSelect({{ $media->id }})"
                                        class="absolute top-2 right-2 p-1 bg-red-600 text-white rounded-full hover:bg-red-700 dark:bg-red-700 dark:hover:bg-red-600">
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
            </div>

            <div
                class="bg-gray-50 dark:bg-gray-900 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-gray-200 dark:border-gray-700 gap-4">
                <x-media-picker.form.button type="button" wire:click="confirm" variant="primary">
                    {{ __('media.picker.confirm_selection') }}
                </x-media-picker.form.button>
                <x-media-picker.form.button type="button" wire:click="closeModal" variant="secondary">
                    {{ __('media.cancel') }}
                </x-media-picker.form.button>
            </div>
        </div>
    </div>
</div>
