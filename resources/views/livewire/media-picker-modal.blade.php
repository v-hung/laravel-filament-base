<div>
    @if ($isOpen)
        @if ($currentModal === 'browse')
            <!-- Main Modal: Browse & Selected Files -->
            <x-media-picker.main-modal :view="$view" :mode="$mode" :selected="$selected" :mediaItems="$mediaItems"
                :search="$search" :folders="$folders" :breadcrumbs="$breadcrumbs" />
        @elseif($currentModal === 'detail')
            <!-- Detail Modal -->
            @if ($this->getDetailMedia())
                <x-media-picker.detail-modal />
            @endif
        @elseif($currentModal === 'create-folder')
            <!-- Create Folder Modal -->
            <x-media-picker.create-folder-modal :newFolderName="$newFolderName" :breadcrumbs="$breadcrumbs" />
        @elseif($currentModal === 'upload')
            <!-- Upload Modal -->
            <x-media-picker.upload-modal :uploadedFiles="$uploadedFiles" :currentFolder="$currentFolder" :breadcrumbs="$breadcrumbs" />
        @endif
    @endif
</div>
