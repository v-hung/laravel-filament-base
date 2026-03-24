<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <div x-data="{
        state: $wire.entangle('{{ $getStatePath() }}'),
        _itemTypes: @js($getItemTypes()),
        openPanels: ['custom'],

        /* ── Active locale (synced from Livewire) ── */
        activeLang: $wire.activeLocale || '{{ app()->getLocale() }}',

        /* ── Add form (left panel) ── */
        addForm: { type: 'custom', title: '', url: '', target: '_self', linkable_id: null, linkable_type: null, title_translations: {} },

        /* ── Model checkboxes (per typeKey) ── */
        selected: {},
        search: {},

        init() {
            Object.keys(this._itemTypes).forEach(k => { this.selected[k] = []; });

            // Watch Livewire activeLocale: only update activeLang, never touch this.state
            // (modifying this.state here would cause spurious Livewire requests and race conditions)
            $wire.$watch('activeLocale', (locale) => {
                if (!locale) return;
                this.activeLang = locale;

                // Reset add form title for new locale
                this.addForm = { ...this.addForm, title: '' };

                // Update edit form title if currently editing
                if (this.editingIndex !== null) {
                    const item = (this.state || [])[this.editingIndex];
                    if (item) {
                        this.editForm = { ...this.editForm, title: this.getTitleForDisplay(item) };
                    }
                }
            });
        },

        /* ── Drag ── */
        dragFrom: null,
        dragTo: null,

        /* ── Inline edit ── */
        editingIndex: null,
        editForm: {},

        get items() { return this.state || []; },
        get itemTypes() { return this._itemTypes; },

        /* ─── Display helpers ──────────────────────────────────── */

        getTitleForDisplay(item) {
            const t = item.title_translations;
            if (t && typeof t === 'object' && this.activeLang in t) {
                return t[this.activeLang];
            }
            return item.title || '';
        },

        /* ─── Helpers ─────────────────────────────────────────── */

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

        /* ─── Add form helpers ─────────────────────────────────── */

        onAddTypeChange() {
            this.addForm.url = '';
            this.addForm.linkable_id = null;
            this.addForm.linkable_type = null;
            this.addForm.title = '';
            this.addForm.title_translations = {};
        },

        onAddLinkableChange() {
            const typeKey = this.addForm.type;
            const id = this.addForm.linkable_id;
            if (!typeKey || typeKey === 'custom' || !id) { return; }
            const items = this.itemTypes[typeKey]?.items || [];
            const found = items.find(i => String(i.id) === String(id));
            if (found) {
                this.addForm.url = found.url || '';
                this.addForm.title_translations = found.title_translations || {};
                if (!this.addForm.title) {
                    this.addForm.title = this.getTitleForDisplay(found);
                }
                this.addForm.linkable_type = this.itemTypes[typeKey]?.linkable_type || null;
            }
        },

        addFormIsValid() {
            if (!this.addForm.title) return false;
            if (this.addForm.type === 'custom') return !!this.addForm.url;
            return !!this.addForm.linkable_id;
        },

        addItem() {
            if (!this.addFormIsValid()) return;
            this.state = [...(this.state || []), {
                id: null,
                temp_id: this.generateId(),
                parent_temp_id: null,
                title: this.addForm.title,
                title_locale: this.activeLang,
                title_translations: { ...this.addForm.title_translations, [this.activeLang]: this.addForm.title },
                type: this.addForm.type,
                linkable_type: this.addForm.linkable_type,
                linkable_id: this.addForm.linkable_id ? Number(this.addForm.linkable_id) : null,
                url: this.addForm.url,
                target: this.addForm.target,
                icon: '',
                depth: 0,
                is_active: true,
            }];
            this.addForm = { type: this.addForm.type, title: '', url: '', target: '_self', linkable_id: null, linkable_type: null, title_translations: {} };
        },

        /* ─── Model-accordion multi-add (existing behaviour) ───── */

        addModelItems(typeKey, typeItems) {
            const selectedIds = this.selected[typeKey] || [];
            if (!selectedIds.length) return;
            const newItems = typeItems
                .filter(item => selectedIds.includes(item.id))
                .map(item => ({
                    id: null,
                    temp_id: this.generateId(),
                    parent_temp_id: null,
                    title: this.getTitleForDisplay(item),
                    title_locale: this.activeLang,
                    title_translations: item.title_translations || {},
                    type: typeKey,
                    linkable_type: this.itemTypes[typeKey]?.linkable_type || null,
                    linkable_id: item.id,
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
            return items.filter(i => this.getTitleForDisplay(i).toLowerCase().includes(q));
        },

        /* ─── Drag & Drop ──────────────────────────────────────── */

        onDragStart(index) { this.dragFrom = index; },
        onDragOver(index) { if (this.dragFrom === null) return;
            this.dragTo = index; },

        onDrop(index) {
            const from = this.dragFrom;
            if (from === null || from === index) { this.dragFrom = null;
                this.dragTo = null; return; }
            const items = [...(this.state || [])];

            // Extract entire subtree (dragged item + all its descendants)
            const fromDepth = items[from].depth;
            let subtreeEnd = from + 1;
            while (subtreeEnd < items.length && items[subtreeEnd].depth > fromDepth) subtreeEnd++;
            const subtreeLen = subtreeEnd - from;
            const subtree = items.splice(from, subtreeLen);

            // Recalculate insertion point after extraction
            const insertAt = Math.max(0, Math.min(
                index > from ? index - subtreeLen : index,
                items.length
            ));
            items.splice(insertAt, 0, ...subtree);
            this.state = items;
            this.dragFrom = null;
            this.dragTo = null;
        },

        /* ─── Indent / Outdent ─────────────────────────────────── */

        indent(index) {
            if (index === 0) return;
            const items = [...(this.state || [])];
            const current = items[index];
            const prev = items[index - 1];
            if (current.depth <= prev.depth) {
                const newDepth = current.depth + 1;
                const newParent = this._findParentByDepth(items, index, newDepth);
                items[index] = { ...current, depth: newDepth, parent_temp_id: newParent };
                this.state = items;
            }
        },

        outdent(index) {
            const items = [...(this.state || [])];
            const current = items[index];
            if (current.depth > 0) {
                const newDepth = current.depth - 1;
                const newParent = newDepth === 0 ? null : this._findParentByDepth(items, index, newDepth);
                items[index] = { ...current, depth: newDepth, parent_temp_id: newParent };
                this.state = items;
            }
        },

        _findParentByDepth(items, fromIndex, targetDepth) {
            for (let i = fromIndex - 1; i >= 0; i--) {
                if (items[i].depth === targetDepth - 1) return items[i].temp_id;
            }
            return null;
        },

        /* ─── Remove ───────────────────────────────────────────── */

        removeItem(index) {
            const items = [...(this.state || [])];
            const depth = items[index].depth;
            let end = index + 1;
            while (end < items.length && items[end].depth > depth) end++;
            items.splice(index, end - index);
            this.state = items;
        },

        /* ─── Edit form ────────────────────────────────────────── */

        startEdit(index) {
            this.editingIndex = index;
            const item = { ...(this.state || [])[index] };
            item.parent_temp_id = item.parent_temp_id ?? '';
            // Always show the current locale's translation in the edit field
            item.title = this.getTitleForDisplay(item);
            this.editForm = item;
        },

        onEditTypeChange() {
            this.editForm.url = '';
            this.editForm.linkable_id = null;
            this.editForm.linkable_type = null;
        },

        onEditLinkableChange() {
            const typeKey = this.editForm.type;
            const id = this.editForm.linkable_id;
            if (!typeKey || typeKey === 'custom' || !id) return;
            const items = this.itemTypes[typeKey]?.items || [];
            const found = items.find(i => String(i.id) === String(id));
            if (found) {
                this.editForm.url = found.url || '';
                this.editForm.title = this.getTitleForDisplay(found);
                this.editForm.linkable_type = this.itemTypes[typeKey]?.linkable_type || null;
            }
        },

        onEditParentChange() {
            const parentTempId = this.editForm.parent_temp_id;
            if (!parentTempId) {
                this.editForm.depth = 0;
            } else {
                const parent = this.items.find(i => i.temp_id === parentTempId);
                if (parent) { this.editForm.depth = parent.depth + 1; }
            }
        },

        /* Items available as parent (exclude self and descendants) */
        getParentOptions() {
            const idx = this.editingIndex;
            if (idx === null) return [];
            const items = this.items;
            const selfDepth = items[idx]?.depth ?? 0;
            let endIdx = idx + 1;
            while (endIdx < items.length && items[endIdx].depth > selfDepth) endIdx++;
            const excluded = new Set(items.slice(idx, endIdx).map(i => i.temp_id));
            return items.filter(i => !excluded.has(i.temp_id));
        },

        saveEdit() {
            const items = [...(this.state || [])];
            const oldItem = items[this.editingIndex];
            const oldParent = oldItem.parent_temp_id || null;
            const newParent = this.editForm.parent_temp_id || null;

            // Merge the edited title into title_translations for the active locale
            const mergedTranslations = { ...(oldItem.title_translations || {}), [this.activeLang]: this.editForm.title };
            const newItem = {
                ...oldItem, ...this.editForm,
                parent_temp_id: newParent,
                title_locale: this.activeLang,
                title_translations: mergedTranslations,
            };

            if (newParent !== oldParent) {
                // Extract the subtree
                const oldDepth = oldItem.depth;
                let endIdx = this.editingIndex + 1;
                while (endIdx < items.length && items[endIdx].depth > oldDepth) endIdx++;
                const subtree = items.splice(this.editingIndex, endIdx - this.editingIndex);

                // Update depths
                const depthDiff = newItem.depth - oldDepth;
                const updatedSubtree = subtree.map((itm, i) =>
                    i === 0 ? { ...itm, ...this.editForm, depth: newItem.depth, title_locale: this.activeLang, title_translations: mergedTranslations } :
                    { ...itm, depth: itm.depth + depthDiff }
                );

                // Find insertion point: after parent's last child
                let insertAt = items.length;
                if (newItem.parent_temp_id) {
                    const parentIdx = items.findIndex(i => i.temp_id === newItem.parent_temp_id);
                    if (parentIdx !== -1) {
                        const parentDepth = items[parentIdx].depth;
                        insertAt = parentIdx + 1;
                        while (insertAt < items.length && items[insertAt].depth > parentDepth) insertAt++;
                    }
                }

                items.splice(insertAt, 0, ...updatedSubtree);
                this.state = items;
            } else {
                items[this.editingIndex] = newItem;
                this.state = items;
            }

            this.editingIndex = null;
            this.editForm = {};
        },

        cancelEdit() {
            this.editingIndex = null;
            this.editForm = {};
        },
    }" class="flex gap-4" style="min-height: 420px">
        {{-- ── Left Panel: Item type pickers ── --}}
        <div class="w-72 shrink-0 space-y-2 self-start">
            <template x-for="[typeKey, typeConfig] in Object.entries(itemTypes)" :key="typeKey">
                <template x-if="typeKey === 'custom'">
                <div
                    class="rounded-xl border border-gray-200 dark:border-white/10 overflow-hidden bg-white dark:bg-gray-900 shadow-sm">

                    {{-- Accordion header --}}
                    <button type="button" @click="togglePanel(typeKey)"
                        class="w-full flex items-center justify-between px-3 py-2.5 text-sm font-semibold text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                        <span>{{ __('filament.menu_builder.add_link') }}</span>
                        <svg class="w-4 h-4 text-gray-400 transition-transform duration-200"
                            :class="{ 'rotate-180': openPanels.includes(typeKey) }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    {{-- Accordion body --}}
                    <div x-show="openPanels.includes(typeKey)" x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 -translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="border-t border-gray-100 dark:border-white/10">
                        {{-- ── Unified "Custom Link" panel with type selector ── --}}
                        <template x-if="typeKey === 'custom'">
                            <div class="p-3 space-y-2">

                                {{-- Type selector --}}
                                <div>
                                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">
                                        {{ __('filament.menu_builder.link_type') }}
                                    </label>
                                    <select x-model="addForm.type" @change="onAddTypeChange()"
                                        class="w-full text-sm px-2.5 py-1.5 rounded-lg border border-gray-300 dark:border-white/20 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary-500">
                                        <template x-for="[tKey, tConf] in Object.entries(itemTypes)"
                                            :key="tKey">
                                            <option :value="tKey" x-text="tConf.label"></option>
                                        </template>
                                    </select>
                                </div>

                                {{-- Label --}}
                                <div>
                                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">
                                        {{ __('filament.menu_builder.label') }}
                                    </label>
                                    <input type="text" x-model="addForm.title"
                                        placeholder="{{ __('filament.menu_builder.label_placeholder') }}"
                                        class="w-full text-sm px-2.5 py-1.5 rounded-lg border border-gray-300 dark:border-white/20 bg-white dark:bg-white/5 text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent" />
                                </div>

                                {{-- URL (custom only) --}}
                                <template x-if="addForm.type === 'custom'">
                                    <div>
                                        <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">
                                            {{ __('filament.fields.url') }}
                                        </label>
                                        <input type="text" x-model="addForm.url" placeholder="https://..."
                                            class="w-full text-sm px-2.5 py-1.5 rounded-lg border border-gray-300 dark:border-white/20 bg-white dark:bg-white/5 text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent" />
                                    </div>
                                </template>

                                {{-- Model selector (non-custom) --}}
                                <template x-if="addForm.type !== 'custom'">
                                    <div>
                                        <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">
                                            {{ __('filament.menu_builder.select_item') }}
                                        </label>
                                        <select x-model="addForm.linkable_id" @change="onAddLinkableChange()"
                                            class="w-full text-sm px-2.5 py-1.5 rounded-lg border border-gray-300 dark:border-white/20 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary-500">
                                            <option value="">—
                                                {{ __('filament.menu_builder.select_placeholder') }} —</option>
                                            <template x-for="item in (itemTypes[addForm.type]?.items || [])"
                                                :key="item.id">
                                                <option :value="item.id" x-text="item.title"></option>
                                            </template>
                                        </select>
                                        <template x-if="addForm.url">
                                            <p class="mt-1 text-xs text-gray-400 truncate" x-text="addForm.url"></p>
                                        </template>
                                    </div>
                                </template>

                                {{-- Target --}}
                                <div>
                                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">
                                        {{ __('filament.fields.menu_target') }}
                                    </label>
                                    <select x-model="addForm.target"
                                        class="w-full text-sm px-2.5 py-1.5 rounded-lg border border-gray-300 dark:border-white/20 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary-500">
                                        <option value="_self">{{ __('filament.options.menu_target_self') }}</option>
                                        <option value="_blank">{{ __('filament.options.menu_target_blank') }}</option>
                                    </select>
                                </div>

                                <button type="button" @click="addItem()" :disabled="!addFormIsValid()"
                                    class="w-full text-sm py-1.5 px-3 rounded-lg bg-primary-600 hover:bg-primary-700 disabled:opacity-40 disabled:cursor-not-allowed text-white font-medium transition-colors">
                                    {{ __('filament.menu_builder.add_to_menu') }}
                                </button>
                            </div>
                        </template>

                        {{-- ── Model-based accordion (multi-select) ── --}}
                        <template x-if="typeKey !== 'custom'">
                            <div class="p-3 space-y-2">
                                <input type="text" x-model="search[typeKey]"
                                    placeholder="{{ __('filament.menu_builder.search_placeholder') }}"
                                    class="w-full text-sm px-2.5 py-1.5 rounded-lg border border-gray-300 dark:border-white/20 bg-white dark:bg-white/5 text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent" />
                                <div
                                    class="max-h-52 overflow-y-auto rounded-lg border border-gray-200 dark:border-white/10 divide-y divide-gray-100 dark:divide-white/5">
                                    <template x-for="item in filteredItems(typeKey, typeConfig.items || [])"
                                        :key="item.id">
                                        <label
                                            class="flex items-center gap-2.5 px-2.5 py-2 hover:bg-gray-50 dark:hover:bg-white/5 cursor-pointer">
                                            <input type="checkbox" :value="item.id" x-model="selected[typeKey]"
                                                class="rounded border-gray-300 text-primary-600 focus:ring-primary-500" />
                                            <span class="text-sm text-gray-700 dark:text-gray-300 truncate"
                                                x-text="getTitleForDisplay(item)"></span>
                                        </label>
                                    </template>
                                    <template x-if="!filteredItems(typeKey, typeConfig.items || []).length">
                                        <div class="px-3 py-4 text-center text-xs text-gray-400">
                                            {{ __('filament.menu_builder.no_results') }}
                                        </div>
                                    </template>
                                </div>
                                <button type="button" @click="addModelItems(typeKey, typeConfig.items || [])"
                                    :disabled="!(selected[typeKey] || []).length"
                                    class="w-full text-sm py-1.5 px-3 rounded-lg bg-primary-600 hover:bg-primary-700 disabled:opacity-40 disabled:cursor-not-allowed text-white font-medium transition-colors">
                                    {{ __('filament.menu_builder.add_to_menu') }}
                                    <span x-show="(selected[typeKey] || []).length > 0"
                                        x-text="' (' + (selected[typeKey] || []).length + ')'"
                                        class="opacity-80"></span>
                                </button>
                            </div>
                        </template>
                    </div>
                </div>
                </template>
            </template>
        </div>

        {{-- ── Right Panel: Menu tree ── --}}
        <div
            class="flex-1 flex flex-col rounded-xl border border-gray-200 dark:border-white/10 bg-white dark:bg-gray-900 shadow-sm overflow-hidden">

            {{-- Header --}}
            <div
                class="px-4 py-3 border-b border-gray-100 dark:border-white/10 flex items-center justify-between shrink-0">
                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200">
                    {{ __('filament.menu_builder.structure_title') }}
                </h3>
                <span class="text-xs text-gray-400"
                    x-text="items.length + ' {{ __('filament.menu_builder.items_count') }}'"></span>
            </div>

            {{-- Items --}}
            <div class="flex-1 overflow-y-auto p-3 space-y-1"
                @dragover.prevent="dragTo = items.length" @drop.prevent="onDrop(items.length)">

                {{-- Empty state --}}
                <template x-if="items.length === 0">
                    <div class="flex flex-col items-center justify-center h-48 text-center select-none">
                        <svg class="w-10 h-10 text-gray-200 dark:text-white/10 mb-3" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M4 6h16M4 12h8m-8 6h16" />
                        </svg>
                        <p class="text-sm text-gray-400">{{ __('filament.menu_builder.empty_title') }}</p>
                        <p class="text-xs text-gray-300 dark:text-white/20 mt-1">
                            {{ __('filament.menu_builder.empty_hint') }}</p>
                    </div>
                </template>

                {{-- Draggable list --}}
                <template x-for="(item, index) in items" :key="item.temp_id">
                    <div class="group" :style="'padding-left: ' + (item.depth * 28) + 'px'" draggable="true"
                        @dragstart.stop="onDragStart(index)" @dragover.prevent.stop="onDragOver(index)"
                        @drop.prevent.stop="onDrop(index)" @dragend="dragFrom = null; dragTo = null">
                        {{-- Normal view --}}
                        <template x-if="editingIndex !== index">
                            <div class="flex items-center gap-2 px-2.5 py-2 rounded-lg border transition-all duration-100 cursor-default"
                                :class="{
                                    'border-primary-400 bg-primary-50 dark:bg-primary-900/20 shadow-sm': dragTo ===
                                        index && dragFrom !== null && dragFrom !== index,
                                    'border-gray-200 dark:border-white/10 bg-white dark:bg-white/5 hover:bg-gray-50 dark:hover:bg-white/[0.07]':
                                        !(dragTo === index && dragFrom !== null && dragFrom !== index),
                                }">
                                {{-- Drag handle --}}
                                <div
                                    class="cursor-grab active:cursor-grabbing text-gray-300 hover:text-gray-500 dark:text-white/20 dark:hover:text-white/50 shrink-0">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 16 16">
                                        <circle cx="5" cy="4" r="1.3" />
                                        <circle cx="5" cy="8" r="1.3" />
                                        <circle cx="5" cy="12" r="1.3" />
                                        <circle cx="11" cy="4" r="1.3" />
                                        <circle cx="11" cy="8" r="1.3" />
                                        <circle cx="11" cy="12" r="1.3" />
                                    </svg>
                                </div>

                                {{-- Nesting indicator --}}
                                <template x-if="item.depth > 0">
                                    <svg class="w-3 h-3 text-gray-300 dark:text-white/20 shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </template>

                                {{-- Title + URL --}}
                                <div class="flex-1 min-w-0">
                                    <div class="text-sm font-medium text-gray-800 dark:text-gray-100 truncate"
                                        x-text="getTitleForDisplay(item)"></div>
                                    <div class="text-xs text-gray-400 truncate" x-text="item.url" x-show="item.url">
                                    </div>
                                </div>

                                {{-- Type badge (non-custom) --}}
                                <template x-if="item.type && item.type !== 'custom'">
                                    <span
                                        class="text-xs bg-primary-50 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400 px-1.5 py-0.5 rounded shrink-0"
                                        x-text="itemTypes[item.type]?.label || item.type"></span>
                                </template>

                                {{-- New tab badge --}}
                                <template x-if="item.target === '_blank'">
                                    <span class="text-xs text-gray-400 shrink-0"
                                        title="{{ __('filament.options.menu_target_blank') }}">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                        </svg>
                                    </span>
                                </template>

                                {{-- Inactive badge --}}
                                <template x-if="!item.is_active">
                                    <span
                                        class="text-xs bg-gray-100 dark:bg-white/10 text-gray-400 px-1.5 py-0.5 rounded shrink-0">
                                        {{ __('filament.menu_builder.inactive') }}
                                    </span>
                                </template>

                                {{-- Action buttons --}}
                                <div
                                    class="flex items-center gap-0.5 opacity-0 group-hover:opacity-100 transition-opacity shrink-0">
                                    <button type="button" @click="outdent(index)" :disabled="item.depth === 0"
                                        title="{{ __('filament.menu_builder.outdent') }}"
                                        class="p-1 rounded text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 disabled:opacity-25 disabled:cursor-not-allowed hover:bg-gray-100 dark:hover:bg-white/10 transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M15 19l-7-7 7-7" />
                                        </svg>
                                    </button>
                                    <button type="button" @click="indent(index)" :disabled="index === 0"
                                        title="{{ __('filament.menu_builder.indent') }}"
                                        class="p-1 rounded text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 disabled:opacity-25 disabled:cursor-not-allowed hover:bg-gray-100 dark:hover:bg-white/10 transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                    </button>
                                    <button type="button" @click="startEdit(index)"
                                        title="{{ __('filament.menu_builder.edit') }}"
                                        class="p-1 rounded text-gray-400 hover:text-primary-600 hover:bg-primary-50 dark:hover:bg-primary-900/20 transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </button>
                                    <button type="button" @click="removeItem(index)"
                                        title="{{ __('filament.menu_builder.remove') }}"
                                        class="p-1 rounded text-gray-400 hover:text-danger-600 hover:bg-danger-50 dark:hover:bg-danger-900/20 transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </template>

                        {{-- ── Edit form ── --}}
                        <template x-if="editingIndex === index">
                            <div
                                class="p-3 rounded-lg border border-primary-300 dark:border-primary-500/50 bg-primary-50/50 dark:bg-primary-900/10 space-y-2.5">

                                {{-- Row 1: Type + Parent --}}
                                <div class="grid grid-cols-2 gap-2">
                                    <div>
                                        <label
                                            class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">{{ __('filament.menu_builder.link_type') }}</label>
                                        <select @change="editForm.type = $event.target.value; onEditTypeChange()"
                                            class="w-full text-sm px-2 py-1.5 rounded-lg border border-gray-300 dark:border-white/20 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary-500">
                                            <template x-for="[tKey, tConf] in Object.entries(itemTypes)"
                                                :key="tKey">
                                                <option :value="tKey" :selected="tKey === editForm.type" x-text="tConf.label"></option>
                                            </template>
                                        </select>
                                    </div>
                                    <div>
                                        <label
                                            class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">{{ __('filament.menu_builder.parent_item') }}</label>
                                        <select x-model="editForm.parent_temp_id" @change="onEditParentChange()"
                                            class="w-full text-sm px-2 py-1.5 rounded-lg border border-gray-300 dark:border-white/20 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary-500">
                                            <option value="" :selected="!editForm.parent_temp_id">— {{ __('filament.menu_builder.no_parent') }} —
                                            </option>
                                            <template x-for="opt in getParentOptions()" :key="opt.temp_id">
                                                <option :value="opt.temp_id"
                                                    :selected="opt.temp_id === editForm.parent_temp_id"
                                                    x-text="'—'.repeat(opt.depth) + ' ' + getTitleForDisplay(opt)"></option>
                                            </template>
                                        </select>
                                    </div>
                                </div>

                                {{-- Row 2: Label --}}
                                <div>
                                    <label
                                        class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">{{ __('filament.menu_builder.label') }}</label>
                                    <input type="text" x-model="editForm.title"
                                        class="w-full text-sm px-2 py-1.5 rounded-lg border border-gray-300 dark:border-white/20 bg-white dark:bg-white/5 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary-500" />
                                </div>

                                {{-- Row 3: URL (custom) or Model selector (non-custom) --}}
                                <template x-if="editForm.type === 'custom'">
                                    <div>
                                        <label
                                            class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">{{ __('filament.fields.url') }}</label>
                                        <input type="text" x-model="editForm.url"
                                            class="w-full text-sm px-2 py-1.5 rounded-lg border border-gray-300 dark:border-white/20 bg-white dark:bg-white/5 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary-500" />
                                    </div>
                                </template>

                                <template x-if="editForm.type && editForm.type !== 'custom'">
                                    <div>
                                        <label
                                            class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">{{ __('filament.menu_builder.select_item') }}</label>
                                        <select @change="editForm.linkable_id = $event.target.value; onEditLinkableChange()"
                                            class="w-full text-sm px-2 py-1.5 rounded-lg border border-gray-300 dark:border-white/20 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary-500">
                                            <option value="">—
                                                {{ __('filament.menu_builder.select_placeholder') }} —</option>
                                            <template x-for="item in (itemTypes[editForm.type]?.items || [])"
                                                :key="item.id">
                                                <option :value="item.id" :selected="String(item.id) === String(editForm.linkable_id)" x-text="item.title"></option>
                                            </template>
                                        </select>
                                        <template x-if="editForm.url">
                                            <p class="mt-1 text-xs text-gray-400 truncate" x-text="editForm.url"></p>
                                        </template>
                                    </div>
                                </template>

                                {{-- Row 4: Target + Active --}}
                                <div class="grid grid-cols-2 gap-2 items-end">
                                    <div>
                                        <label
                                            class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">{{ __('filament.fields.menu_target') }}</label>
                                        <select x-model="editForm.target"
                                            class="w-full text-sm px-2 py-1.5 rounded-lg border border-gray-300 dark:border-white/20 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary-500">
                                            <option value="_self">{{ __('filament.options.menu_target_self') }}
                                            </option>
                                            <option value="_blank">{{ __('filament.options.menu_target_blank') }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="pb-0.5">
                                        <label
                                            class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300 cursor-pointer">
                                            <input type="checkbox" x-model="editForm.is_active"
                                                class="rounded border-gray-300 text-primary-600 focus:ring-primary-500" />
                                            {{ __('filament.fields.is_active') }}
                                        </label>
                                    </div>
                                </div>

                                {{-- Actions --}}
                                <div class="flex gap-2 justify-end pt-1">
                                    <button type="button" @click="cancelEdit()"
                                        class="text-xs px-3 py-1.5 rounded-lg border border-gray-300 dark:border-white/20 text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                                        {{ __('filament.menu_builder.cancel') }}
                                    </button>
                                    <button type="button" @click="saveEdit()"
                                        class="text-xs px-3 py-1.5 rounded-lg bg-primary-600 hover:bg-primary-700 text-white font-medium transition-colors">
                                        {{ __('filament.menu_builder.save') }}
                                    </button>
                                </div>
                            </div>
                        </template>
                    </div>
                </template>

            </div>
        </div>
    </div>
</x-dynamic-component>
