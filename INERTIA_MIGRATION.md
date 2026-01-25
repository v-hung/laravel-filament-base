# Laravel + InertiaJS + React - Migration Guide

Ứng dụng Laravel đã được chuyển đổi để sử dụng **InertiaJS** với **ReactJS** làm frontend framework.

## 🚀 Cài đặt và Setup

### Dependencies đã được cài đặt:

**Backend (Composer):**
- `inertiajs/inertia-laravel` - Laravel adapter cho Inertia.js

**Frontend (NPM):**
- `@inertiajs/react` - React adapter cho Inertia.js
- `react` & `react-dom` - React framework
- `@vitejs/plugin-react` - Vite plugin cho React

## 📁 Cấu trúc Mới

```
app/Http/Controllers/
├── InertiaController.php        # Base controller cho Inertia
├── Site/
│   ├── HomeController.php       # ✅ Đã chuyển sang Inertia
│   ├── AboutController.php      # ✅ Đã chuyển sang Inertia
│   └── ContactController.php    # ✅ Đã chuyển sang Inertia
├── Shop/
│   └── ProductController.php    # ✅ Đã chuyển sang Inertia
├── Purchase/
│   └── CartController.php       # ✅ Đã chuyển sang Inertia
└── Content/
    └── PostController.php       # ✅ Đã chuyển sang Inertia

resources/js/
├── app.jsx                      # React app entry point
├── Layouts/
│   ├── AppLayout.jsx           # Main layout component (với user menu)
│   └── GuestLayout.jsx         # Layout cho auth pages
└── Pages/
    ├── Auth/                    # ✅ Authentication pages
    │   ├── Login.jsx           # Login form
    │   └── Register.jsx        # Registration form
    ├── Account/                # ✅ User account pages
    │   └── Profile.jsx         # Profile & settings
    ├── Site/
    │   ├── Index.jsx           # Home page
    │   ├── About.jsx           # About page
    │   └── Contact.jsx         # Contact page
    ├── Shop/
    │   └── Shop.jsx            # Shop listing page
    ├── Purchase/
    │   ├── Cart.jsx            # Shopping cart page
    │   ├── Orders.jsx          # ✅ Order history
    │   └── OrderDetail.jsx     # ✅ Order details
    └── Content/
        ├── Posts.jsx           # Blog listing page
        └── PostDetail.jsx      # Blog detail page
```

## 🔧 Cấu hình

### 1. Middleware
InertiaJS middleware đã được thêm vào `bootstrap/app.php`:

```php
->withMiddleware(function (Middleware $middleware) {
    $middleware->web([
        \App\Http\Middleware\LocaleMiddleware::class,
        \App\Http\Middleware\HandleInertiaRequests::class, // ✅ New
    ]);
})
```

### 2. Shared Data
File `app/Http/Middleware/HandleInertiaRequests.php` chia sẻ data global:

```php
public function share(Request $request): array
{
    return [
        ...parent::share($request),
        'auth' => [
            'user' => $request->user(),
        ],
        'flash' => [
            'message' => fn () => $request->session()->get('message'),
            'error' => fn () => $request->session()->get('error'),
        ],
        'locale' => app()->getLocale(),
    ];
}
```

### 3. Vite Configuration
File `vite.config.js` đã được cập nhật:

```javascript
import react from "@vitejs/plugin-react";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.jsx",  // ✅ Changed from .js to .jsx
                "resources/css/filament/admin/theme.css",
            ],
            refresh: true,
        }),
        react(),  // ✅ Added React plugin
    ],
});
```

## 📝 Cách Sử Dụng

### Tạo Controller Mới

Extend từ `InertiaController` thay vì `Controller`:

```php
use App\Http\Controllers\InertiaController;

class YourController extends InertiaController
{
    public function index()
    {
        return $this->inertia('YourComponent', [
            'data' => $yourData,
        ]);
    }
}
```

### Tạo React Component Mới

Tạo file trong `resources/js/Pages/`:

```jsx
import { Head, Link } from '@inertiajs/react';
import AppLayout from '../Layouts/AppLayout';

export default function YourComponent({ data }) {
    return (
        <AppLayout title="Your Title">
            <Head title="Your Page" />
            
            <div>
                <h1>Your Content</h1>
                <Link href="/somewhere">Go Somewhere</Link>
            </div>
        </AppLayout>
    );
}
```

### Navigation với Inertia

Sử dụng `Link` component thay vì thẻ `<a>`:

```jsx
import { Link } from '@inertiajs/react';

<Link href="/shop" className="...">Shop</Link>
```

### Form Handling

Sử dụng `useForm` hook:

```jsx
import { useForm } from '@inertiajs/react';

export default function ContactForm() {
    const { data, setData, post, processing, errors } = useForm({
        name: '',
        email: '',
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        post('/contact', {
            onSuccess: () => {
                // Handle success
            },
        });
    };

    return (
        <form onSubmit={handleSubmit}>
            <input 
                value={data.name}
                onChange={e => setData('name', e.target.value)}
            />
            {errors.name && <span>{errors.name}</span>}
            
            <button type="submit" disabled={processing}>
                Submit
            </button>
        </form>
    );
}
```

### Routing với Parameters

```jsx
import { router } from '@inertiajs/react';

// GET request with query params
router.get('/shop', { search: 'keyword', page: 2 });

// POST request
router.post('/cart', { product_id: 1, quantity: 2 });

// PATCH request
router.patch(`/cart/${itemId}`, { quantity: 3 });

// DELETE request
router.delete(`/cart/${itemId}`);
```

### Authentication Flow

```jsx
import { router, usePage } from '@inertiajs/react';

// Lấy user hiện tại
const { auth } = usePage().props;
const user = auth.user;

// Kiểm tra login
if (user) {
    // User đã đăng nhập
}

// Logout
router.post(route('logout'));

// Login form
const { data, setData, post, processing, errors } = useForm({
    email: '',
    password: '',
    remember: false,
});

const handleSubmit = (e) => {
    e.preventDefault();
    post(route('login'));
};
```

### Protected Routes

Trong AppLayout, hiển thị menu khác nhau cho guest và authenticated users:

```jsx
import { usePage } from '@inertiajs/react';

const { auth } = usePage().props;

{auth.user ? (
    // Menu cho user đã đăng nhập
    <div>
        <Link href={route('profile')}>Profile</Link>
        <Link href={route('orders')}>Orders</Link>
        <button onClick={handleLogout}>Logout</button>
    </div>
) : (
    // Menu cho guest
    <div>
        <Link href={route('login')}>Login</Link>
        <Link href={route('register')}>Register</Link>
    </div>
)}

## 🛠️ Development

### Chạy Development Server

```bash
docker compose exec app npm run dev
```

### Build Production Assets

```bash
docker compose exec app npm run build
```

### Clear Cache

```bash
docker compose exec app php artisan cache:clear
docker compose exec app php artisan config:clear
docker compose exec app php artisan route:clear
```

## 📦 Features Chính

### ✅ Đã Hoàn Thành

- [x] Setup InertiaJS với React
- [x] Chuyển đổi tất cả controllers sang Inertia
- [x] **Authentication System**
  - [x] Login page với remember me
  - [x] Register page
  - [x] Profile page với update info & password
  - [x] User dropdown menu
  - [x] Logout functionality
- [x] Tạo AppLayout với navigation và user menu
- [x] Tạo GuestLayout cho auth pages
- [x] Home page với products, posts, testimonials
- [x] Shop page với filters và pagination
- [x] Cart page với quantity management
- [x] **Order Management**
  - [x] Order history page
  - [x] Order detail page
- [x] Blog listing và detail pages
- [x] About page
- [x] Contact page với form
- [x] Shared data (auth, flash messages, locale)
- [x] Responsive design với Tailwind CSS

### 🎨 UI Components

Tất cả components được build với:
- **Tailwind CSS** - Utility-first CSS framework
- **React** - Component-based UI
- **InertiaJS** - SPA-like experience

### 🔄 Data Flow

```
Controller → Inertia::render() → React Component → User Interface
     ↓                                    ↓
  Database                           User Actions
     ↑                                    ↓
  Models  ←─────────────────────────  API Calls
```

## 🚨 Lưu Ý Quan Trọng

1. **Filament Admin vẫn hoạt động bình thường** - Không bị ảnh hưởng bởi Inertia migration
2. **API routes** vẫn giữ nguyên trong `routes/api.php`
3. **Authentication** - Sử dụng Laravel Breeze hoặc tự custom
4. **Livewire components** - Nếu có sẽ cần migrate riêng hoặc giữ song song

## 📚 Tài Liệu Tham Khảo

- [InertiaJS Documentation](https://inertiajs.com/)
- [React Documentation](https://react.dev/)
- [Laravel Documentation](https://laravel.com/docs)
- [Tailwind CSS](https://tailwindcss.com/)

## 🤝 Workflow Phát Triển

1. Tạo route trong `routes/web.php`
2. Tạo controller method extend từ `InertiaController`
3. Return data với `$this->inertia('ComponentName', $data)`
4. Tạo React component trong `resources/js/Pages/`
5. Build assets: `npm run build` hoặc `npm run dev`

---

**Chúc bạn code vui vẻ! 🎉**
