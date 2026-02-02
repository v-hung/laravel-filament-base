<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaPickerModal extends Component
{
	use WithFileUploads, WithPagination;

	public bool $isOpen = false;

	public bool $multiple = false;

	public array $selected = [];

	public ?string $collection = null;

	public string $view = 'browse'; // 'browse', 'upload', 'create-folder'

	public string $search = '';

	public $uploadedFiles = [];

	public string $mode = 'picker'; // 'picker' or 'manager'

	public string $newFolderName = '';

	public ?string $currentFolder = null;

	protected $listeners = [
		'openMediaPicker' => 'open',
		'closeMediaPicker' => 'close',
		'openFolderCreator' => 'openCreateFolder',
		'openAssetUploader' => 'openUploadAsset',
	];

	public function mount(bool $multiple = false, ?string $collection = null): void
	{
		$this->multiple = $multiple;
		$this->collection = $collection;
	}

	public function open(array $selectedIds = []): void
	{
		$this->isOpen = true;
		$this->selected = $selectedIds;
		$this->view = 'browse';
	}

	public function close(): void
	{
		$this->isOpen = false;
		$this->reset(['selected', 'search', 'uploadedFiles', 'view', 'mode', 'newFolderName', 'currentFolder']);
	}

	public function openCreateFolder(): void
	{
		$this->isOpen = true;
		$this->mode = 'manager';
		$this->view = 'create-folder';
	}

	public function openUploadAsset(?string $folder = null): void
	{
		$this->isOpen = true;
		$this->mode = 'manager';
		$this->view = 'upload';
		$this->currentFolder = $folder;
	}

	public function switchView(string $view): void
	{
		$this->view = $view;
	}

	public function createFolder(): void
	{
		$this->validate([
			'newFolderName' => 'required|string|max:255',
		]);

		// Tạo folder bằng cách tạo một media placeholder
		$media = new Media;
		$media->name = '.folder';
		$media->file_name = '.folder';
		$media->disk = 'public';
		$media->size = 0;
		$media->mime_type = 'folder';
		$media->collection_name = $this->newFolderName;
		$media->manipulations = [];
		$media->custom_properties = ['is_folder' => true];
		$media->generated_conversions = [];
		$media->responsive_images = [];
		$media->save();

		session()->flash('message', 'Folder created successfully!');
		$this->dispatch('folderCreated');
		$this->close();
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

		foreach ($this->uploadedFiles as $file) {
			$media = new Media;
			$media->name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
			$media->file_name = $file->getClientOriginalName();
			$media->disk = 'public';
			$media->size = $file->getSize();
			$media->mime_type = $file->getMimeType();
			$media->collection_name = $this->currentFolder ?? $this->collection ?? 'default';
			$media->manipulations = [];
			$media->custom_properties = [];
			$media->generated_conversions = [];
			$media->responsive_images = [];

			// Store file
			$path = $file->store('media', 'public');
			$media->file_name = basename($path);
			$media->save();

			if ($this->mode === 'picker') {
				$this->selected[] = $media->id;
			}
		}

		$this->uploadedFiles = [];

		if ($this->mode === 'manager') {
			session()->flash('message', 'Files uploaded successfully!');
			$this->dispatch('assetUploaded');
			$this->close();
		} else {
			$this->view = 'browse';
			session()->flash('message', 'Files uploaded successfully!');
		}
	}

	public function deleteMedia(int $mediaId): void
	{
		$media = Media::find($mediaId);

		if ($media) {
			$media->delete();
			$this->selected = array_values(array_filter($this->selected, fn($id) => $id !== $mediaId));
		}
	}

	public function render()
	{
		$mediaQuery = Media::query()
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

		return view('livewire.media-picker-modal', [
			'mediaItems' => $mediaQuery->paginate(12),
		]);
	}
}
