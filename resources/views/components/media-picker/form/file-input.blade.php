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

    <div
        class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-8 text-center hover:border-primary-400 dark:hover:border-primary-500 transition-colors bg-white dark:bg-gray-800 {{ $error ? 'border-red-500 dark:border-red-500' : '' }}">
        <label class="cursor-pointer">
            <input type="file" id="{{ $name }}" name="{{ $name }}" accept="{{ $accept }}"
                {{ $multiple ? 'multiple' : '' }} class="hidden" {{ $attributes }}>
            <div>
                <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                    <span
                        class="font-medium text-primary-600 hover:text-primary-500 dark:text-primary-400 dark:hover:text-primary-300">
                        Click to upload
                    </span>
                    or drag and drop
                </p>
                <p class="text-xs text-gray-500 dark:text-gray-400">
                    {{ $slot->isNotEmpty() ? $slot : 'PNG, JPG, GIF up to 10MB' }}
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
