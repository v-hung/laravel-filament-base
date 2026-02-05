<?php

namespace App\Concerns\Media;

class MediaCollectionDefinition
{
	public array $conversions = [];

	public function __construct(
		public string $name,
		public array $acceptedMimeTypes = [],
		public bool $multiple = false
	) {}

	public function acceptsMimeTypes(array $mimeTypes): static
	{
		$this->acceptedMimeTypes = $mimeTypes;
		return $this;
	}

	public function multiple(): static
	{
		$this->multiple = true;
		return $this;
	}

	/**
	 * Add conversions to this collection
	 * @param array<MediaConversionDefinition> $conversions
	 */
	public function conversions(array $conversions): static
	{
		$this->conversions = $conversions;
		return $this;
	}

	/**
	 * Get all conversions for this collection
	 */
	public function getConversions(): array
	{
		return $this->conversions;
	}
}
