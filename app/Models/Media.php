<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;

class Media extends BaseMedia
{
	public function folder()
	{
		return $this->belongsTo(MediaFolder::class, 'folder_id');
	}

	protected $appends = ['dimensions'];

	/**
	 * Get image dimensions [width, height] or null if not an image or dimensions not available
	 */
	public function dimensions(): ?array
	{
		if (! str_starts_with($this->mime_type ?? '', 'image/') || $this->mime_type === 'image/svg+xml') {
			return null;
		}

		if ($this->width && $this->height) {
			return [$this->width, $this->height];
		}

		return null;
	}
}
