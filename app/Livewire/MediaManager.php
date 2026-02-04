<?php

namespace App\Livewire;

use App\Livewire\Concerns\InteractsWithMedia;
use App\Repositories\MediaRepository;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class MediaManager extends Component
{
	use InteractsWithMedia;
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

	public function enterFolder(int $folderId): void
	{
		$this->currentFolderId = $folderId;
		$this->resetPage();
	}

	public function goToParentFolder(): void
	{
		$folder = $this->mediaRepository->getFolder($this->currentFolderId);

		if ($folder && $folder->parent_id) {
			$this->currentFolderId = $folder->parent_id;
		} else {
			$this->currentFolderId = null;
		}

		$this->resetPage();
	}

	public function goToRootFolder(): void
	{
		$this->currentFolderId = null;
		$this->resetPage();
	}

	public function openFolderCreator(): void
	{
		$this->dispatch('openFolderCreator', folderId: $this->currentFolderId);
	}

	public function openAssetUploader(): void
	{
		$this->dispatch('openAssetUploader', folderId: $this->currentFolderId);
	}

	public function updatedSearch(): void
	{
		$this->resetPage();
	}

	public function confirmDeleteMedia(int $mediaId): void
	{
		$this->dispatch('open-confirm-modal', [
			'title' => 'Delete Media',
			'message' => 'Are you sure you want to delete this media? This action cannot be undone.',
			'callback' => 'deleteMedia',
			'params' => ['mediaId' => $mediaId],
		]);
	}

	public function confirmDeleteFolder(int $folderId): void
	{
		$this->dispatch('open-confirm-modal', [
			'title' => 'Delete Folder',
			'message' => 'Delete this folder? Contents will be moved to parent folder.',
			'callback' => 'deleteFolder',
			'params' => ['folderId' => $folderId],
		]);
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
		$folders = $this->mediaRepository->getFolders($this->currentFolderId);
		$mediaItems = $this->mediaRepository->getMedia(
			$this->currentFolderId,
			$this->search,
			$this->sortBy,
			$this->sortDirection,
			24
		);

		return view('livewire.media-manager', [
			'mediaItems' => $mediaItems,
			'folders' => $folders,
			'currentFolder' => $this->getCurrentFolder(),
			'folderPath' => $this->getFolderPath(),
			'totalCount' => $this->mediaRepository->getTotalMediaCount(),
		]);
	}
}
