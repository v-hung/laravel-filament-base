<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <div
        x-data="{
            state: $wire.entangle('{{ $getStatePath() }}'),
            _itemTypes: @js($getItemTypes()),
            openPanels: ['custom'],
            custom: { title: '', url: '', target: '_self' },
            selected: {},
            search: {},
            dragFrom: null,
            dragTo: null,
            editingIndex: null,
            editForm: {},

            get items() { return this.state || []; },
            get itemTypes() { return this._itemTypes; },

            togglePanel(key) {
                if (this.openPanels.includes(key)) {
                    this.openPanels = this.openPanels.filter(k => k !== key);
                } else {
                    this.openPanels.push(key);
                }
            },

            generateId() {
                return 'new_' + Date.now() + '_' + Math.random().toString(36).substr(2, 6);
            },

            addCustomItem() {
                if (!this.custom.title || !this.custom.url) return;
                this.state = [...(this.state || []), {
                    id: null,
                    temp_id: this.generateId(),
                    title: this.custom.title,
                    url: this.custom.url,
                    target: this.custom.target,
                    icon: '',
                    depth: 0,
                    is_active: true,
                }];
                this.custom = { title: '', url: '', target: '_self' };
            },

            addModelItems(typeKey, typeItems) {
                const selectedIds = this.selected[typeKey] || [];
                if (!selectedIds.length) return;
                const newItems = typeItems
                    .filter(item => selectedIds.includes(item.id))
                    .map(item => ({
                        id: null,
                        temp_id: this.generateId(),
                        title: item.title,
                        url: item.url || '',
                        target: '_self',
                        icon: '',
                        depth: 0,
                        is_active: true,
                    }));
                this.state = [...(this.state || []), ...newItems];
                this.selected = { ...this.selected, [typeKey]: [] };
            },

            filteredItems(typeKey, items) {
                const q = (this.search[typeKey] || '').toLowerCase().trim();
                if (!q) return items;
                return items.filter(i => i.title.toLowerCase().includes(q));
            },

            onDragStart(index) {
                this.dragFrom = index;
            },

            onDragOver(index) {
                if (this.dragFrom === null) return;
                this.dragTo = index;
            },

            onDrop(index) {
                const from = this.dragFrom;
                if (from === null || from === index) {
                    this.dragFrom = null;
                    this.dragTo = null;
                    return;
                }
                const items = [...(this.state || [])];
                const [moved] = items.splice(from, 1);
                const insertAt = from < index ? index - 1 : index;
                items.splice(insertAt, 0, moved);
                this.state = items;
                this.dragFrom = null;
                this.dragTo = null;
            },

            indent(index) {
                if (index === 0) return;
                const items = [...(this.state || [])];
                const current = items[index];
                const prev = items[index - 1];
                if (current.depth <= prev.depth) {
                    items[index] = { ...current, depth: current.depth + 1 };
                    this.state = items;
                }
            },

            outdent(index) {
                const items = [...(this.state || [])];
                const current = items[index];
                if (current.depth > 0) {
                    items[index] = { ...current, depth: current.depth - 1 };
                    this.state = items;
                }
            },

            removeItem(index) {
                const items = [...(this.state || [])];
                const depth = items[index].depth;
                let end = index + 1;
                while (end < items.length && items[end].depth > depth) end++;
                items.splice(index, end - index);
                this.state = items;
            },

            startEdit(index) {
                this.editingIndex = index;
                this.editForm = { ...(this.state || [])[index] };
            },

            saveEdit() {
                const items = [...(this.state || [])];
                items[this.editingIndex] = { ...items[this.editingIndex], ...this.editForm };
                this.state = items;
                this.editingIndex = null;
                this.editForm = {};
            },

            cancelEdit() {
                this.editingIndex = null;
                this.editForm = {};
            },
        }"
        class="flex gap-4"
        style="min-height: 420px"
    >
        {{-- ── Left Panel: Item type pickers ── --}}
        <div class="w-72 shrink-0 space-y-2 self-start">
            <template x-for="[typeKey, typeConfig] in Object.entries(itemTypes)" :key="typeKey">
                <div class="rounded-xl border border-gray-200 dark:border-white/10 overflow-hidden bg-white dark:bg-gray-900 shadow-sm">

                    {{-- Accordion header --}}
                    <button
                        type="button"
                        @click="togglePanel(typeKey)"
                        class="w-full flex items-center justify-between px-3 py-2.5 text-sm font-semibold text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-white/5 transition-colors"
                    >
                        <span x-text="typeConfig.label"></span>
                        <svg
                            class="w-4 h-4 text-gray-400 transition-transform duration-200"
                            :class="{ 'rotate-180': openPanels.includes(typeKey) }"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    {{-- Accordion body --}}
                    <div
                        x-show="openPanels.includes(typeKey)"
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 -translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="border-t border-gray-100 dark:border-white/10"
                    >
                        {{-- Custom Link --}}
                        <template x-if="typeKey === 'custom'">
                            <div class="p-3 space-y-2">
                                <div>
                                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">
                                        {{ __('filament.menu_builder.label') }}
                                    </label>
                                    <input
                                        type="text"
                                        x-model="custom.title"
                                        placeholder="{{ __('filament.menu_builder.label_placeholder') }}"
                                        class="w-full text-sm px-2.5 py-1.5 rounded-lg border border-gray-300 dark:border-white/20 bg-white dark:bg-white/5 text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                                    />
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">
                                        {{ __('filament.fields.url') }}
                                    </label>
                                    <input
                                        type="text"
                                        x-model="custom.url"
                                        placeholder="https://..."
                                        class="w-full text-sm px-2.5 py-1.5 rounded-lg border border-gray-300 dark:border-white/20 bg-white dark:bg-white/5 text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                                    />
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">
                                        {{ __('filament.fields.menu_target') }}
                                    </label>
                                    <select
                                        x-model="custom.target"
                                        class="w-full text-sm px-2.5 py-1.5 rounded-lg border border-gray-300 dark:border-white/20 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary-500"
                                    >
                                        <option value="_self">{{ __('filament.options.menu_target_self') }}</option>
                                        <option value="_blank">{{ __('filament.options.menu_target_blank') }}</option>
                                    </select>
                                </div>
                                <button
                                    type="button"
                                    @click="addCustomItem()"
                                    :disabled="!custom.title || !custom.url"
                                    class="w-full text-sm py-1.5 px-3 rounded-lg bg-primary-600 hover:bg-primary-700 disabled:opacity-40 disabled:cursor-not-allowed text-white font-medium transition-colors"
                                >
                                    {{ __('filament.menu_builder.add_to_menu') }}
                                </button>
                            </div>
                        </template>

                        {{-- Model-based type --}}
                        <template x-if="typeKey !== 'custom'">
                            <div class="p-3 space-y-2">
                                <input
                                    type="text"
                                    x-model="search[typeKey]"
                                    placeholder="{{ __('filament.menu_builder.search_placeholder') }}"
                                    class="w-full text-sm px-2.5 py-1.5 rounded-lg border border-gray-300 dark:border-white/20 bg-white dark:bg-white/5 text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                                />
                                <div class="max-h-52 overflow-y-auto rounded-lg border border-gray-200 dark:border-white/10 divide-y divide-gray-100 dark:divide-white/5">
                                    <template x-for="item in filteredItems(typeKey, typeConfig.items || [])" :key="item.id">
                                        <label class="flex items-center gap-2.5 px-2.5 py-2 hover:bg-gray-50 dark:hover:bg-white/5 cursor-pointer">
                                            <input
                                                type="checkbox"
                                                :value="item.id"
                                                x-model="selected[typeKey]"
                                                class="rounded border-gray-300 text-primary-600 focus:ring-primary-500"
                                            />
                                            <span class="text-sm text-gray-700 dark:text-gray-300 truncate" x-text="item.title"></span>
                                        </label>
                                    </template>
                                    <template x-if="!filteredItems(typeKey, typeConfig.items || []).length">
                                        <div class="px-3 py-4 text-center text-xs text-gray-400">
                                            {{ __('filament.menu_builder.no_results') }}
                                        </div>
                                    </template>
                                </div>
                                <button
                                    type="button"
                                    @click="addModelItems(typeKey, typeConfig.items || [])"
                                    :disabled="!(selected[typeKey] || []).length"
                                    class="w-full text-sm py-1.5 px-3 rounded-lg bg-primary-600 hover:bg-primary-700 disabled:opacity-40 disabled:cursor-not-allowed text-white font-medium transition-colors"
                                >
                                    {{ __('filament.menu_builder.add_to_menu') }}
                                    <span
                                        x-show="(selected[typeKey] || []).length > 0"
                                        x-text="' (' + (selected[typeKey] || []).length + ')'"
                                        class="opacity-80"
                                    ></span>
                                </button>
                            </div>
                        </template>
                    </div>
                </div>
            </template>
        </div>

        {{-- ── Right Panel: Menu tree ── --}}
        <div class="flex-1 flex flex-col rounded-xl border border-gray-200 dark:border-white/10 bg-white dark:bg-gray-900 shadow-sm overflow-hidden">

            {{-- Header --}}
            <div class="px-4 py-3 border-b border-gray-100 dark:border-white/10 flex items-center justify-between shrink-0">
                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200">
                    {{ __('filament.menu_builder.structure_title') }}
                </h3>
                <span class="text-xs text-gray-400" x-text="items.length + ' {{ __('filament.menu_builder.items_count') }}'"></span>
            </div>

            {{-- Items --}}
            <div class="flex-1 overflow-y-auto p-3 space-y-1">

                {{-- Empty state --}}
                <template x-if="items.length === 0">
                    <div class="flex flex-col items-center justify-center h-48 text-center select-none">
                        <svg class="w-10 h-10 text-gray-200 dark:text-white/10 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h8m-8 6h16"/>
                        </svg>
                        <p class="text-sm text-gray-400">{{ __('filament.menu_builder.empty_title') }}</p>
                        <p class="text-xs text-gray-300 dark:text-white/20 mt-1">{{ __('filament.menu_builder.empty_hint') }}</p>
                    </div>
                </template>

                {{-- Draggable list --}}
                <template x-for="(item, index) in items" :key="item.temp_id">
                    <div
                        class="group"
                        :style="'padding-left: ' + (item.depth * 28) + 'px'"
                        draggable="true"
                        @dragstart.stop="onDragStart(index)"
                        @dragover.prevent.stop="onDragOver(index)"
                        @drop.prevent.stop="onDrop(index)"
                        @dragend="dragFrom = null; dragTo = null"
                    >
                        {{-- Normal view --}}
                        <template x-if="editingIndex !== index">
                            <div
                                class="flex items-center gap-2 px-2.5 py-2 rounded-lg border transition-all duration-100 cursor-default"
                                :class="{
                                    'border-primary-400 bg-primary-50 dark:bg-primary-900/20 shadow-sm': dragTo === index && dragFrom !== null && dragFrom !== index,
                                    'border-gray-200 dark:border-white/10 bg-white dark:bg-white/5 hover:bg-gray-50 dark:hover:bg-white/[0.07]': !(dragTo === index && dragFrom !== null && dragFrom !== index),
                                }"
                            >
                                {{-- Drag handle --}}
                                <div
                                    class="cursor-grab active:cursor-grabbing text-gray-300 hover:text-gray-500 dark:text-white/20 dark:hover:text-white/50 shrink-0"
                                >
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 16 16">
                                        <circle cx="5" cy="4" r="1.3"/><circle cx="5" cy="8" r="1.3"/><circle cx="5" cy="12" r="1.3"/>
                                        <circle cx="11" cy="4" r="1.3"/><circle cx="11" cy="8" r="1.3"/><circle cx="11" cy="12" r="1.3"/>
                                    </svg>
                                </div>

                                {{-- Nesting indicator --}}
                                <template x-if="item.depth > 0">
                                    <svg class="w-3 h-3 text-gray-300 dark:text-white/20 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </template>

                                {{-- Title + URL --}}
                                <div class="flex-1 min-w-0">
                                    <div class="text-sm font-medium text-gray-800 dark:text-gray-100 truncate" x-text="item.title"></div>
                                    <div
                                        class="text-xs text-gray-400 truncate"
                                        x-text="item.url"
                                        x-show="item.url"
                                    ></div>
                                </div>

                                {{-- New tab badge --}}
                                <template x-if="item.target === '_blank'">
                                    <span class="text-xs text-gray-400 shrink-0" title="{{ __('filament.options.menu_target_blank') }}">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                        </svg>
                                    </span>
                                </template>

                                {{-- Inactive badge --}}
                                <template x-if="!item.is_active">
                                    <span class="text-xs bg-gray-100 dark:bg-white/10 text-gray-400 px-1.5 py-0.5 rounded shrink-0">
                                        {{ __('filament.menu_builder.inactive') }}
                                    </span>
                                </template>

                                {{-- Action buttons --}}
                                <div class="flex items-center gap-0.5 opacity-0 group-hover:opacity-100 transition-opacity shrink-0">
                                    <button
                                        type="button"
                                        @click="outdent(index)"
                                        :disabled="item.depth === 0"
                                        title="{{ __('filament.menu_builder.outdent') }}"
                                        class="p-1 rounded text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 disabled:opacity-25 disabled:cursor-not-allowed hover:bg-gray-100 dark:hover:bg-white/10 transition-colors"
                                    >
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                                        </svg>
                                    </button>
                                    <button
                                        type="button"
                                        @click="indent(index)"
                                        :disabled="index === 0"
                                        title="{{ __('filament.menu_builder.indent') }}"
                                        class="p-1 rounded text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 disabled:opacity-25 disabled:cursor-not-allowed hover:bg-gray-100 dark:hover:bg-white/10 transition-colors"
                                    >
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </button>
                                    <button
                                        type="button"
                                        @click="startEdit(index)"
                                        title="{{ __('filament.menu_builder.edit') }}"
                                        class="p-1 rounded text-gray-400 hover:text-primary-600 hover:bg-primary-50 dark:hover:bg-primary-900/20 transition-colors"
                                    >
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                        </svg>
                                    </button>
                                    <button
                                        type="button"
                                        @click="removeItem(index)"
                                        title="{{ __('filament.menu_builder.remove') }}"
                                        class="p-1 rounded text-gray-400 hover:text-danger-600 hover:bg-danger-50 dark:hover:bg-danger-900/20 transition-colors"
                                    >
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </template>

                        {{-- Edit form --}}
                        <template x-if="editingIndex === index">
                            <div class="p-3 rounded-lg border border-primary-300 dark:border-primary-500/50 bg-primary-50/50 dark:bg-primary-900/10 space-y-2">
                                <div class="grid grid-cols-2 gap-2">
                                    <div>
                                        <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">{{ __('filament.menu_builder.label') }}</label>
                                        <input
                                            type="text"
                                            x-model="editForm.title"
                                            class="w-full text-sm px-2 py-1.5 rounded-lg border border-gray-300 dark:border-white/20 bg-white dark:bg-white/5 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary-500"
                                        />
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">{{ __('filament.fields.url') }}</label>
                                        <input
                                            type="text"
                                            x-model="editForm.url"
                                            class="w-full text-sm px-2 py-1.5 rounded-lg border border-gray-300 dark:border-white/20 bg-white dark:bg-white/5 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary-500"
                                        />
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-2 items-end">
                                    <div>
                                        <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">{{ __('filament.fields.menu_target') }}</label>
                                        <select
                                            x-model="editForm.target"
                                            class="w-full text-sm px-2 py-1.5 rounded-lg border border-gray-300 dark:border-white/20 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary-500"
                                        >
                                            <option value="_self">{{ __('filament.options.menu_target_self') }}</option>
                                            <option value="_blank">{{ __('filament.options.menu_target_blank') }}</option>
                                        </select>
                                    </div>
                                    <div class="pb-0.5">
                                        <label class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300 cursor-pointer">
                                            <input
                                                type="checkbox"
                                                x-model="editForm.is_active"
                                                class="rounded border-gray-300 text-primary-600 focus:ring-primary-500"
                                            />
                                            {{ __('filament.fields.is_active') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="flex gap-2 justify-end pt-1">
                                    <button
                                        type="button"
                                        @click="cancelEdit()"
                                        class="text-xs px-3 py-1.5 rounded-lg border border-gray-300 dark:border-white/20 text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-white/5 transition-colors"
                                    >
                                        {{ __('filament.menu_builder.cancel') }}
                                    </button>
                                    <button
                                        type="button"
                                        @click="saveEdit()"
                                        class="text-xs px-3 py-1.5 rounded-lg bg-primary-600 hover:bg-primary-700 text-white font-medium transition-colors"
                                    >
                                        {{ __('filament.menu_builder.save') }}
                                    </button>
                                </div>
                            </div>
                        </template>
                    </div>
                </template>

                {{-- Drop zone at the end --}}
                <div
                    x-show="dragFrom !== null"
                    class="h-8 rounded-lg border-2 border-dashed border-primary-300 dark:border-primary-500/40 flex items-center justify-center"
                    @dragover.prevent="dragTo = items.length"
                    @drop.prevent="onDrop(items.length)"
                >
                    <span class="text-xs text-primary-400">{{ __('filament.menu_builder.drop_here') }}</span>
                </div>
            </div>
        </div>
    </div>
</x-dynamic-component>
