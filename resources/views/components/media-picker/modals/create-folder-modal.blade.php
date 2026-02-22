@props(['newFolderName', 'breadcrumbs' => []])

<x-media-picker.base-modal title="{{ __('media.folder.create_title') }}" maxWidth="lg">
    <div class="text-center mb-6">
        <svg class="mx-auto h-16 w-16 text-primary-400 dark:text-primary-500" fill="none" stroke="currentColor"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
        </svg>
        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
            {{ __('media.folder.create_in') }}
            <span class="font-medium text-gray-700 dark:text-gray-300">
                @if (count($breadcrumbs) > 0)
                    {{ collect($breadcrumbs)->pluck('name')->join(' / ') }}
                @else
                    {{ __('media.root') }}
                @endif
            </span>
        </p>
    </div>

    <x-media-picker.form.input :label="__('media.folder.name_label')" name="folderName" wire:model="newFolderName" :placeholder="__('media.folder.name_placeholder')"
        required />

    <x-slot:footer>
        <x-media-picker.form.button type="button" wire:click="createFolder" variant="primary">
            {{ __('media.folder.create_btn') }}
        </x-media-picker.form.button>
        <x-media-picker.form.button type="button" wire:click="closeModal" variant="secondary">
            {{ __('media.cancel') }}
        </x-media-picker.form.button>
    </x-slot:footer>
</x-media-picker.base-modal>
