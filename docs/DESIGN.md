# DUYANG Website — Design System Reference

> **For Claude:** Read `docs/DESIGN.md` before building any component or page for this project.
> CSS file: `resources/css/duyang-design-system.css`
> It must be imported in `resources/css/app.css` with `@import './duyang-design-system.css';`

---

## 1. Colors

Six colors. Use them everywhere. No arbitrary hex values.

| Semantic name       | CSS variable              | Tailwind class             | Hex       | Usage                                |
|---------------------|---------------------------|----------------------------|-----------|--------------------------------------|
| Black               | `var(--duyang-black)`     | `text-duyang-black` / `bg-duyang-black`       | `#111111` | Primary text, headings, icons        |
| Grey                | `var(--duyang-grey)`      | `text-duyang-grey` / `bg-duyang-grey`         | `#565656` | Secondary text, metadata             |
| Grey Mid            | `var(--duyang-grey-mid)`  | `text-duyang-grey-mid` / `bg-duyang-grey-mid` | `#7A7A7A` | Placeholder text, disabled states    |
| Grey Light          | `var(--duyang-grey-light)`| `text-duyang-grey-light`                      | `#9E9E9E` | Decorative section labels, borders   |
| Cream               | `var(--duyang-cream)`     | `bg-duyang-cream`                             | `#F8F6F1` | Page background, card backgrounds    |
| White               | `var(--duyang-white)`     | `bg-duyang-white`                             | `#FFFFFF` | Card surface, content containers     |

### Color rules
- **Page background** → always `bg-duyang-cream` (`#F8F6F1`)
- **Card / container surface** → `bg-duyang-white` with `rounded-duyang-card`
- **Primary text** → `text-duyang-black`
- **Secondary / muted text** → `text-duyang-grey`
- **No decorative colors** — the palette is intentionally monochromatic/warm-neutral

---

## 2. Typography

**Primary typeface: Manrope** (all text — headings, body, buttons, labels).

Must be loaded via Google Fonts or `@fontsource-variable/manrope`:
```html
<!-- In your Blade layout <head> -->
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
```

### Pre-composed text classes (use these in components)

| Class            | Size  | Weight          | Line Height | Use for                              |
|------------------|-------|-----------------|-------------|--------------------------------------|
| `.text-display`  | 56px  | Bold 700        | 1.1         | Hero section, page title             |
| `.text-logo`     | 28px  | SemiBold 600    | 0.98        | Brand logotype (uppercase + tracking)|
| `.text-label`    | 24px  | Bold 700        | 1.25        | Section headings, card titles        |
| `.text-body-lg`  | 18px  | SemiBold 600    | 1.45        | Prominent body copy, card subtitles  |
| `.text-body-md`  | 16px  | SemiBold 600    | 1.60        | Standard UI text, nav items          |
| `.text-body-sm`  | 14px  | Medium 500      | 1.45        | Small UI text, tags, captions        |
| `.text-muted`    | 14px  | Regular 400     | 1.45        | Metadata, secondary info, specs      |

### Tailwind font-size tokens (use when you need just the size)

```html
text-duyang-display   <!-- 56px -->
text-duyang-logo      <!-- 28px -->
text-duyang-h4        <!-- 24px -->
text-duyang-body-lg   <!-- 18px -->
text-duyang-body-md   <!-- 16px -->
text-duyang-body-sm   <!-- 14px -->
```

### Font weight tokens

```html
font-duyang-regular    <!-- 400 -->
font-duyang-medium     <!-- 500 -->
font-duyang-semibold   <!-- 600 -->
font-duyang-bold       <!-- 700 -->
```

### Typography examples

```html
<!-- Hero headline -->
<h1 class="text-display">Crafted for your space</h1>

<!-- Section title -->
<h2 class="text-label">Our collections</h2>

<!-- Body paragraph -->
<p class="text-body-sm">We source sustainable materials from local artisans.</p>

<!-- Muted metadata -->
<span class="text-muted">12 products · Updated Jan 2025</span>
```

---

## 3. Spacing & Layout

Spacing values used in the Figma design. Stick to these when building layouts.

| Purpose                  | Value  | Tailwind equivalent  |
|--------------------------|--------|----------------------|
| Page outer padding       | 52px   | `px-13` or `p-13`   |
| Section body padding     | 64px   | `p-16`               |
| Card internal padding    | 48px   | `p-12`               |
| Gap between cards        | 60–64px| `gap-16`             |
| Gap between sections     | 48px   | `gap-12`             |
| Gap between items        | 32px   | `gap-8`              |
| Gap between text lines   | 8px    | `gap-2`              |

---

## 4. Border Radius

| Token                    | Value  | Tailwind class           | Use for                            |
|--------------------------|--------|--------------------------|------------------------------------|
| `--radius-duyang-sm`     | 4px    | `rounded-duyang-sm`      | Color chips, small badges, inputs  |
| `--radius-duyang-card`   | 24px   | `rounded-duyang-card`    | Cards, containers, modals          |

---

## 5. Surface / Container Helpers

Pre-composed classes for common containers:

```html
<!-- Page wrapper (cream background) -->
<div class="surface-page min-h-screen">...</div>

<!-- White card -->
<div class="surface-card p-12">...</div>
```

---

## 6. Icons

- All icons are **24×24px** (`icon-base` class applies this size).
- Icon set: **Phosphor Icons** (SealCheck, ClockCountdown, UserFocus, Truck, Hammer, Couch, Leaf, Basket, MagnifyingGlass, Star, StarFill, Plus, Minus, Arrows, Carets, Social logos, etc.)
- Icons are always `text-duyang-black` unless intentionally muted.

```html
<!-- Standard icon wrapper -->
<div class="icon-base">
    <!-- icon SVG or img here -->
</div>
```

---

## 7. Avatars / User Images

| Class        | Size  | Description                     |
|--------------|-------|---------------------------------|
| `.avatar-sm` | 30px  | Small, inline contexts          |
| `.avatar-md` | 36px  | Form fields, compact lists      |
| `.avatar-lg` | 40px  | Standard avatar                 |
| `.avatar-xl` | 56px  | User image thumbnail, profiles  |

Avatar backgrounds use `bg-duyang-cream`. Shape is **square** (not circular) — matching the design's geometric aesthetic.

---

## 8. Component Patterns

### Card

```html
<div class="surface-card p-12">
    <h3 class="text-label mb-4">Title</h3>
    <p class="text-body-sm">Description text goes here.</p>
</div>
```

### Page layout

```html
<div class="surface-page px-13 pt-13 pb-17.5">
    <!-- Header -->
    <header class="mb-12">
        <span class="text-logo">Brand</span>
    </header>

    <!-- Body -->
    <main class="p-16 flex flex-wrap gap-16">
        <div class="surface-card p-12">...</div>
    </main>
</div>
```

### Logo

```html
<span class="text-logo">Infurnish</span>
```

### Typography hierarchy in a section

```html
<section>
    <h1 class="text-display mb-6">Headline</h1>
    <p class="text-body-lg mb-3">Lead paragraph, semi-bold.</p>
    <p class="text-body-sm">Standard body copy, medium weight.</p>
    <span class="text-muted">Metadata or secondary info.</span>
</section>
```

---

## 9. Do's and Don'ts

| Do                                                                  | Don't                                              |
|---------------------------------------------------------------------|----------------------------------------------------|
| Use `bg-duyang-cream` for page backgrounds                          | Use `bg-white` or `bg-gray-50` as page background  |
| Use `rounded-duyang-card` (24px) for all cards                      | Use `rounded-xl` or `rounded-2xl` directly         |
| Use `.text-display` / `.text-label` / `.text-body-*` classes        | Use arbitrary `text-[56px]` font sizes             |
| Apply `font-duyang` to all text elements                            | Mix in system fonts or other typefaces             |
| Keep the palette to 6 colors only                                   | Add accent/brand colors not in the palette         |
| Use `text-duyang-grey` for secondary text                           | Use Tailwind's default gray scale                  |
| Use `icon-base` wrapper for all icons                               | Set icon sizes manually with arbitrary values      |

---

## 10. File Reference

```
docs/DESIGN.md                           ← this file (design system reference for Claude)
resources/css/duyang-design-system.css   ← all tokens, @theme, component classes
resources/css/app.css                    ← add @import './duyang-design-system.css'; here
```

Full token list: open `resources/css/duyang-design-system.css` to see every
`--duyang-*` custom property and `@theme` registration.
