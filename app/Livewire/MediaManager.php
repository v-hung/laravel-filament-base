<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaManager extends Component
{
	use WithPagination;

	public string $activeTab = 'browse';

	public string $search = '';

	public array $selected = [];

	public ?string $collectionFilter = null;

	public string $sortBy = 'created_at';

	public string $sortDirection = 'desc';

	public string $viewMode = 'grid'; // grid or list

	protected $listeners = [
		'folderCreated' => '$refresh',
		'assetUploaded' => '$refresh',
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
