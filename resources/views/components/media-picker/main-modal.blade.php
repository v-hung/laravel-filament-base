@props(['view', 'mode', 'selected', 'mediaItems', 'search', 'folders' => [], 'breadcrumbs' => []])

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
    <x-confirm-modal name="confirm-modal" />

    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
        wire:click.self="closeModal">

        {{-- <!-- Background overlay -->
        <div class="fixed inset-0 bg-gray-500/75 dark:bg-gray-900/80 transition-opacity -z-10"></div> --}}

        <!-- Modal panel -->
        <div
            class="relative inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-6xl sm:w-full">

            <x-media-picker.header :title="'Add new assets'" />

            <!-- Breadcrumb Navigation -->
            @if ($mode === 'manager' && (count($breadcrumbs) > 0 || $view === 'browse'))
                <div class="bg-white px-6 py-3 border-b border-gray-200">
                    <nav class="flex items-center text-sm">
                        <button wire:click="navigateToFolder(null)"
                            class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                            </svg>
                        </button>
                        @foreach ($breadcrumbs as $crumb)
                            <svg class="h-5 w-5 mx-2 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                            <button wire:click="navigateToFolder({{ $crumb['id'] }})"
                                class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
                                {{ $crumb['name'] }}
                            </button>
                        @endforeach
                    </nav>
                </div>
            @endif

            <!-- Tabs: Browse & Selected -->
            <div class="border-b border-gray-200 bg-white px-6">
                <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                    <button wire:click="switchView('browse')"
                        class="@if ($view === 'browse') border-primary-500 text-primary-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm uppercase">
                        Browse
                    </button>
                    <button wire:click="switchView('selected')"
                        class="@if ($view === 'selected') border-primary-500 text-primary-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm uppercase">
                        Selected Files
                        @if (count($selected) > 0)
                            <span
                                class="ml-2 bg-primary-100 text-primary-600 py-0.5 px-2 rounded-full text-xs">{{ count($selected) }}</span>
                        @endif
                    </button>
                </nav>
            </div>

            <!-- Action Buttons -->
            <div class="bg-white px-6 py-3 border-b border-gray-200 flex gap-2 justify-end">
                @if ($mode === 'manager')
                    <button wire:click="openCreateFolderModal"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                        </svg>
                        New Folder
                    </button>
                @endif
                <button wire:click="openUploadModal"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700">
                    <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Upload Files
                </button>
            </div>

            <!-- Content -->
            <div class="bg-gray-50 px-6 py-4" style="min-height: 500px; max-height: 600px; overflow-y: auto;">
                @if ($view === 'browse' || $view === 'selected')
                    <!-- Show folders first if in manager mode -->
                    @if ($mode === 'manager' && $view === 'browse' && count($folders) > 0)
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 mb-6">
                            @foreach ($folders as $folder)
                                <x-media-picker.folder-card :folder="$folder"
                                    wire:click="navigateToFolder({{ $folder->id }})" />
                            @endforeach
                        </div>
                    @endif

                    <x-media-picker.browse-selected-content :view="$view" :mediaItems="$mediaItems" :search="$search"
                        :selected="$selected" />
                @endif
            </div>

            <x-media-picker.footer :mode="$mode" />
        </div>
    </div>
</div>
