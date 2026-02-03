<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Livewire\WithFileUploads;

class MediaManager extends Component
{
	use WithPagination;
	use WithFileUploads;

	public string $activeTab = 'browse';

	public string $search = '';

	public array $selected = [];

	public ?string $collectionFilter = null;

	public string $sortBy = 'created_at';

	public string $sortDirection = 'desc';

	public string $viewMode = 'grid'; // grid or list

	// Detail modal properties
	public bool $showDetailModal = false;

	public ?int $detailMediaId = null;

	public string $detailFileName = '';

	public string $detailAltText = '';

	public string $detailCaption = '';

	public string $detailLocation = '';

	public $replacementFile = null;

	protected $listeners = [
		'folderCreated' => '$refresh',
		'assetUploaded' => '$refresh',
		'openMediaDetail' => 'openMediaDetail',
	];

	public function mount(): void
	{
		//
	}

	public function openFolderCreator(): void
	{
		$this->dispatch('openFolderCreator');
	}

	public function openAssetUploader(): void
	{
		$this->dispatch('openAssetUploader', folder: $this->collectionFilter);
	}

	public function updatedCollectionFilter(): void
	{
		$this->resetPage();
	}

	public function switchTab(string $tab): void
	{
		$this->activeTab = $tab;
	}

	public function toggleSelect(int $mediaId): void
	{
		if (in_array($mediaId, $this->selected)) {
			$this->selected = array_values(array_filter($this->selected, fn($id) => $id !== $mediaId));
		} else {
			$this->selected[] = $mediaId;
		}
	}

	public function selectAll(): void
	{
		$mediaIds = $this->getMediaQuery()->pluck('id')->toArray();
		$this->selected = array_unique(array_merge($this->selected, $mediaIds));
	}

	public function deselectAll(): void
	{
		$this->selected = [];
	}

	public function isSelected(int $mediaId): bool
	{
		return in_array($mediaId, $this->selected);
	}

	public function deleteSelected(): void
	{
		Media::whereIn('id', $this->selected)->delete();
		$this->selected = [];

		session()->flash('message', 'Selected media deleted successfully!');
	}

	public function deleteMedia(int $mediaId): void
	{
		$media = Media::find($mediaId);

		if ($media) {
			$media->delete();
			$this->selected = array_values(array_filter($this->selected, fn($id) => $id !== $mediaId));

			session()->flash('message', 'Media deleted successfully!');
		}
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

	public function setViewMode(string $mode): void
	{
		$this->viewMode = $mode;
	}

	public function openMediaDetail(int $mediaId): void
	{
		$media = Media::find($mediaId);

		if ($media) {
			$this->detailMediaId = $mediaId;
			$this->detailFileName = $media->name;
			$this->detailAltText = $media->getCustomProperty('alt_text', '');
			$this->detailCaption = $media->getCustomProperty('caption', '');
			$this->detailLocation = $media->collection_name;
			$this->showDetailModal = true;
		}
	}

	public function closeDetailModal(): void
	{
		$this->showDetailModal = false;
		$this->detailMediaId = null;
		$this->detailFileName = '';
		$this->detailAltText = '';
		$this->detailCaption = '';
		$this->detailLocation = '';
		$this->replacementFile = null;
	}

	public function saveMediaDetails(): void
	{
		$media = Media::find($this->detailMediaId);

		if ($media) {
			$media->name = $this->detailFileName;
			$media->setCustomProperty('alt_text', $this->detailAltText);
			$media->setCustomProperty('caption', $this->detailCaption);
			$media->collection_name = $this->detailLocation;
			$media->save();

			session()->flash('message', 'Media details updated successfully!');
			$this->closeDetailModal();
		}
	}

	public function replaceMedia(): void
	{
		$this->validate([
			'replacementFile' => 'required|file|max:10240', // 10MB max
		]);

		$media = Media::find($this->detailMediaId);

		if (!$media) {
			return;
		}

		try {
			// Store new file directly, similar to MediaPickerModal approach
			$newMedia = new Media;
			$newMedia->name = $this->detailFileName;
			$newMedia->file_name = $this->replacementFile->getClientOriginalName();
			$newMedia->disk = $media->disk;
			$newMedia->size = $this->replacementFile->getSize();
			$newMedia->mime_type = $this->replacementFile->getMimeType();
			$newMedia->collection_name = $this->detailLocation;
			$newMedia->manipulations = [];
			$newMedia->custom_properties = [
				'alt_text' => $this->detailAltText,
				'caption' => $this->detailCaption,
			];
			$newMedia->generated_conversions = [];
			$newMedia->responsive_images = [];

			// Store file
			$path = $this->replacementFile->store('media', 'public');
			$newMedia->file_name = basename($path);
			$newMedia->save();

			// Delete old media (this will automatically remove the old file)
			$media->delete();

			// Update detailMediaId to new media for proper modal state
			$this->detailMediaId = $newMedia->id;

			session()->flash('message', 'Media replaced successfully!');
			$this->closeDetailModal();
		} catch (\Exception $e) {
			session()->flash('error', 'Failed to replace media: ' . $e->getMessage());
		}
	}

	public function deleteDetailMedia(): void
	{
		$media = Media::find($this->detailMediaId);

		if ($media) {
			$media->delete();
			$this->selected = array_values(array_filter($this->selected, fn($id) => $id !== $this->detailMediaId));

			session()->flash('message', 'Media deleted successfully!');
			$this->closeDetailModal();
		}
	}

	public function getDetailMedia()
	{
		return $this->detailMediaId ? Media::find($this->detailMediaId) : null;
	}

	protected function getMediaQuery()
	{
		return Media::query()
			->when(
				$this->search,
				fn($query) => $query->where('name', 'like', '%' . $this->search . '%')
					->orWhere('file_name', 'like', '%' . $this->search . '%')
			)
			->when(
				$this->collectionFilter,
				fn($query) => $query->where('collection_name', $this->collectionFilter)
			)
			->orderBy($this->sortBy, $this->sortDirection);
	}

	public function render()
	{
		$collections = Media::query()
			->distinct()
			->pluck('collection_name', 'collection_name')
			->toArray();

		return view('livewire.media-manager', [
			'mediaItems' => $this->getMediaQuery()->paginate(24),
			'collections' => $collections,
			'totalCount' => Media::count(),
			'selectedCount' => count($this->selected),
		]);
	}
}
