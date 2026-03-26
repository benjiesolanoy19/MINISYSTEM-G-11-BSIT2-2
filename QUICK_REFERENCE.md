# CLFMS Material UI Quick Reference

## Installation (First Time)
```bash
npm install
npm run dev
```

## Development Workflow
```bash
# Terminal 1: Watch CSS/JS changes
npm run dev

# Terminal 2: Start Laravel
php artisan serve
```

## Blade Component Snippets

### Material Design Buttons
```blade
<!-- Filled (Primary) -->
<button class="btn btn-filled"><i class="fas fa-check me-2"></i>Save</button>

<!-- Outlined -->
<button class="btn btn-outlined"><i class="fas fa-edit me-2"></i>Edit</button>

<!-- Text (Light) -->
<button class="btn btn-text">Cancel</button>

<!-- Elevated (Material 3) -->
<button class="btn btn-elevated">Learn More</button>
```

### Cards
```blade
<div class="md-card">
    <div class="md-card-header">Card Title</div>
    <div class="md-card-body">Card content goes here</div>
    <div class="md-card-footer">
        <button class="btn btn-text">Cancel</button>
        <button class="btn btn-filled">Save</button>
    </div>
</div>
```

### Stat Widget
```blade
<div class="md-card" data-scroll>
    <div style="padding: 25px;">
        <p style="margin: 0 0 10px 0; font-size: 0.85rem; font-weight: 600; color: var(--text-muted);">
            <i class="fas fa-icon me-1"></i>Label
        </p>
        <div style="font-size: 2.5rem; font-weight: 800; color: var(--mdc-primary); margin: 15px 0;">
            <span class="counter">{{ $value }}</span>
        </div>
    </div>
</div>
```

### Badges & Chips
```blade
<!-- Badge Primary -->
<span class="md-badge md-badge-primary">Active</span>

<!-- Badge Success -->
<span class="md-badge md-badge-success">Completed</span>

<!-- Chip with Close -->
<span class="md-chip md-chip-closeable">
    Tag <span class="md-chip-close">×</span>
</span>
```

### Alerts
```blade
<div class="md-alert md-alert-success">
    <i class="fas fa-check-circle me-2"></i>Success message
</div>

<div class="md-alert md-alert-error">
    <i class="fas fa-times-circle me-2"></i>Error message
</div>
```

### Form Fields
```blade
<div class="md-text-field">
    <label for="email">Email Address</label>
    <input type="email" id="email" class="form-control" placeholder="Enter email">
</div>
```

## Alpine.js Patterns

### Simple Toggle
```blade
<div x-data="{ open: false }">
    <button @click="open = !open">Toggle</button>
    <div x-show="open">Content</div>
</div>
```

### Counter with Binding
```blade
<div x-data="{ count: 0 }">
    <button @click="count++">Increment</button>
    <span x-text="count"></span>
</div>
```

### Loop
```blade
<div x-data="{ items: ['A', 'B', 'C'] }">
    <template x-for="item in items" :key="item">
        <li x-text="item"></li>
    </template>
</div>
```

### Custom Component
```blade
<div x-data="myComponent()">
    <h2 x-text="title"></h2>
    <button @click="doAction()">Action</button>
</div>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('myComponent', () => ({
        title: 'Hello',
        doAction() {
            console.log('Action performed');
        }
    }));
});
</script>
```

## GSAP Animation Examples

### Scroll Animation (Auto)
```blade
<div data-scroll>Animates when scrolled into view</div>
```

### Manual Animation
```javascript
gsap.to(".element", {
    opacity: 1,
    y: 0,
    duration: 0.8,
    ease: "power2.out"
});
```

### Counter Animation
```javascript
gsap.to(element, {
    innerText: 100,
    duration: 2,
    snap: { innerText: 1 }
});
```

### Stagger
```javascript
gsap.to(".card", {
    opacity: 1,
    stagger: 0.2,
    duration: 0.5
});
```

## CSS Variables

```css
:root {
    --mdc-primary: #0ea5e9;
    --mdc-secondary: #10b981;
    --mdc-error: #ef4444;
    --text-dark: #1e293b;
    --text-muted: #64748b;
    --light-bg: #f8fafc;
}
```

## Utility Classes

```blade
<!-- Colors -->
<p class="text-primary">Primary text</p>
<span class="gradient-text">Gradient text</span>

<!-- Backgrounds -->
<div class="bg-primary">Blue background</div>
<div class="bg-light">Light background</div>

<!-- Special Classes -->
<div class="md-elevation-2">Subtle shadow</div>
<div class="md-elevation-4">Strong shadow</div>
```

## Animations

Add `data-scroll` to any element for automatic scroll animation:
```blade
<div data-scroll>
    <h2>This animates in</h2>
    <p>When scrolled into view</p>
</div>
```

## Responsive Classes

All components work responsively. Mobile-first approach:
- Mobile: < 768px (100% width)
- Tablet: 768px+ (flex layouts)
- Desktop: 1024px+ (multi-column)

## Common Issues & Solutions

| Issue | Solution |
|-------|----------|
| Styles not loading | Run `npm run dev` or `npm run build` |
| Alpine not working | Ensure `x-cloak` is used, check console |
| Animations not smooth | Check browser GPU acceleration is enabled |
| Components look broken | Clear cache, hard refresh (Ctrl+Shift+R) |

## File Structure
```
resources/
├── css/
│   ├── app.css (imports material-design.css)
│   └── material-design.css (component library)
├── js/
│   ├── app.js (GSAP + Alpine init)
│   └── bootstrap.js (Axios + library config)
└── views/
    ├── dashboard/
    │   ├── home.blade.php (modern dashboard)
    │   └── index-enhanced.blade.php
    └── layouts/
        ├── dashboard-modern.blade.php
        ├── app.blade.php
        └── dashboard-enhanced.blade.php
```

## Useful Links
- [Material Design Specs](https://m3.material.io)
- [GSAP Docs](https://greensock.com/docs)
- [Alpine Docs](https://alpinejs.dev)

---

**Quick Tip**: Use `data-scroll` for animations, `x-data` for interactivity, and `btn btn-filled` for buttons!
