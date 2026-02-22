<?php

namespace App\Livewire\Concerns;

trait InteractsWithMediaBrowser
{
    protected function browserFolderProperty(): string
    {
        return 'currentFolderId';
    }

    protected function getBrowserFolderId(): ?int
    {
        $property = $this->browserFolderProperty();

        return property_exists($this, $property) ? $this->{$property} : null;
    }

    protected function setBrowserFolderId(?int $folderId): void
    {
        $property = $this->browserFolderProperty();

        if (property_exists($this, $property)) {
            $this->{$property} = $folderId;
        }
    }

    public function enterFolder(int $folderId): void
    {
        $this->navigateToFolder($folderId);
    }

    public function navigateToFolder(?int $folderId): void
    {
        $this->setBrowserFolderId($folderId);
        $this->resetPage();
    }

    public function goToParentFolder(): void
    {
        $folderId = $this->getBrowserFolderId();
        $folder = $folderId ? $this->mediaRepository->getFolder($folderId) : null;

        if ($folder && $folder->parent_id) {
            $this->setBrowserFolderId($folder->parent_id);
        } else {
            $this->setBrowserFolderId(null);
        }

        $this->resetPage();
    }

    public function goToRootFolder(): void
    {
        $this->setBrowserFolderId(null);
        $this->resetPage();
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function changeSorting(string $field): void
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
    }

    protected function resolveMediaBrowserData(
        int $perPage = 24,
        ?string $collection = null,
        bool $includeFolders = true,
        ?int $breadcrumbsFolderId = null
    ): array {
        $folderId = $this->getBrowserFolderId();

        $mediaItems = $this->mediaRepository->getMedia(
            folderId: $folderId,
            search: $this->search,
            sortBy: $this->sortBy,
            sortDirection: $this->sortDirection,
            perPage: $perPage,
            collection: $collection,
        );

        $folders = $includeFolders
            ? $this->mediaRepository->getFolders($folderId)
            : collect();

        $currentFolder = $folderId
            ? $this->mediaRepository->getFolder($folderId)
            : null;

        $pathFolderId = $breadcrumbsFolderId ?? $folderId;

        $folderPath = $pathFolderId
            ? $this->mediaRepository->getFolderPath($pathFolderId)
            : [];

        return [
            'mediaItems' => $mediaItems,
            'folders' => $folders,
            'currentFolder' => $currentFolder,
            'folderPath' => $folderPath,
        ];
    }
}
