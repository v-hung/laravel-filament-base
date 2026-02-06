@props(['mode'])

<div
    class="bg-gray-50 dark:bg-gray-900 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-gray-200 dark:border-gray-700 gap-4">
    @if ($mode === 'picker')
        <x-media-picker.form.button type="button" wire:click="confirm" variant="primary">
            Confirm Selection
        </x-media-picker.form.button>
    @endif
    <x-media-picker.form.button type="button" wire:click="closeModal" variant="secondary">
        {{ $mode === 'picker' ? 'Cancel' : 'Close' }}
    </x-media-picker.form.button>
</div>
