# CLFMS - Material UI, GSAP & Alpine.js Implementation Guide

## Overview
This guide explains how to use the enhanced Material Design UI system, GSAP animations, and Alpine.js interactivity in the CLFMS project.

## Quick Start

### 1. Install Dependencies
```bash
npm install
```

This will install:
- **@mui/material** - Material Design components
- **@emotion/react** & **@emotion/styled** - CSS-in-JS for Material UI
- **alpine** - Lightweight JavaScript framework for reactive UI
- **gsap** - Professional animation library
- **axios** - HTTP client

### 2. Build Assets
```bash
npm run dev    # Development with hot reload
npm run build  # Production build
```

## Architecture Overview

### File Structure
```
resources/
├── css/
│   ├── app.css                 # Main stylesheet (imports Material Design)
│   └── material-design.css     # Complete Material Design system
├── js/
│   ├── app.js                  # Main entry point with GSAP + Alpine setup
│   └── bootstrap.js            # Axios + Library initialization
└── views/
    ├── layouts/
    │   ├── app.blade.php              # Main layout (landing pages)
    │   ├── dashboard-enhanced.blade.php # Enhanced dashboard with Material UI
    │   └── dashboard.blade.php        # Original dashboard
    ├── welcome-enhanced.blade.php     # Enhanced landing page
    └── dashboard/
        └── index-enhanced.blade.php   # Full dashboard example
```

## Material Design System

### Color Variables
Access via CSS custom properties:
```css
--mdc-primary: #0ea5e9
--mdc-primary-dark: #0284c7
--mdc-secondary: #10b981
--mdc-error: #ef4444
--mdc-warning: #f59e0b
--mdc-info: #3b82f6
--mdc-success: #10b981
```

### Typography Scale
```css
--md-font-size-xs: 0.75rem
--md-font-size-sm: 0.875rem
--md-font-size-base: 1rem
--md-font-size-lg: 1.125rem
--md-font-size-xl: 1.25rem
--md-font-size-2xl: 1.5rem
--md-font-size-3xl: 1.875rem
--md-font-size-4xl: 2.25rem
```

### Spacing Scale
```css
--md-spacing-xs: 0.25rem
--md-spacing-sm: 0.5rem
--md-spacing-md: 1rem
--md-spacing-lg: 1.5rem
--md-spacing-xl: 2rem
--md-spacing-2xl: 2.5rem
--md-spacing-3xl: 3rem
--md-spacing-4xl: 4rem
```

### Shadow/Elevation
```css
--md-elevation-0: none
--md-elevation-1: 0 1px 3px 0 rgb(0 0 0 / 0.1)
--md-elevation-2: 0 4px 6px -1px rgb(0 0 0 / 0.1)
--md-elevation-3: 0 10px 15px -3px rgb(0 0 0 / 0.1)
--md-elevation-4: 0 20px 25px -5px rgb(0 0 0 / 0.1)
--md-elevation-5: 0 25px 50px -12px rgb(0 0 0 / 0.25)
```

## Component Library

### 1. Buttons

#### Filled Button (Default)
```blade
<button class="btn btn-filled">
    <i class="fas fa-plus me-2"></i>Add Item
</button>
```

#### Outlined Button
```blade
<button class="btn btn-outlined">
    <i class="fas fa-edit me-2"></i>Edit
</button>
```

#### Text Button
```blade
<button class="btn btn-text">
    Learn More
</button>
```

#### Elevated Button (Material Design 3)
```blade
<button class="btn btn-elevated">
    <i class="fas fa-check me-2"></i>Confirm
</button>
```

### 2. Cards

Basic Card:
```blade
<div class="md-card">
    <div class="md-card-header">
        Card Title
    </div>
    <div class="md-card-body">
        Content goes here
    </div>
</div>
```

With Footer:
```blade
<div class="md-card">
    <div class="md-card-header">Equipment Details</div>
    <div class="md-card-body">
        <p>Equipment information</p>
    </div>
    <div class="md-card-footer">
        <button class="btn btn-text">Cancel</button>
        <button class="btn btn-filled">Save</button>
    </div>
</div>
```

### 3. Chips

```blade
<span class="md-chip">
    Active Status
    <span class="md-chip-close">×</span>
</span>
```

### 4. Badges

```blade
<span class="md-badge md-badge-primary">Admin</span>
<span class="md-badge md-badge-success">Active</span>
<span class="md-badge md-badge-error">Error</span>
<span class="md-badge md-badge-warning">Warning</span>
```

### 5. Text Fields

```blade
<div class="md-text-field">
    <label for="email">Email Address</label>
    <input type="email" id="email" class="text-input" placeholder="Enter email">
</div>
```

### 6. Alerts

```blade
<div class="md-alert md-alert-primary">
    <i class="fas fa-info-circle me-2"></i>
    <div>Information message</div>
</div>

<div class="md-alert md-alert-success">
    <i class="fas fa-check-circle me-2"></i>
    <div>Success message</div>
</div>

<div class="md-alert md-alert-error">
    <i class="fas fa-times-circle me-2"></i>
    <div>Error message</div>
</div>
```

### 7. Progress Bar

```blade
<div class="md-progress">
    <div class="md-progress-bar" style="width: 65%"></div>
</div>
```

### 8. Utility Classes

```blade
<!-- Text Colors -->
<p class="text-primary">Primary text</p>
<p class="text-secondary">Secondary text</p>
<p class="text-error">Error text</p>
<p class="text-warning">Warning text</p>
<p class="text-success">Success text</p>
<p class="text-muted">Muted text</p>

<!-- Gradient -->
<h2 class="gradient-text">Gradient Title</h2>
<div class="gradient-primary" style="padding: 20px;">Gradient Background</div>

<!-- Background Colors -->
<div class="bg-primary" style="padding: 20px; color: white;">Primary Background</div>
<div class="bg-secondary" style="padding: 20px; color: white;">Secondary Background</div>
<div class="bg-light" style="padding: 20px;">Light Background</div>
```

## GSAP Animations

### 1. Basic Element Animation
```javascript
// Animate opacity and position
gsap.to(".element", {
    opacity: 1,
    y: 0,
    duration: 0.8,
    ease: "power2.out"
});
```

### 2. Scroll Trigger Animations
Elements with `data-scroll` attribute are automatically animated:

```blade
<div data-scroll>
    This element will animate when scrolled into view
</div>
```

Stagger animation for multiple elements:
```blade
<div class="feature-grid">
    <div data-scroll>Feature 1</div>
    <div data-scroll>Feature 2</div>
    <div data-scroll>Feature 3</div>
</div>
```

### 3. Counter Animation
```javascript
gsap.to(element, {
    innerText: 100,
    duration: 2.5,
    ease: 'power2.out',
    snap: { innerText: 1 }
});
```

### 4. Timeline Animations
```javascript
const tl = gsap.timeline();

tl.to(".element1", { opacity: 1, duration: 0.5 })
  .to(".element2", { opacity: 1, duration: 0.5 }, "-=0.25");
```

### 5. Smooth Scroll
```javascript
gsap.to(window, {
    scrollTo: { y: "#section-id", autoKill: true },
    duration: 1,
    ease: 'power3.inOut'
});
```

## Alpine.js Integration

### 1. Basic Component
```blade
<div x-data="{ open: false }">
    <button @click="open = !open">Toggle</button>
    <div x-show="open" x-transition>
        Hidden content
    </div>
</div>
```

### 2. Data Binding
```blade
<div x-data="{ message: 'Hello' }">
    <input x-model="message">
    <p x-text="message"></p>
</div>
```

### 3. Conditional Rendering
```blade
<div x-data="{ count: 0 }">
    <button @click="count++">Increment</button>
    
    <p x-show="count > 0">Count is <span x-text="count"></span></p>
    
    <template x-if="count > 5">
        <div class="md-badge md-badge-success">High!</div>
    </template>
</div>
```

### 4. List Rendering
```blade
<div x-data="{ items: ['Apple', 'Banana', 'Orange'] }">
    <ul>
        <template x-for="item in items" :key="item">
            <li x-text="item"></li>
        </template>
    </ul>
</div>
```

### 5. Event Handling
```blade
<div x-data="{ 
    name: '',
    submitted: false,
    handleSubmit() {
        this.submitted = true;
        console.log('Submitted:', this.name);
    }
}">
    <input x-model="name" type="text" placeholder="Enter name">
    <button @click="handleSubmit()">Submit</button>
    
    <p x-show="submitted">
        Submitted: <span x-text="name"></span>
    </p>
</div>
```

### 6. Custom Functions
```blade
<div x-data="customComponent()">
    <button @click="doSomething()">Click me</button>
</div>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('customComponent', () => ({
        count: 0,
        doSomething() {
            this.count++;
            console.log('Count:', this.count);
        }
    }));
});
</script>
```

### 7. Transitions
```blade
<div x-data="{ open: false }">
    <button @click="open = !open">Toggle</button>
    
    <!-- Fade transition -->
    <div x-show="open" x-transition.duration.300ms>
        Content
    </div>
    
    <!-- Custom animation with scale -->
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="transform opacity-0 scale-90"
         x-transition:enter-end="transform opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="transform opacity-100 scale-100"
         x-transition:leave-end="transform opacity-0 scale-90">
        Animated Content
    </div>
</div>
```

## Combining GSAP + Alpine.js + Material UI

### Complete Example: Interactive Dashboard Widget
```blade
<div class="md-card" x-data="dashboardWidget()" @load="init()">
    <div class="md-card-header">
        Equipment Status
    </div>
    <div class="md-card-body">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h3 style="margin: 0;">Active Units</h3>
            <span class="md-chip">Updated Now</span>
        </div>
        
        <div style="font-size: 2.5rem; font-weight: 800; color: var(--mdc-primary); margin: 20px 0;">
            <span class="counter" x-text="count">0</span>
        </div>
        
        <div class="md-progress">
            <div class="md-progress-bar" :style="`width: ${percentage}%`"></div>
        </div>
        
        <p style="margin: 0; color: var(--text-muted); font-size: 0.9rem;">
            <i class="fas fa-arrow-up me-1" style="color: var(--mdc-success);"></i>
            <span x-text="trend"></span> from last week
        </p>
    </div>
    <div class="md-card-footer">
        <button class="btn btn-text" @click="previousValue()">Previous</button>
        <button class="btn btn-filled" @click="loadMore()">Load More</button>
    </div>
</div>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('dashboardWidget', () => ({
        count: 0,
        percentage: 65,
        trend: '12%',
        
        init() {
            // Animate counter on load
            const counter = this.$el.querySelector('.counter');
            gsap.to(counter, {
                innerText: 87,
                duration: 2,
                ease: 'power2.out',
                snap: { innerText: 1 },
                onUpdate: () => {
                    this.count = parseInt(counter.innerText);
                    this.percentage = (this.count / 100) * 100;
                }
            });
            
            // Add card entrance animation
            gsap.from(this.$el, {
                opacity: 0,
                y: 20,
                duration: 0.6,
                ease: 'power2.out'
            });
        },
        
        previousValue() {
            gsap.to(this.$el.querySelector('.counter'), {
                innerText: Math.max(0, this.count - 10),
                duration: 1,
                snap: { innerText: 1 }
            });
        },
        
        loadMore() {
            // Show loading state
            this.trend = 'Loading...';
            
            // Simulate loading
            setTimeout(() => {
                this.trend = '8%';
            }, 1000);
        }
    }));
});
</script>
```

## Responsive Design

All components are mobile-responsive by default. Key breakpoints:
- Mobile: < 768px
- Tablet: 768px - 1024px
- Desktop: > 1024px

## Performance Optimization

1. **Lazy Load Animations**: Use ScrollTrigger to animate only visible elements
2. **Debounce Events**: Use Alpine.js debounce for input events
3. **Code Splitting**: Import animations only when needed
4. **Use CSS Transforms**: GSAP automatically uses GPU acceleration

## Browser Support

- Chrome/Edge 90+
- Firefox 88+
- Safari 14+
- Mobile browsers (iOS 12+, Android 6+)

## Troubleshooting

### GSAP animations not working
```javascript
// Ensure GSAP is imported and registered
import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
gsap.registerPlugin(ScrollTrigger);
```

### Alpine.js not initializing
```blade
<!-- Ensure Vite scripts are loaded -->
@vite(['resources/css/app.css', 'resources/js/app.js'])
```

### Material Design styles not applied
```css
/* Check that material-design.css is imported */
@import 'material-design.css';
```

## Resources

- [Material Design 3 Guidelines](https://m3.material.io/)
- [GSAP Documentation](https://greensock.com/docs/)
- [Alpine.js Documentation](https://alpinejs.dev/)
- [Bootstrap 5 Utilities](https://getbootstrap.com/docs/5.0/)

## Migration from Old Design

To migrate existing views to use the new Material Design system:

1. Replace `layouts/app.blade.php` references with `layouts/dashboard-enhanced.blade.php`
2. Update button classes from Bootstrap to Material Design (`btn-filled`, `btn-outlined`, etc.)
3. Replace cards with `md-card` components
4. Add `data-scroll` attributes for automatic scroll animations
5. Convert interactive elements to Alpine.js for better reactivity

## Next Steps

1. ✅ Install dependencies: `npm install`
2. ✅ Build again: `npm run dev`
3. ✅ Update Blade templates to use new layouts
4. ✅ Test animations and interactions
5. ✅ Deploy to production with `npm run build`

