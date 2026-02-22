<?php

namespace App\Livewire\Concerns;

use Filament\Notifications\Notification;

trait InteractsWithMedia
{
    public function deleteMedia(int $mediaId): void
    {
        if ($this->mediaRepository->deleteMedia($mediaId)) {
            Notification::make()
                ->title(__('media.notifications.media_deleted'))
                ->success()
                ->send();

            $this->dispatch('assetUploaded');
        }
    }

    public function deleteFolder(int $folderId): void
    {
        try {
            $folder = $this->mediaRepository->getFolder($folderId);

            if (! $folder) {
                Notification::make()
                    ->title(__('media.notifications.folder_not_found'))
                    ->danger()
                    ->send();

                return;
            }

            // Delete folder and its contents (including media files)
            $this->mediaRepository->deleteFolder($folderId, true);

            Notification::make()
                ->title(__('media.notifications.folder_deleted'))
                ->body(__('media.notifications.all_contents_deleted'))
                ->success()
                ->send();

            $this->dispatch('assetUploaded');
        } catch (\Exception $e) {
            Notification::make()
                ->title(__('media.notifications.error_deleting_folder'))
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    public function getFolderBreadcrumbs(?int $folderId): array
    {
        if (! $folderId) {
            return [];
        }

        return $this->mediaRepository->getFolderPath($folderId);
    }
}
