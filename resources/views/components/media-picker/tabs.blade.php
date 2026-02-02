<!-- Tabs -->
<div class="border-b border-gray-200 bg-white px-6">
  <nav class="-mb-px flex space-x-8" aria-label="Tabs">
    <button wire:click="switchView('browse')"
      class="@if ($view === 'browse') border-indigo-500 text-indigo-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm uppercase">
      Browse
    </button>
    <button wire:click="switchView('upload')"
      class="@if ($view === 'upload') border-indigo-500 text-indigo-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm uppercase">
      @if ($mode === 'manager')
        Upload
      @else
        Selected Files
      @endif
      @if (count($selected) > 0 && $mode === 'picker')
        <span class="ml-2 bg-indigo-100 text-indigo-600 py-0.5 px-2 rounded-full text-xs">{{ count($selected) }}</span>
      @endif
    </button>
    @if ($mode === 'manager')
      <button wire:click="switchView('create-folder')"
        class="@if ($view === 'create-folder') border-indigo-500 text-indigo-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm uppercase">
        Create Folder
      </button>
    @endif
  </nav>
</div>
