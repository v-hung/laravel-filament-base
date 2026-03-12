<div style="display: flex; gap: 1rem; flex-direction: {{ $imageOnLeft ? 'row-reverse' : 'row' }}; border: 1px dashed #ccc; padding: 0.75rem; border-radius: 0.375rem;">
    <div style="flex: 1; min-width: 0;">
        @if ($title)
            <strong style="display: block; font-size: 0.875rem; margin-bottom: 0.25rem;">{{ $title }}</strong>
        @endif
        @if ($text)
            <p style="font-size: 0.75rem; color: #6b7280; overflow: hidden; max-height: 4rem; white-space: pre-line;">{{ $text }}</p>
        @endif
    </div>
    <div style="flex: 1; min-width: 0;">
        @if ($imageUrl)
            <img src="{{ $imageUrl }}" alt="" style="width: 100%; height: 6rem; object-fit: cover; border-radius: 0.25rem;" />
        @else
            <div style="background: #f3f4f6; height: 6rem; border-radius: 0.25rem; display: flex; align-items: center; justify-content: center; color: #9ca3af; font-size: 0.75rem;">
                Image
            </div>
        @endif
    </div>
</div>
