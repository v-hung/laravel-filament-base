<div class="flex flex-col gap-10 {{ $imageOnLeft ? 'lg:flex-row-reverse' : 'lg:flex-row' }} lg:gap-20">
    <div class="flex flex-1 flex-col gap-6">
        @if ($title)
            <h2 class="text-h-32-bold text-duyang-black lg:text-h-40-bold">
                {{ $title }}
            </h2>
        @endif
        @if ($text)
            <p class="text-p-16-regular whitespace-pre-line text-duyang-grey">
                {{ $text }}
            </p>
        @endif
    </div>
    <div class="flex-1 overflow-hidden rounded">
        @if ($imageUrl)
            <img src="{{ $imageUrl }}" alt="{{ $imageAlt }}"
                class="h-full min-h-80 w-full bg-duyang-cream object-cover" />
        @endif
    </div>
</div>
