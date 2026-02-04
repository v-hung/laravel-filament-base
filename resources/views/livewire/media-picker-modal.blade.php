<div>
    @if ($isOpen)
        @if ($currentModal === 'browse')
            <!-- Main Modal: Browse & Selected Files -->
            <x-media-picker.main-modal :view="$view" :mode="$mode" :selected="$selected" :mediaItems="$mediaItems"
                :search="$search" />
        @elseif($currentModal === 'detail')
            <!-- Detail Modal -->
            @if ($this->getDetailMedia())
                <x-media-picker.detail-modal />
            @endif
        @elseif($currentModal === 'create-folder')
            <!-- Create Folder Modal -->
            <x-media-picker.create-folder-modal :newFolderName="$newFolderName" />
        @elseif($currentModal === 'upload')
            <!-- Upload Modal -->
            <x-media-picker.upload-modal :uploadedFiles="$uploadedFiles" :currentFolder="$currentFolder" />
        @endif
    @endif
</div>
