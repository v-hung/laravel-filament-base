<?php

namespace App\Livewire;

use App\Livewire\Concerns\InteractsWithMedia;
use App\Livewire\Concerns\InteractsWithMediaBrowser;
use App\Models\Media\MediaFolder;
use App\Repositories\MediaRepository;
use App\Services\MediaService;
use Filament\Notifications\Notification;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class MediaPickerModal extends Component
{
    use InteractsWithMedia, InteractsWithMediaBrowser, WithFileUploads, WithPagination;

    protected MediaRepository $mediaRepository;

    protected MediaService $mediaService;

    public bool $isOpen = false;

    public string $currentModal = 'browse'; // 'browse', 'detail', 'create-folder', 'upload', 'detail-folder'

    public ?string $previousModal = null; // Lưu modal trước đó để xử lý click outside

    public bool $multiple = false;

    public array $selected = [];

    public ?string $collection = null;

    public string $view = 'browse'; // 'browse', 'selected' (chỉ cho browse modal)

    public string $search = '';

    public string $sortBy = 'created_at';

    public string $sortDirection = 'desc';

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

    // Folder detail modal properties
    public ?int $detailFolderId = null;

    public string $detailFolderName = '';

    public string $detailFolderLocation = '';

    protected $listeners = [
        'openMediaPicker' => 'open',
        'closeMediaPicker' => 'close',
        'openMediaDetail' => 'openMediaDetail',
        'openFolderDetail' => 'openFolderDetail',
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

    protected function browserFolderProperty(): string
    {
        return 'browsingFolderId';
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
        $this->reset(['selected', 'search', 'uploadedFiles', 'view', 'mode', 'newFolderName', 'currentFolder', 'browsingFolderId', 'detailMediaId', 'detailFileName', 'detailAltText', 'detailCaption', 'detailLocation', 'replacementFile', 'detailFolderId', 'detailFolderName', 'detailFolderLocation']);
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
            $this->reset(['newFolderName', 'uploadedFiles', 'replacementFile', 'detailFolderId', 'detailFolderName', 'detailFolderLocation']);
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
            'newFolderName.regex' => __('media.validation.folder_name_regex'),
        ]);

        // Kiểm tra tên folder trùng trong cùng parent
        $exists = MediaFolder::where('name', $this->newFolderName)
            ->where('parent_id', $this->currentFolder)
            ->exists();

        if ($exists) {
            $this->addError('newFolderName', __('media.validation.folder_name_exists'));

            return;
        }

        try {
            $this->mediaRepository->createFolder($this->newFolderName, $this->currentFolder);

            Notification::make()
                ->title(__('media.notifications.folder_created'))
                ->success()
                ->send();

            $this->dispatch('folderCreated');
            $this->closeModal();
        } catch (\Exception $e) {
            Notification::make()
                ->title(__('media.notifications.folder_create_failed'))
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    public function toggleSelect(int $mediaId): void
    {
        if ($this->multiple) {
            if (in_array($mediaId, $this->selected)) {
                $this->selected = array_values(array_filter($this->selected, fn ($id) => $id !== $mediaId));
            } else {
                $this->selected[] = $mediaId;
            }
        } else {
            if (in_array($mediaId, $this->selected)) {
                $this->selected = [];
            } else {
                $this->selected = [$mediaId];
            }
        }
    }

    public function isSelected(int $mediaId): bool
    {
        return in_array($mediaId, $this->selected);
    }

    public function confirmDeleteFolder(int $folderId): void
    {
        $this->dispatch('open-picker-confirm-modal', [
            'title' => __('media.confirm.delete_folder_title'),
            'message' => __('media.confirm.delete_folder_message'),
            'callback' => 'deleteFolder',
            'params' => ['folderId' => $folderId],
        ]);
    }

    public function confirmDeleteMedia(int $mediaId): void
    {
        $this->dispatch('open-picker-confirm-modal', [
            'title' => __('media.confirm.delete_media_title'),
            'message' => __('media.confirm.delete_media_message'),
            'callback' => 'deleteMedia',
            'params' => ['mediaId' => $mediaId],
        ]);
    }

    public function confirmDeleteDetailFolder(): void
    {
        $this->dispatch('open-picker-confirm-modal', [
            'title' => __('media.confirm.delete_folder_title'),
            'message' => __('media.confirm.delete_folder_message'),
            'callback' => 'deleteDetailFolder',
            'params' => [],
        ]);
    }

    public function confirm(): void
    {
        $mediaItems = $this->mediaRepository->getMediaByIds($this->selected)
            ->map(fn (\App\Models\Media $media) => [
                'id' => $media->id,
                'name' => $media->name,
                'file_name' => $media->file_name,
                'url' => $media->getUrl(),
                'mime_type' => $media->mime_type,
                'size' => $media->size,
            ])
            ->values()
            ->toArray();

        $this->dispatch('mediaSelected', $this->selected, $mediaItems);
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
                ->title(__('media.notifications.files_uploaded'))
                ->success()
                ->send();

            $this->dispatch('assetUploaded');
            $this->closeModal();
        } catch (\Exception $e) {
            Notification::make()
                ->title(__('media.notifications.files_upload_failed'))
                ->body($e->getMessage())
                ->danger()
                ->send();
        } finally {
            $this->uploadedFiles = [];
        }
    }

    public function removeUploadedFile(int $index): void
    {
        array_splice($this->uploadedFiles, $index, 1);
    }

    public function openMediaDetail(int $mediaId, ?string $source = null): void
    {
        $media = $this->mediaRepository->getMediaById($mediaId);

        if (! $media) {
            Notification::make()
                ->title(__('media.notifications.media_not_found'))
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
            $this->detailLocation = $folder?->name ?? __('media.root');
        } else {
            $this->detailLocation = __('media.root');
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
                    ->title(__('media.notifications.media_details_updated'))
                    ->success()
                    ->send();

                $this->closeDetailModal();
            } catch (\Exception $e) {
                Notification::make()
                    ->title(__('media.notifications.media_details_update_failed'))
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
                ->title(__('media.notifications.media_replaced'))
                ->success()
                ->send();

            $this->dispatch('assetUploaded'); // Reload media browser
            $this->closeDetailModal();
        } catch (\Exception $e) {
            Notification::make()
                ->title(__('media.notifications.media_replace_failed'))
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
                $this->selected = array_values(array_filter($this->selected, fn ($id) => $id !== $this->detailMediaId));

                Notification::make()
                    ->title(__('media.notifications.media_deleted'))
                    ->success()
                    ->send();

                $this->closeDetailModal();
                $this->dispatch('assetUploaded');
            } catch (\Exception $e) {
                Notification::make()
                    ->title(__('media.notifications.media_delete_failed'))
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

        return $media?->dimensions;
    }

    public function deleteMedia(int $mediaId): void
    {
        $media = $this->mediaRepository->getMediaById($mediaId);

        if ($media) {
            try {
                $this->mediaService->deleteMedia($media);
                $this->selected = array_values(array_filter($this->selected, fn ($id) => $id !== $mediaId));

                Notification::make()
                    ->title(__('media.notifications.media_deleted'))
                    ->success()
                    ->send();

                $this->dispatch('assetUploaded');
            } catch (\Exception $e) {
                Notification::make()
                    ->title(__('media.notifications.media_delete_failed'))
                    ->body($e->getMessage())
                    ->danger()
                    ->send();
            }
        }
    }

    public function openFolderDetail(int $folderId, ?string $source = null): void
    {
        $folder = $this->mediaRepository->getFolder($folderId);

        if (! $folder) {
            Notification::make()
                ->title(__('media.notifications.folder_not_found'))
                ->danger()
                ->send();

            return;
        }

        // Auto-detect source: if currently in browse modal, save it as previousModal
        if ($this->currentModal === 'browse' && $this->isOpen) {
            $this->previousModal = $this->currentModal;
        } else {
            $this->previousModal = null;
        }

        $this->isOpen = true;
        $this->detailFolderId = $folderId;
        $this->detailFolderName = $folder->name;

        // Get folder location
        if ($folder->parent_id) {
            $parent = $this->mediaRepository->getFolder($folder->parent_id);
            $this->detailFolderLocation = $parent?->name ?? __('media.root');
        } else {
            $this->detailFolderLocation = __('media.root');
        }

        $this->currentModal = 'detail-folder';
    }

    public function saveFolderDetails(): void
    {
        $this->validate([
            'detailFolderName' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z0-9\s\-_]+$/',
            ],
        ], [
            'detailFolderName.regex' => __('media.validation.folder_name_regex'),
        ]);

        $folder = $this->mediaRepository->getFolder($this->detailFolderId);

        if (! $folder) {
            Notification::make()
                ->title(__('media.notifications.folder_not_found'))
                ->danger()
                ->send();

            return;
        }

        // Check if name already exists in same parent
        $exists = MediaFolder::where('name', $this->detailFolderName)
            ->where('parent_id', $folder->parent_id)
            ->where('id', '!=', $folder->id)
            ->exists();

        if ($exists) {
            $this->addError('detailFolderName', __('media.validation.folder_name_exists'));

            return;
        }

        try {
            $oldPath = $folder->path;
            $folder->name = $this->detailFolderName;

            // Update path
            if ($folder->parent_id) {
                $parent = $this->mediaRepository->getFolder($folder->parent_id);
                $folder->path = $parent->path.'/'.$this->detailFolderName;
            } else {
                $folder->path = $this->detailFolderName;
            }

            $folder->save();

            // Update paths of all descendant folders
            $oldPathPattern = rtrim($oldPath, '/').'/';
            $descendants = MediaFolder::where('path', 'LIKE', $oldPathPattern.'%')->get();

            foreach ($descendants as $descendant) {
                $descendant->path = str_replace($oldPath, $folder->path, $descendant->path);
                $descendant->save();
            }

            Notification::make()
                ->title(__('media.notifications.folder_updated'))
                ->success()
                ->send();

            $this->dispatch('folderCreated'); // Reload folders
            $this->closeModal();
        } catch (\Exception $e) {
            Notification::make()
                ->title(__('media.notifications.folder_update_failed'))
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    public function deleteDetailFolder(): void
    {
        $folder = $this->mediaRepository->getFolder($this->detailFolderId);

        if ($folder) {
            try {
                $this->mediaRepository->deleteFolder($this->detailFolderId, false);

                Notification::make()
                    ->title(__('media.notifications.folder_deleted'))
                    ->success()
                    ->send();

                $this->closeModal();
                $this->dispatch('folderCreated'); // Reload folders
            } catch (\Exception $e) {
                Notification::make()
                    ->title(__('media.notifications.folder_delete_failed'))
                    ->body($e->getMessage())
                    ->danger()
                    ->send();
            }
        }
    }

    public function getDetailFolder()
    {
        return $this->detailFolderId ? $this->mediaRepository->getFolder($this->detailFolderId) : null;
    }

    public function getDetailFolderSubfoldersCountProperty(): int
    {
        return $this->detailFolderId ? $this->mediaRepository->getFolderCount($this->detailFolderId) : 0;
    }

    public function getDetailFolderMediaCountProperty(): int
    {
        return $this->detailFolderId ? $this->mediaRepository->getMediaCount($this->detailFolderId) : 0;
    }

    public function render()
    {
        // Get breadcrumb path - use currentFolder for create/upload modals, browsingFolderId for browse
        $folderId = in_array($this->currentModal, ['create-folder', 'upload'])
            ? $this->currentFolder
            : $this->browsingFolderId;

        $browser = $this->resolveMediaBrowserData(
            perPage: 12,
            collection: $this->collection,
            includeFolders: true,
            breadcrumbsFolderId: $folderId,
        );

        return view('livewire.media-picker-modal', [
            'mediaItems' => $browser['mediaItems'],
            'folders' => $browser['folders'],
            'breadcrumbs' => $browser['folderPath'],
        ]);
    }
}
