# PASKIBRA Wira Purusa E-Learning Design System

## Overview
This design system provides a comprehensive guide for maintaining visual consistency and user experience across the PASKIBRA Wira Purusa E-Learning platform.

## Brand Identity

### Core Values
- **Patriotism**: Reflecting Indonesian national pride
- **Discipline**: Military precision and order
- **Excellence**: Pursuit of high standards
- **Unity**: Togetherness and collaboration

### Visual Theme
- **Style**: Modern, clean, professional with patriotic elements
- **Inspiration**: Indonesian flag colors with military precision
- **Approach**: User-friendly interface with serious undertones

## Color Palette

### Primary Colors
```css
/* PASKIBRA Navy - Primary brand color */
--paskibra-navy: #1B365D;
--paskibra-navy-light: #2563EB;
--paskibra-navy-dark: #0F172A;

/* PASKIBRA Red - Indonesian flag red */
--paskibra-red: #DC2626;
--paskibra-red-light: #EF4444;
--paskibra-red-dark: #991B1B;

/* PASKIBRA Gold - Excellence and achievement */
--paskibra-gold: #F59E0B;
--paskibra-gold-light: #FCD34D;
--paskibra-gold-dark: #D97706;
```

### Semantic Colors
```css
/* Success - Green for positive actions */
--success-50: #ECFDF5;
--success-500: #10B981;
--success-700: #047857;

/* Warning - Amber for caution */
--warning-50: #FFFBEB;
--warning-500: #F59E0B;
--warning-700: #B45309;

/* Danger - Red for errors */
--danger-50: #FEF2F2;
--danger-500: #EF4444;
--danger-700: #B91C1C;

/* Info - Blue for information */
--info-50: #EFF6FF;
--info-500: #3B82F6;
--info-700: #1D4ED8;
```

### Neutral Colors
```css
/* Gray scale for text and backgrounds */
--gray-50: #F9FAFB;
--gray-100: #F3F4F6;
--gray-200: #E5E7EB;
--gray-500: #6B7280;
--gray-700: #374151;
--gray-900: #111827;
```

## Typography

### Font Families
- **Primary**: Inter (body text, UI elements)
- **Display**: Montserrat (headings, titles)
- **Fallback**: System fonts (Segoe UI, Arial, sans-serif)

### Font Weights
- **Light**: 300
- **Regular**: 400
- **Medium**: 500
- **Semibold**: 600
- **Bold**: 700
- **Extrabold**: 800

### Typography Scale
```css
/* Headings */
h1: 2.25rem (36px) - font-display, font-bold
h2: 1.875rem (30px) - font-display, font-semibold
h3: 1.5rem (24px) - font-display, font-semibold
h4: 1.25rem (20px) - font-display, font-medium
h5: 1.125rem (18px) - font-display, font-medium
h6: 1rem (16px) - font-display, font-medium

/* Body text */
body: 1rem (16px) - font-sans, font-normal
small: 0.875rem (14px) - font-sans, font-normal
xs: 0.75rem (12px) - font-sans, font-normal
```

## Spacing System

### Base Unit: 0.25rem (4px)

```css
/* Spacing scale */
1: 0.25rem (4px)
2: 0.5rem (8px)
3: 0.75rem (12px)
4: 1rem (16px)
5: 1.25rem (20px)
6: 1.5rem (24px)
8: 2rem (32px)
10: 2.5rem (40px)
12: 3rem (48px)
16: 4rem (64px)
20: 5rem (80px)
24: 6rem (96px)
```

## Component Library

### Buttons

#### Primary Button
```css
.btn-primary {
  background: linear-gradient(135deg, #1B365D 0%, #0F172A 100%);
  color: white;
  padding: 0.5rem 1rem;
  border-radius: 0.5rem;
  font-weight: 500;
  transition: all 0.2s ease;
}
```

#### Secondary Button
```css
.btn-secondary {
  background: #F3F4F6;
  color: #374151;
  border: 1px solid #D1D5DB;
}
```

#### Outline Button
```css
.btn-outline {
  background: transparent;
  color: #1B365D;
  border: 2px solid #1B365D;
}
```

### Cards

#### Basic Card
```css
.card {
  background: white;
  border-radius: 1rem;
  box-shadow: 0 2px 15px -3px rgba(0, 0, 0, 0.07);
  border: 1px solid #F3F4F6;
}
```

#### Hover Card
```css
.card-hover {
  transition: all 0.3s ease;
}
.card-hover:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 25px -5px rgba(0, 0, 0, 0.1);
}
```

### Badges

#### Success Badge
```css
.badge-success {
  background: #ECFDF5;
  color: #047857;
  padding: 0.25rem 0.75rem;
  border-radius: 9999px;
  font-size: 0.75rem;
  font-weight: 500;
}
```

### Form Elements

#### Input Field
```css
.form-input {
  width: 100%;
  padding: 0.75rem;
  border: 1px solid #D1D5DB;
  border-radius: 0.5rem;
  font-size: 1rem;
  transition: all 0.2s ease;
}
.form-input:focus {
  outline: none;
  border-color: #1B365D;
  box-shadow: 0 0 0 3px rgba(27, 54, 93, 0.1);
}
```

## Layout Guidelines

### Grid System
- **Container**: max-width: 1200px, centered
- **Columns**: 12-column grid system
- **Breakpoints**:
  - sm: 640px
  - md: 768px
  - lg: 1024px
  - xl: 1280px

### Sidebar
- **Width**: 18rem (288px) on desktop
- **Background**: Gradient from navy to dark
- **Mobile**: Full overlay with backdrop blur

### Content Area
- **Margin**: Left margin equal to sidebar width
- **Padding**: 2rem on desktop, 1rem on mobile
- **Background**: Light gray (#F9FAFB)

## Animation Guidelines

### Transitions
- **Duration**: 0.2s for micro-interactions, 0.3s for larger movements
- **Easing**: cubic-bezier(0.4, 0, 0.2, 1) for smooth feel
- **Properties**: transform, opacity, colors, shadows

### Hover Effects
```css
.hover-lift:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.hover-scale:hover {
  transform: scale(1.05);
}
```

### Loading States
```css
.loading-spinner {
  border: 2px solid #f3f3f3;
  border-top: 2px solid #1B365D;
  border-radius: 50%;
  animation: spin 1s linear infinite;
}
```

## Iconography

### Icon Library
- **Primary**: Heroicons (outline and solid)
- **Size**: 16px, 20px, 24px, 32px
- **Style**: Consistent stroke width (2px)
- **Color**: Inherit from parent or semantic colors

### Usage Guidelines
- Use outline icons for inactive states
- Use solid icons for active/selected states
- Maintain consistent sizing within components
- Ensure proper contrast ratios

## Accessibility

### Color Contrast
- **Normal text**: Minimum 4.5:1 ratio
- **Large text**: Minimum 3:1 ratio
- **UI elements**: Minimum 3:1 ratio

### Focus States
- All interactive elements must have visible focus indicators
- Focus rings should use brand colors with sufficient contrast
- Keyboard navigation must be logical and complete

### Screen Readers
- Use semantic HTML elements
- Provide alt text for images
- Use ARIA labels where necessary
- Ensure proper heading hierarchy

## Responsive Design

### Mobile First Approach
- Design for mobile screens first
- Progressive enhancement for larger screens
- Touch-friendly interface elements (minimum 44px)

### Breakpoint Strategy
```css
/* Mobile: 320px - 767px */
/* Tablet: 768px - 1023px */
/* Desktop: 1024px+ */
```

### Component Adaptations
- Stack cards vertically on mobile
- Collapse navigation to hamburger menu
- Adjust typography scale for smaller screens
- Optimize touch targets and spacing

## Performance Guidelines

### Image Optimization
- Use WebP format when possible
- Provide multiple sizes for responsive images
- Lazy load images below the fold
- Compress images without quality loss

### CSS Optimization
- Use Tailwind's purge feature
- Minimize custom CSS
- Leverage CSS custom properties
- Avoid deep nesting

### JavaScript Performance
- Minimize DOM manipulations
- Use event delegation
- Debounce scroll and resize events
- Lazy load non-critical components

## Brand Applications

### Logo Usage
- Maintain clear space around logo
- Use on appropriate backgrounds only
- Don't distort or modify colors
- Provide fallback for missing images

### Patriotic Elements
- Indonesian flag colors in gradients
- Subtle military-inspired patterns
- Professional yet approachable tone
- Balance formality with usability

## Implementation Notes

### CSS Architecture
- Use Tailwind CSS utility classes
- Custom components in @layer components
- CSS variables for theming
- Consistent naming conventions

### File Organization
```
resources/
├── css/
���   └── app.css (main stylesheet)
├── js/
│   └── app.js (main JavaScript)
└── views/
    ├── layouts/
    ├── components/
    └── pages/
```

### Development Workflow
1. Design in Figma/Sketch first
2. Build with Tailwind utilities
3. Extract reusable components
4. Test across devices and browsers
5. Optimize for performance

## Maintenance

### Regular Reviews
- Quarterly design system audits
- User feedback integration
- Performance monitoring
- Accessibility testing

### Updates and Versioning
- Document all changes
- Maintain backward compatibility
- Communicate updates to team
- Test thoroughly before deployment

---

This design system should be treated as a living document that evolves with the platform's needs while maintaining consistency and quality.