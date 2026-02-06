<?php

namespace App\Repositories;

use App\Models\Media;
use App\Models\Media\MediaFolder;
use App\Services\MediaService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class MediaRepository
{
    protected string $disk;

    public function __construct()
    {
        $this->disk = config('filesystems.default', 'public');
    }

    /**
     * Get media items with optional filtering
     */
    public function getMedia(
        ?int $folderId = null,
        ?string $search = null,
        string $sortBy = 'created_at',
        string $sortDirection = 'desc',
        int $perPage = 24
    ): LengthAwarePaginator {
        return Media::query()
            ->when($folderId, fn ($query) => $query->where('folder_id', $folderId))
            ->when(is_null($folderId), fn ($query) => $query->whereNull('folder_id'))
            ->when(
                $search,
                fn ($query) => $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%'.$search.'%')
                        ->orWhere('file_name', 'like', '%'.$search.'%');
                })
            )
            ->orderBy($sortBy, $sortDirection)
            ->paginate($perPage);
    }

    /**
     * Get all folders in a specific parent folder
     */
    public function getFolders(?int $parentId = null): Collection
    {
        return MediaFolder::query()
            ->withCount(['children', 'medias'])
            ->when(is_null($parentId), fn ($query) => $query->whereNull('parent_id'))
            ->when($parentId, fn ($query) => $query->where('parent_id', $parentId))
            ->orderBy('name')
            ->get();
    }

    /**
     * Get folder by ID
     */
    public function getFolder(int $folderId): ?MediaFolder
    {
        return MediaFolder::find($folderId);
    }

    /**
     * Get folder breadcrumb path
     */
    public function getFolderPath(int $folderId): array
    {
        $path = [];
        $folder = $this->getFolder($folderId);

        while ($folder) {
            array_unshift($path, [
                'id' => $folder->id,
                'name' => $folder->name,
            ]);
            $folder = $folder->parent;
        }

        return $path;
    }

    /**
     * Create a new folder
     */
    public function createFolder(string $name, ?int $parentId = null): MediaFolder
    {
        $path = $name;

        if ($parentId) {
            $parent = $this->getFolder($parentId);
            if ($parent) {
                $path = $parent->path.'/'.$name;
            }
        }

        return MediaFolder::create([
            'name' => $name,
            'path' => $path,
            'parent_id' => $parentId,
        ]);
    }

    /**
     * Delete folder and its contents
     */
    public function deleteFolder(int $folderId, bool $deleteContents = false): bool
    {
        $folder = $this->getFolder($folderId);

        if (! $folder) {
            return false;
        }

        $mediaService = app(MediaService::class);

        if ($deleteContents) {
            // Get all descendant folders using path (1 query)
            $folderPath = rtrim($folder->path, '/').'/';
            $descendantFolders = MediaFolder::where('path', 'LIKE', $folderPath.'%')
                ->orWhere('id', $folderId)
                ->get();

            $folderIds = $descendantFolders->pluck('id')->toArray();

            // Get all media in all folders (1 query)
            $mediaItems = Media::whereIn('folder_id', $folderIds)->get();

            // Delete all media (files and database) in batch
            if ($mediaItems->isNotEmpty()) {
                $mediaService->deleteMediaBatch($mediaItems);
            }

            // Delete all descendant folders (1 query)
            MediaFolder::whereIn('id', $folderIds)
                ->where('id', '!=', $folderId) // Exclude current folder
                ->delete();
        } else {
            // Move contents to parent folder
            $folder->medias()->update(['folder_id' => $folder->parent_id]);
            $folder->children()->update(['parent_id' => $folder->parent_id]);
        }

        return $folder->delete();
    }

    /**
     * Move media to folder
     */
    public function moveMediaToFolder(int $mediaId, ?int $folderId): bool
    {
        $media = Media::find($mediaId);

        if (! $media) {
            return false;
        }

        $media->folder_id = $folderId;

        return $media->save();
    }

    /**
     * Get media count in folder
     */
    public function getMediaCount(?int $folderId = null): int
    {
        return Media::query()
            ->when($folderId, fn ($query) => $query->where('folder_id', $folderId))
            ->when(is_null($folderId), fn ($query) => $query->whereNull('folder_id'))
            ->count();
    }

    /**
     * Get folder count in parent folder
     */
    public function getFolderCount(?int $parentId = null): int
    {
        return MediaFolder::query()
            ->when(is_null($parentId), fn ($query) => $query->whereNull('parent_id'))
            ->when($parentId, fn ($query) => $query->where('parent_id', $parentId))
            ->count();
    }

    /**
     * Get total media count
     */
    public function getTotalMediaCount(): int
    {
        return Media::count();
    }

    /**
     * Delete media by ID
     */
    public function deleteMedia(int $mediaId): bool
    {
        $media = Media::find($mediaId);

        if (! $media) {
            return false;
        }

        // Use MediaService to delete both files and database record
        return app(\App\Services\MediaService::class)->deleteMedia($media);
    }

    /**
     * Delete multiple media
     */
    public function deleteMediaBatch(array $mediaIds): int
    {
        $mediaItems = Media::whereIn('id', $mediaIds)->get();

        if ($mediaItems->isEmpty()) {
            return 0;
        }

        return app(MediaService::class)->deleteMediaBatch($mediaItems);
    }

    /**
     * Get media by ID
     */
    public function getMediaById(int $mediaId): ?Media
    {
        return Media::find($mediaId);
    }

    /**
     * Get media by IDs
     */
    public function getMediaByIds(array $mediaIds): Collection
    {
        return Media::whereIn('id', $mediaIds)->get();
    }

    /**
     * Get all media IDs for a folder (without pagination)
     */
    public function getAllMediaIds(
        ?int $folderId = null,
        ?string $search = null,
        string $sortBy = 'created_at',
        string $sortDirection = 'desc'
    ): array {
        return Media::query()
            ->when($folderId, fn ($query) => $query->where('folder_id', $folderId))
            ->when(is_null($folderId), fn ($query) => $query->whereNull('folder_id'))
            ->when(
                $search,
                fn ($query) => $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%'.$search.'%')
                        ->orWhere('file_name', 'like', '%'.$search.'%');
                })
            )
            ->orderBy($sortBy, $sortDirection)
            ->pluck('id')
            ->toArray();
    }

    /**
     * Search media globally
     */
    public function searchMedia(string $search, int $perPage = 24): LengthAwarePaginator
    {
        return Media::query()
            ->where(function ($q) use ($search) {
                $q->where('name', 'like', '%'.$search.'%')
                    ->orWhere('file_name', 'like', '%'.$search.'%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }
}
