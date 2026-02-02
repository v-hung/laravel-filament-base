# Media Manager - Quick Start Guide

## 🎯 Tổng Quan

Custom Media Manager cho Laravel Filament với giao diện full-page, sử dụng Spatie Media Library.

## ✅ Đã Tạo

### 1. **MediaManager Page** - Trang Quản Lý Media

- 📍 URL: `/admin/media-manager`
- 📁 File: `app/Filament/Pages/MediaManager.php`
- 🎨 View: `resources/views/filament/pages/media-manager.blade.php`

**Tính năng:**

- ✅ 2 Tabs: Browse & Selected Files
- ✅ Grid/List View toggle
- ✅ Upload files (multiple)
- ✅ Search & filter by collection
- ✅ Bulk selection & delete
- ✅ Sort by name/size/date
- ✅ Preview images
- ✅ Real-time statistics
- ✅ Dark mode support

### 2. **MediaPicker Field** - Form Component

- 📁 Component: `app/Filament/Forms/Components/MediaPicker.php`
- 🎨 View: `resources/views/filament/forms/components/media-picker.blade.php`

### 3. **Livewire Components**

- `MediaManager` - Logic cho Media Manager page
- `MediaPickerModal` - Modal để chọn media trong forms

## 🚀 Sử Dụng

### Truy Cập Media Manager

Vào menu sidebar Filament → **"Media Manager"** (nhóm Content)

Hoặc truy cập trực tiếp: `/admin/media-manager`

### Sử Dụng MediaPicker Field

```php
use App\Filament\Forms\Components\MediaPicker;

// Chọn 1 ảnh
MediaPicker::make('avatar')
    ->label('Avatar')
    ->required()

// Chọn nhiều ảnh
MediaPicker::make('gallery')
    ->label('Gallery')
    ->multiple()
    ->maxFiles(10)

// Chỉ định collection
MediaPicker::make('product_images')
    ->label('Product Images')
    ->collection('products')
    ->multiple()
```

## 🎨 Giao Diện

**Browse Tab:**

- Grid view: 6 columns (responsive)
- List view: Table với sortable columns
- Toolbar: Search, Filter, View mode, Upload
- Stats: Hiển thị tổng số & số đã chọn
- Actions: Delete selected, Clear selection

**Selected Files Tab:**

- Grid view các files đã chọn
- Quick actions: Delete all, Clear selection

## 📂 File Structure

```
app/
├── Filament/
│   ├── Forms/Components/
│   │   └── MediaPicker.php
│   └── Pages/
│       └── MediaManager.php ← Main page
├── Livewire/
│   ├── MediaManager.php ← Page logic
│   └── MediaPickerModal.php ← Modal for picker
└── Providers/
    └── AppServiceProvider.php ← Registered components

resources/views/
├── filament/
│   ├── forms/components/
│   │   └── media-picker.blade.php
│   └── pages/
│       └── media-manager.blade.php
└── livewire/
    ├── media-manager.blade.php ← Main UI
    └── media-picker-modal.blade.php
```

## 🔧 API

### MediaManager Component (Livewire)

```php
// Switch tabs
switchTab('browse'|'selected')

// Selection
toggleSelect(int $mediaId)
selectAll()
deselectAll()

// Actions
deleteSelected()
deleteMedia(int $mediaId)
uploadNewFiles()

// View options
setViewMode('grid'|'list')
changeSorting(string $field)
```

### MediaPicker Field

```php
MediaPicker::make('field_name')
    ->multiple(bool $condition = true)
    ->collection(?string $collection)
    ->disk(?string $disk)
    ->acceptedFileTypes(array $types)
    ->maxFiles(int $count)
```

## ✨ Tính Năng Nổi Bật

1. **Full-Page Experience** - Không bị giới hạn bởi Resource structure
2. **Real-time UI** - Livewire reactive components
3. **Flexible Views** - Grid hoặc List view
4. **Bulk Operations** - Select & delete nhiều items
5. **Smart Upload** - Upload trực tiếp từ page
6. **Collection Support** - Organize media theo collections
7. **Dark Mode** - Full support Filament dark mode
8. **Mobile Responsive** - Works on all screen sizes

## 🎯 Next Steps

1. ✅ Truy cập `/admin/media-manager`
2. ✅ Upload một số ảnh test
3. ✅ Thử các tính năng: search, filter, sort, bulk delete
4. ✅ Dùng MediaPicker field trong forms
5. ✅ Customize UI nếu cần

## 🐛 Troubleshooting

**Không thấy trang Media Manager?**

- Kiểm tra user có quyền truy cập
- Clear cache: `php artisan filament:cache-components`

**Upload không hoạt động?**

- Kiểm tra quyền thư mục `storage/app/public`
- Chạy: `php artisan storage:link`

**Livewire errors?**

- Kiểm tra components đã register trong `AppServiceProvider`
- Clear cache: `php artisan livewire:discover`

---

**Happy managing! 🎉**
