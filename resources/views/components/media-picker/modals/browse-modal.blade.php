@props(['view', 'selected', 'selectedItems', 'mediaItems', 'folders' => [], 'breadcrumbs' => []])

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
                    @if ($selectedItems->isEmpty())
                        <div class="text-center py-12">
                            <svg class="mx-auto h-16 w-16 text-gray-400 dark:text-gray-500" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">
                                {{ __('media.picker.no_files_selected') }}
                            </h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                {{ __('media.picker.go_to_browse') }}
                            </p>
                        </div>
                    @else
                        <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 gap-4">
                            @foreach ($selectedItems as $media)
                                <x-media-picker.media-card :media="$media" mode="picker" :isSelected="true"
                                    :showDelete="false" />
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
