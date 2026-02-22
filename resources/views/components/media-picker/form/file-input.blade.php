@props([
    'label' => null,
    'name' => null,
    'accept' => 'image/*',
    'multiple' => false,
    'error' => null,
])

<div>
    @if ($label)
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            {{ $label }}
        </label>
    @endif

    <div x-data="{ isDragging: false, dragCounter: 0 }" @dragenter.window.prevent="dragCounter++; isDragging = true"
        @dragleave.window="dragCounter--; if (dragCounter === 0) isDragging = false" @dragover.window.prevent
        @drop.window.prevent="
            dragCounter = 0;
            isDragging = false;
            const input = $el.querySelector('input[type=file]');
            const dt = new DataTransfer();
            Array.from($event.dataTransfer.files).forEach(f => dt.items.add(f));
            input.files = dt.files;
            input.dispatchEvent(new Event('change'));
        "
        :class="isDragging
            ?
            'border-primary-500 bg-primary-50 dark:bg-primary-900/20' :
            '{{ $error ? 'border-red-500 dark:border-red-500' : 'border-gray-300 dark:border-gray-600 hover:border-primary-400 dark:hover:border-primary-500' }} bg-white dark:bg-gray-800'"
        class="border-2 border-dashed rounded-lg text-center transition-colors duration-150 h-44 flex items-center justify-center {{ $error ? 'border-red-500 dark:border-red-500' : 'border-gray-300 dark:border-gray-600' }} bg-white dark:bg-gray-800">
        <label class="cursor-pointer w-full">
            <input type="file" id="{{ $name }}" name="{{ $name }}" accept="{{ $accept }}"
                {{ $multiple ? 'multiple' : '' }} class="hidden" {{ $attributes }}>
            <div class="pointer-events-none">
                <svg x-show="!isDragging" class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <svg x-show="isDragging" x-cloak class="mx-auto h-12 w-12 text-primary-500 dark:text-primary-400"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                </svg>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                    <span x-show="!isDragging"
                        class="font-medium text-primary-600 hover:text-primary-500 dark:text-primary-400 dark:hover:text-primary-300">
                        {{ __('media.upload.click_to_upload') }}
                    </span>
                    <span x-show="!isDragging">{{ __('media.upload.drag_and_drop') }}</span>
                    <span x-show="isDragging" x-cloak class="font-medium text-primary-600 dark:text-primary-400">
                        {{ __('media.upload.drop_here') }}
                    </span>
                </p>
                <p x-show="!isDragging" class="text-xs text-gray-500 dark:text-gray-400">
                    {{ $slot->isNotEmpty() ? $slot : __('media.upload.file_types') }}
                </p>
            </div>
        </label>
    </div>

    @if ($error)
        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $error }}</p>
    @elseif ($attributes->has('wire:model'))
        @php
            $modelName = $attributes->whereStartsWith('wire:model')->first();
        @endphp
        @error($modelName)
            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    @endif
</div>
