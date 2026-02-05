<?php

namespace App\Concerns\Media;

use App\Models\Media;
use App\Services\MediaService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class PendingMediaAttachment
{
	protected string $collection = 'default';
	protected array $customProperties = [];
	protected int $sortOrder = 0;

	public function __construct(
		protected Model $model,
		protected UploadedFile|string $file
	) {}

	public function toMediaCollection(string $collection = 'default'): Media
	{
		$this->collection = $collection;

		// Create media using MediaService
		$mediaService = app(MediaService::class);

		if ($this->file instanceof UploadedFile) {
			$media = $mediaService->createMediaFromUpload(
				file: $this->file,
				collection: $this->collection,
				customProperties: $this->customProperties
			);
		} else {
			throw new \InvalidArgumentException('Only UploadedFile is supported');
		}

		// Attach media to model
		$this->model->attachMedia($media, $this->collection, $this->sortOrder);

		// Generate conversions if defined
		$this->generateConversions($media);

		return $media;
	}

	public function withCustomProperties(array $properties): static
	{
		$this->customProperties = $properties;
		return $this;
	}

	public function preservingOriginal(): static
	{
		// Implementation for preserving original
		return $this;
	}

	protected function generateConversions(Media $media): void
	{
		if (!method_exists($this->model, 'getRegisteredMediaConversions')) {
			return;
		}

		$conversions = $this->model->getRegisteredMediaConversions($media->pivot->collection ?? 'default');

		if (empty($conversions)) {
			return;
		}

		$mediaService = app(MediaService::class);
		$modelClass = get_class($this->model);

		foreach ($conversions as $conversion) {
			$mediaService->generateConversion(
				$media,
				$conversion,
				$modelClass,
				$this->collection
			);
		}
	}
}
