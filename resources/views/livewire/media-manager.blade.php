<div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-900">
    {{-- Confirmation Modal --}}
    <x-confirm-modal name="confirm-modal" />

    <x-media-picker.browser-panel :folders="$folders" :mediaItems="$mediaItems" :breadcrumbs="$folderPath" variant="manager" />
</div>
