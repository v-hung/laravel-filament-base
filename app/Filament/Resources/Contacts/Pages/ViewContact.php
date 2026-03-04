<?php

namespace App\Filament\Resources\Contacts\Pages;

use App\Filament\Resources\Contacts\ContactResource;
use App\Models\Contact;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\DB;

class ViewContact extends ViewRecord
{
    protected static string $resource = ContactResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function afterMount(): void
    {
        /** @var Contact $record */
        $record = $this->getRecord();

        if (! $record->isRead()) {
            DB::table('contacts')
                ->where('id', $record->id)
                ->update(['read_at' => now()]);
        }
    }
}
