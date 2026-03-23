<?php

namespace App\Filament\Forms\Components;

/**
 * A dehydrated variant of MediaPicker for use inside Repeaters.
 *
 * Unlike MediaPicker (which persists via Spatie Media Library relationships),
 * MediaPickerInline stores the selected media ID directly in form state so it
 * can be serialised as part of a Repeater's JSON payload (e.g. sections JSON).
 */
class MediaPickerInline extends MediaPicker
{
    protected function setUp(): void
    {
        parent::setUp();

        // Allow the ID to flow through form dehydration into the repeater data.
        $this->dehydrated(true);

        // State is already in the form data (the stored media ID); nothing to load.
        $this->loadStateFromRelationshipsUsing(function (): void {});

        // ID is persisted via the parent form's sections JSON; skip relationship save.
        $this->saveRelationshipsUsing(function (): void {});
    }
}
