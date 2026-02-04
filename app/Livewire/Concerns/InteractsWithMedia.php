<?php

namespace App\Livewire\Concerns;

use Filament\Notifications\Notification;

trait InteractsWithMedia
{
	public function deleteMedia(int $mediaId): void
	{
		if ($this->mediaRepository->deleteMedia($mediaId)) {
			Notification::make()
				->title('Media deleted successfully')
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
					->title('Folder not found')
					->danger()
					->send();

				return;
			}

			// Delete folder and move contents to parent
			$this->mediaRepository->deleteFolder($folderId, false);

			Notification::make()
				->title('Folder deleted successfully')
				->body('Contents moved to parent folder')
				->success()
				->send();

			$this->dispatch('assetUploaded');
		} catch (\Exception $e) {
			Notification::make()
				->title('Error deleting folder')
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
