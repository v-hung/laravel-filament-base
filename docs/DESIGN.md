# DUYANG Website — Design System Reference

> **For Claude:** Read `docs/DESIGN.md` before building any component or page for this project.
> CSS file: `resources/css/duyang-design-system.css`
> It must be imported in `resources/css/app.css` with `@import './duyang-design-system.css';`

---

## 1. Colors

Six colors. Use them everywhere. No arbitrary hex values.

| Semantic name | CSS variable               | Tailwind class                                | Hex       | Usage                              |
|---------------|----------------------------|-----------------------------------------------|-----------|------------------------------------|
| Black         | `var(--duyang-black)`      | `text-duyang-black` / `bg-duyang-black`       | `#111111` | Primary text, headings, icons      |
| Grey          | `var(--duyang-grey)`       | `text-duyang-grey` / `bg-duyang-grey`         | `#565656` | Secondary text, metadata           |
| Grey Mid      | `var(--duyang-grey-mid)`   | `text-duyang-grey-mid` / `bg-duyang-grey-mid` | `#7A7A7A` | Placeholder text, disabled states  |
| Grey Light    | `var(--duyang-grey-light)` | `text-duyang-grey-light`                      | `#9E9E9E` | Decorative section labels, borders |
| Cream         | `var(--duyang-cream)`      | `bg-duyang-cream`                             | `#F8F6F1` | Page background                    |
| White         | `var(--duyang-white)`      | `bg-duyang-white`                             | `#FFFFFF` | Card surface, content containers   |

### Color rules
- **Page background** → always `bg-duyang-cream` (`#F8F6F1`)
- **Card / container surface** → `bg-duyang-white`
- **Primary text** → `text-duyang-black`
- **Secondary / muted text** → `text-duyang-grey`
- **No decorative colors** — the palette is intentionally monochromatic/warm-neutral

---

## 2. Typography

**Primary typeface: Manrope** (all text — headings, body, buttons).

Must be loaded via Google Fonts or `@fontsource-variable/manrope`:
```html
<!-- In your Blade layout <head> -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
```

### Heading classes (H)

| Class                 | Size  | Weight        | Line Height | Use for                          |
|-----------------------|-------|---------------|-------------|----------------------------------|
| `.text-h-80`          | 80px  | Bold 700      | 110%        | Extra-large hero displays        |
| `.text-h-56-semibold` | 56px  | SemiBold 600  | 120%        | Hero section — softer variant    |
| `.text-h-56-bold`     | 56px  | Bold 700      | 115%        | Hero section — strong variant    |
| `.text-h-40`          | 40px  | Bold 700      | 120%        | Page titles, major section heads |
| `.text-h-32-bold`     | 32px  | Bold 700      | 120%        | Section headings — strong        |
| `.text-h-32-semibold` | 32px  | SemiBold 600  | 120%        | Section headings — regular       |
| `.text-h-24-bold`     | 24px  | Bold 700      | 120%        | Card titles, sub-headings        |
| `.text-h-24-medium`   | 24px  | Medium 500    | 120%        | Card titles — lighter variant    |
| `.text-h-22`          | 22px  | Bold 700      | 120%        | Small section headings           |
| `.text-h-20`          | 20px  | SemiBold 600  | 120%        | Labels, small headings           |

### Paragraph classes (P)

| Class                  | Size  | Weight       | Line Height | Use for                             |
|------------------------|-------|--------------|-------------|-------------------------------------|
| `.text-p-18-semibold`  | 18px  | SemiBold 600 | 145%        | Prominent body copy, lead text      |
| `.text-p-18-medium`    | 18px  | Medium 500   | 145%        | Body copy — medium emphasis         |
| `.text-p-18-regular`   | 18px  | Regular 400  | 145%        | Body copy — light                   |
| `.text-p-16-bold`      | 16px  | Bold 700     | 160%        | UI text — strong emphasis           |
| `.text-p-16-semibold`  | 16px  | SemiBold 600 | 160%        | Standard UI text, nav items         |
| `.text-p-16-regular`   | 16px  | Regular 400  | 160%        | Standard body text                  |
| `.text-p-14-semibold`  | 14px  | SemiBold 600 | 145%        | Small UI text, tags                 |
| `.text-p-14-medium`    | 14px  | Medium 500   | 145%        | Captions, labels                    |
| `.text-p-14-regular`   | 14px  | Regular 400  | 145%        | Metadata, secondary info, specs     |

### Button classes (Btn)

| Class          | Size  | Weight    | Line Height | Use for            |
|----------------|-------|-----------|-------------|--------------------|
| `.text-btn-16` | 16px  | Medium 500 | 100%       | Standard buttons   |
| `.text-btn-18` | 18px  | Medium 500 | 100%       | Large/CTA buttons  |

### Typography examples

```html
<!-- Hero headline -->
<h1 class="text-h-56-bold text-duyang-black">Crafted for your space</h1>

<!-- Section title -->
<h2 class="text-h-32-bold text-duyang-black">Our collections</h2>

<!-- Card title -->
<h3 class="text-h-24-bold text-duyang-black">Title</h3>

<!-- Body paragraph -->
<p class="text-p-16-semibold text-duyang-grey">We source sustainable materials.</p>

<!-- Muted metadata -->
<span class="text-p-14-regular text-duyang-grey-mid">12 products · Updated Jan 2025</span>

<!-- Button label -->
<span class="text-btn-16">Shop now</span>
```

---

## 3. Spacing & Layout

Spacing values used in the Figma design. Stick to these when building layouts.

| Purpose               | Value    | Tailwind equivalent |
|-----------------------|----------|---------------------|
| Page outer padding    | 52px     | `px-13` or `p-13`  |
| Section body padding  | 64px     | `p-16`              |
| Card internal padding | 48px     | `p-12`              |
| Gap between cards     | 60–64px  | `gap-16`            |
| Gap between sections  | 48px     | `gap-12`            |
| Gap between items     | 32px     | `gap-8`             |
| Gap between text lines| 8px      | `gap-2`             |

---

## 4. Surfaces

Pre-composed class for the page background:

```html
<!-- Page wrapper (cream background) -->
<div class="surface-page min-h-screen">...</div>

<!-- White card (use bg-duyang-white directly) -->
<div class="bg-duyang-white p-12">...</div>
```

| Class           | Description                               |
|-----------------|-------------------------------------------|
| `.surface-page` | `background-color: var(--duyang-cream)`   |

---

## 5. Component Patterns

### Card

```html
<div class="bg-duyang-white p-12">
    <h3 class="text-h-24-bold text-duyang-black mb-4">Title</h3>
    <p class="text-p-16-semibold text-duyang-grey">Description text goes here.</p>
</div>
```

### Page layout

```html
<div class="surface-page px-13 pt-13 pb-17.5 min-h-screen">
    <!-- Body -->
    <main class="p-16 flex flex-wrap gap-16">
        <div class="bg-duyang-white p-12">...</div>
    </main>
</div>
```

### Typography hierarchy in a section

```html
<section>
    <h1 class="text-h-56-bold text-duyang-black mb-6">Headline</h1>
    <p class="text-p-18-semibold text-duyang-grey mb-3">Lead paragraph, semi-bold.</p>
    <p class="text-p-16-semibold text-duyang-grey">Standard body copy.</p>
    <span class="text-p-14-regular text-duyang-grey-mid">Metadata or secondary info.</span>
</section>
```

### Button

```html
<button class="text-btn-16 text-duyang-black">Shop now</button>
<button class="text-btn-18 text-duyang-white bg-duyang-black">Get started</button>
```

---

## 6. Do's and Don'ts

| Do                                                            | Don't                                              |
|---------------------------------------------------------------|----------------------------------------------------|
| Use `bg-duyang-cream` for page backgrounds                    | Use `bg-white` or `bg-gray-50` as page background  |
| Use `.text-h-*` classes for headings                          | Use arbitrary `text-[56px]` font sizes             |
| Use `.text-p-*` classes for body text                         | Mix in system fonts or other typefaces             |
| Use `.text-btn-*` for button labels                           | Use `text-sm`, `text-base` for buttons             |
| Keep the palette to 6 colors only                             | Add accent/brand colors not in the palette         |
| Use `text-duyang-grey` for secondary text                     | Use Tailwind's default gray scale                  |
| Use `font-sans` (resolves to Manrope via `@theme`)            | Use `font-mono` or other font families             |

---

## 7. File Reference

```
docs/DESIGN.md                           ← this file (design system reference for Claude)
resources/css/duyang-design-system.css   ← all tokens, @theme, component classes
resources/css/app.css                    ← add @import './duyang-design-system.css'; here
```

Full token list: open `resources/css/duyang-design-system.css` to see every
`--duyang-*` custom property and `@theme` registration.
