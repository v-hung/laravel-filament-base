<?php

namespace App\Livewire;

use App\Livewire\Concerns\InteractsWithMedia;
use App\Models\Media;
use App\Models\Media\MediaFolder;
use App\Repositories\MediaRepository;
use App\Services\MediaService;
use Filament\Notifications\Notification;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class MediaPickerModal extends Component
{
	use InteractsWithMedia, WithFileUploads, WithPagination;

	protected MediaRepository $mediaRepository;

	protected MediaService $mediaService;

	public bool $isOpen = false;

	public string $currentModal = 'browse'; // 'browse', 'detail', 'create-folder', 'upload'

	public ?string $previousModal = null; // Lưu modal trước đó để xử lý click outside

	public bool $multiple = false;

	public array $selected = [];

	public ?string $collection = null;

	public string $view = 'browse'; // 'browse', 'selected' (chỉ cho browse modal)

	public string $search = '';

	public $uploadedFiles = [];

	public string $mode = 'picker'; // 'picker' or 'manager'

	public string $newFolderName = '';

	public ?int $currentFolder = null;

	public ?int $browsingFolderId = null; // Folder đang xem trong browse mode

	// Detail modal properties
	public ?int $detailMediaId = null;

	public string $detailFileName = '';

	public string $detailAltText = '';

	public string $detailCaption = '';

	public string $detailLocation = '';

	public $replacementFile = null;

	protected $listeners = [
		'openMediaPicker' => 'open',
		'closeMediaPicker' => 'close',
		'openMediaDetail' => 'openMediaDetail',
		'openFolderCreator' => 'openCreateFolder',
		'openAssetUploader' => 'openUploadAsset',
	];

	public function boot(MediaRepository $mediaRepository, MediaService $mediaService): void
	{
		$this->mediaRepository = $mediaRepository;
		$this->mediaService = $mediaService;
	}

	public function mount(bool $multiple = false, ?string $collection = null): void
	{
		$this->multiple = $multiple;
		$this->collection = $collection;
	}

	public function open(array $selectedIds = []): void
	{
		$this->isOpen = true;
		$this->currentModal = 'browse';
		$this->selected = $selectedIds;
		$this->view = 'browse';
	}

	public function close(): void
	{
		$this->isOpen = false;
		$this->currentModal = 'browse';
		$this->previousModal = null;
		$this->reset(['selected', 'search', 'uploadedFiles', 'view', 'mode', 'newFolderName', 'currentFolder', 'browsingFolderId', 'detailMediaId', 'detailFileName', 'detailAltText', 'detailCaption', 'detailLocation', 'replacementFile']);
	}

	public function openCreateFolder(?int $folderId = null): void
	{
		$this->isOpen = true;
		$this->mode = 'manager';
		$this->previousModal = null; // Mở trực tiếp, không có modal trước
		$this->currentModal = 'create-folder';
		$this->currentFolder = $folderId;
		$this->browsingFolderId = $folderId;
	}

	public function openCreateFolderModal(): void
	{
		$this->previousModal = $this->currentModal; // Lưu modal hiện tại
		$this->currentFolder = $this->browsingFolderId; // Set folder context

		$this->currentModal = 'create-folder';
	}

	public function openUploadAsset(?int $folderId = null): void
	{
		$this->isOpen = true;
		$this->mode = 'manager';
		$this->previousModal = null; // Mở trực tiếp, không có modal trước
		$this->currentModal = 'upload';
		$this->currentFolder = $folderId;
	}

	public function openUploadModal(): void
	{
		$this->previousModal = $this->currentModal; // Lưu modal hiện tại
		$this->currentFolder = $this->browsingFolderId; // Set folder context
		$this->currentModal = 'upload';
	}

	public function closeModal(): void
	{
		// Nếu có modal trước đó, quay về modal đó
		if ($this->previousModal) {
			$this->currentModal = $this->previousModal;
			$this->previousModal = null;
			// Clear data của modal đang đóng
			$this->reset(['newFolderName', 'uploadedFiles', 'replacementFile']);
		} else {
			// Nếu không có modal trước, đóng hẳn
			$this->close();
		}
	}

	public function switchView(string $view): void
	{
		$this->view = $view;
	}

	public function createFolder(): void
	{
		$this->validate([
			'newFolderName' => [
				'required',
				'string',
				'max:255',
				'regex:/^[a-zA-Z0-9\s\-_]+$/',
			],
		], [
			'newFolderName.regex' => 'Folder name can only contain letters, numbers, spaces, hyphens, and underscores.',
		]);

		// Kiểm tra tên folder trùng trong cùng parent
		$exists = MediaFolder::where('name', $this->newFolderName)
			->where('parent_id', $this->currentFolder)
			->exists();

		if ($exists) {
			$this->addError('newFolderName', 'A folder with this name already exists in this location.');

			return;
		}

		try {
			$this->mediaRepository->createFolder($this->newFolderName, $this->currentFolder);

			Notification::make()
				->title('Folder created successfully')
				->success()
				->send();

			$this->dispatch('folderCreated');
			$this->closeModal();
		} catch (\Exception $e) {
			Notification::make()
				->title('Failed to create folder')
				->body($e->getMessage())
				->danger()
				->send();
		}
	}

	public function toggleSelect(int $mediaId): void
	{
		if ($this->multiple) {
			if (in_array($mediaId, $this->selected)) {
				$this->selected = array_values(array_filter($this->selected, fn($id) => $id !== $mediaId));
			} else {
				$this->selected[] = $mediaId;
			}
		} else {
			$this->selected = [$mediaId];
		}
	}

	public function isSelected(int $mediaId): bool
	{
		return in_array($mediaId, $this->selected);
	}

	public function navigateToFolder(?int $folderId): void
	{
		$this->browsingFolderId = $folderId;
		$this->resetPage(); // Reset pagination khi đổi folder
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

	public function confirmDeleteMedia(int $mediaId): void
	{
		$this->dispatch('open-confirm-modal', [
			'title' => 'Delete Media',
			'message' => 'Are you sure you want to delete this media? This action cannot be undone.',
			'callback' => 'deleteMedia',
			'params' => ['mediaId' => $mediaId],
		]);
	}

	public function confirm(): void
	{
		$this->dispatch('mediaSelected', $this->selected);
		$this->close();
	}

	public function uploadFiles(): void
	{
		$this->validate([
			'uploadedFiles.*' => 'required|file|max:10240',
		]);

		try {
			foreach ($this->uploadedFiles as $file) {
				$media = $this->mediaService->createMediaFromUpload(
					$file,
					$this->collection ?? 'default',
					$this->currentFolder
				);

				if ($this->mode === 'picker') {
					$this->selected[] = $media->id;
				}
			}

			Notification::make()
				->title('Files uploaded successfully')
				->success()
				->send();

			$this->dispatch('assetUploaded');
			$this->closeModal();
		} catch (\Exception $e) {
			Notification::make()
				->title('Failed to upload files')
				->body($e->getMessage())
				->danger()
				->send();
		} finally {
			$this->uploadedFiles = [];
		}
	}

	public function openMediaDetail(int $mediaId, ?string $source = null): void
	{
		$media = $this->mediaRepository->getMediaById($mediaId);

		if (! $media) {
			Notification::make()
				->title('Media not found')
				->danger()
				->send();

			return;
		}

		if ($source === 'picker') {
			$this->previousModal = $this->currentModal;
			$this->isOpen = true;
		} else {
			$this->isOpen = true;
			$this->mode = 'manager';
			$this->previousModal = null;
		}

		$this->detailMediaId = $mediaId;
		$this->detailFileName = $media->name;
		$this->detailAltText = $media->getCustomProperty('alt_text', '');
		$this->detailCaption = $media->getCustomProperty('caption', '');

		// Get folder location
		if ($media->folder_id) {
			$folder = $this->mediaRepository->getFolder($media->folder_id);
			$this->detailLocation = $folder?->name ?? 'Root';
		} else {
			$this->detailLocation = 'Root';
		}

		$this->currentModal = 'detail';
	}

	public function closeDetailModal(): void
	{
		if ($this->previousModal) {
			$this->currentModal = $this->previousModal;
			$this->previousModal = null;
		} else {
			$this->close();
		}

		$this->reset([
			'detailMediaId',
			'detailFileName',
			'detailAltText',
			'detailCaption',
			'detailLocation',
			'replacementFile',
		]);
	}

	public function saveMediaDetails(): void
	{
		$this->validate([
			'detailFileName' => 'required|string|max:255',
		]);

		$media = $this->mediaRepository->getMediaById($this->detailMediaId);

		if ($media) {
			try {
				$media->name = $this->detailFileName;
				$media->setCustomProperty('alt_text', $this->detailAltText);
				$media->setCustomProperty('caption', $this->detailCaption);
				$media->save();

				Notification::make()
					->title('Media details updated successfully')
					->success()
					->send();

				$this->closeDetailModal();
			} catch (\Exception $e) {
				Notification::make()
					->title('Failed to update media details')
					->body($e->getMessage())
					->danger()
					->send();
			}
		}
	}

	public function replaceMedia(): void
	{
		$this->validate([
			'replacementFile' => 'required|file|max:10240',
		]);

		$media = $this->mediaRepository->getMediaById($this->detailMediaId);

		if (! $media) {
			return;
		}

		try {
			$newMedia = $this->mediaService->replaceMedia(
				$media,
				$this->replacementFile,
				$this->detailFileName,
				[
					'alt_text' => $this->detailAltText,
					'caption' => $this->detailCaption,
				]
			);

			$this->detailMediaId = $newMedia->id;

			Notification::make()
				->title('Media replaced successfully')
				->success()
				->send();

			$this->dispatch('assetUploaded'); // Reload media browser
			$this->closeDetailModal();
		} catch (\Exception $e) {
			Notification::make()
				->title('Failed to replace media')
				->body($e->getMessage())
				->danger()
				->send();
		}
	}

	public function deleteDetailMedia(): void
	{
		$media = $this->mediaRepository->getMediaById($this->detailMediaId);

		if ($media) {
			try {
				$this->mediaService->deleteMedia($media);
				$this->selected = array_values(array_filter($this->selected, fn($id) => $id !== $this->detailMediaId));

				Notification::make()
					->title('Media deleted successfully')
					->success()
					->send();

				$this->closeDetailModal();
				$this->dispatch('assetUploaded');
			} catch (\Exception $e) {
				Notification::make()
					->title('Failed to delete media')
					->body($e->getMessage())
					->danger()
					->send();
			}
		}
	}

	public function getDetailMedia()
	{
		return $this->detailMediaId ? $this->mediaRepository->getMediaById($this->detailMediaId) : null;
	}

	public function getImageInfoProperty(): ?array
	{
		$media = $this->getDetailMedia();

		return $media?->dimensions();
	}

	public function deleteMedia(int $mediaId): void
	{
		$media = $this->mediaRepository->getMediaById($mediaId);

		if ($media) {
			try {
				$this->mediaService->deleteMedia($media);
				$this->selected = array_values(array_filter($this->selected, fn($id) => $id !== $mediaId));

				Notification::make()
					->title('Media deleted successfully')
					->success()
					->send();

				$this->dispatch('assetUploaded');
			} catch (\Exception $e) {
				Notification::make()
					->title('Failed to delete media')
					->body($e->getMessage())
					->danger()
					->send();
			}
		}
	}

	public function render()
	{
		$mediaQuery = Media::query()
			->when(
				$this->browsingFolderId,
				fn($query) => $query->where('folder_id', $this->browsingFolderId)
			)
			->when(
				is_null($this->browsingFolderId),
				fn($query) => $query->whereNull('folder_id')
			)
			->when(
				$this->search,
				fn($query) => $query->where('name', 'like', '%' . $this->search . '%')
					->orWhere('file_name', 'like', '%' . $this->search . '%')
			)
			->when(
				$this->collection,
				fn($query) => $query->where('collection_name', $this->collection)
			)
			->latest();

		// Get folders in current browsing location
		$folders = $this->mode === 'manager'
			? $this->mediaRepository->getFolders($this->browsingFolderId)
			: collect();

		// Get breadcrumb path - use currentFolder for create/upload modals, browsingFolderId for browse
		$folderId = in_array($this->currentModal, ['create-folder', 'upload'])
			? $this->currentFolder
			: $this->browsingFolderId;

		$breadcrumbs = $folderId
			? $this->mediaRepository->getFolderPath($folderId)
			: [];

		return view('livewire.media-picker-modal', [
			'mediaItems' => $mediaQuery->paginate(12),
			'folders' => $folders,
			'breadcrumbs' => $breadcrumbs,
		]);
	}
}
