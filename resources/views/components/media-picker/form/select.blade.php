@props([
    'label' => null,
    'name' => null,
    'placeholder' => 'Select an option',
    'required' => false,
    'options' => [],
    'error' => null,
])

<div>
    @if ($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            {{ $label }}
            @if ($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    <select id="{{ $name }}" name="{{ $name }}"
        {{ $attributes->merge([
            'class' =>
                'shadow-sm focus:ring-primary-500 focus:ring-2 focus:border-primary-500 block w-full px-4 py-2.5 sm:text-sm border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white outline-none ' .
                ($error ? 'border-red-500 dark:border-red-500' : ''),
        ]) }}>
        @if ($placeholder)
            <option value="">{{ $placeholder }}</option>
        @endif

        @if ($slot->isEmpty())
            @foreach ($options as $value => $label)
                <option value="{{ $value }}">{{ $label }}</option>
            @endforeach
        @else
            {{ $slot }}
        @endif
    </select>

    @if ($error)
        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $error }}</p>
    @elseif ($attributes->has('wire:model'))
        @php
            $modelName = $attributes->whereStartsWith('wire:model')->first();
        @endphp
        @error($modelName)
            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    @endif
</div>
