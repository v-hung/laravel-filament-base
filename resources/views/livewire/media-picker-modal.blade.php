<div>
    @if ($isOpen)
        <div wire:key="modal-{{ $currentModal }}">
            @if ($currentModal === 'browse')
                <!-- Main Modal: Browse & Selected Files -->
                <x-media-picker.modals.browse-modal :view="$view" :selected="$selected" :mediaItems="$mediaItems" :folders="$folders"
                    :breadcrumbs="$breadcrumbs" />
            @elseif($currentModal === 'detail')
                <!-- Detail Modal -->
                @if ($this->getDetailMedia())
                    <x-media-picker.modals.detail-modal />
                @endif
            @elseif($currentModal === 'detail-folder')
                <!-- Folder Detail Modal -->
                @if ($this->getDetailFolder())
                    <x-media-picker.modals.folder-detail-modal />
                @endif
            @elseif($currentModal === 'create-folder')
                <!-- Create Folder Modal -->
                <x-media-picker.modals.create-folder-modal :newFolderName="$newFolderName" :breadcrumbs="$breadcrumbs" />
            @elseif($currentModal === 'upload')
                <!-- Upload Modal -->
                <x-media-picker.modals.upload-modal :uploadedFiles="$uploadedFiles" :currentFolder="$currentFolder" :breadcrumbs="$breadcrumbs" />
            @endif
        </div>
    @endif
</div>
