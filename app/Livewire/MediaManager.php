<?php

namespace App\Livewire;

use App\Livewire\Concerns\InteractsWithMedia;
use App\Livewire\Concerns\InteractsWithMediaBrowser;
use App\Repositories\MediaRepository;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class MediaManager extends Component
{
    use InteractsWithMedia;
    use InteractsWithMediaBrowser;
    use WithFileUploads;
    use WithPagination;

    public string $search = '';

    public ?int $currentFolderId = null;

    public string $sortBy = 'created_at';

    public string $sortDirection = 'desc';

    protected MediaRepository $mediaRepository;

    protected $listeners = [
        'folderCreated' => '$refresh',
        'assetUploaded' => '$refresh',
    ];

    public function boot(MediaRepository $mediaRepository): void
    {
        $this->mediaRepository = $mediaRepository;
    }

    public function mount(): void
    {
        //
    }

    public function openFolderCreator(): void
    {
        $this->dispatch('openFolderCreator', folderId: $this->currentFolderId);
    }

    public function openAssetUploader(): void
    {
        $this->dispatch('openAssetUploader', folderId: $this->currentFolderId);
    }

    public function confirmDeleteMedia(int $mediaId): void
    {
        $this->dispatch('open-confirm-modal', [
            'title' => __('media.confirm.delete_media_title'),
            'message' => __('media.confirm.delete_media_message'),
            'callback' => 'deleteMedia',
            'params' => ['mediaId' => $mediaId],
        ]);
    }

    public function confirmDeleteFolder(int $folderId): void
    {
        $this->dispatch('open-confirm-modal', [
            'title' => __('media.confirm.delete_folder_title'),
            'message' => __('media.confirm.delete_folder_message'),
            'callback' => 'deleteFolder',
            'params' => ['folderId' => $folderId],
        ]);
    }

    public function getCurrentFolder()
    {
        return $this->currentFolderId ? $this->mediaRepository->getFolder($this->currentFolderId) : null;
    }

    public function getFolderPath(): array
    {
        if (! $this->currentFolderId) {
            return [];
        }

        return $this->mediaRepository->getFolderPath($this->currentFolderId);
    }

    public function render()
    {
        $browser = $this->resolveMediaBrowserData(perPage: 24);

        return view('livewire.media-manager', [
            'mediaItems' => $browser['mediaItems'],
            'folders' => $browser['folders'],
            'currentFolder' => $browser['currentFolder'],
            'folderPath' => $browser['folderPath'],
            'totalCount' => $this->mediaRepository->getTotalMediaCount(),
        ]);
    }
}
