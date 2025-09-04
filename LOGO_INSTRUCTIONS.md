# PASKIBRA Logo Installation Instructions

## Logo File Location
Please place your `logopaskib.jpg` file in the following directory:
```
public/images/logopaskib.jpg
```

## What I've Updated
I've updated all the following files to use the PASKIBRA logo:

### 1. Dashboard Layout (`resources/views/layouts/dashboard.blade.php`)
- Updated sidebar header logo
- Added fallback to existing logo if logopaskib.jpg is not found

### 2. Guest Layout (`resources/views/layouts/guest.blade.php`) 
- Updated login/register page logo
- Added fallback to existing logo

### 3. Standalone Dashboard (`resources/views/dashboard.blade.php`)
- Updated sidebar logo
- Added proper styling for logo display

### 4. Welcome Page (`resources/views/welcome.blade.php`)
- Updated footer logo
- Added fallback to existing logo

### 5. Application Logo Component (`resources/views/components/application-logo.blade.php`)
- Replaced SVG with image logo
- Used in navigation and other components

## Logo Requirements
- **File name**: `logopaskib.jpg`
- **Recommended size**: 200x200 pixels or larger (square format works best)
- **Format**: JPG, PNG, or other web-compatible image format
- **Location**: `public/images/logopaskib.jpg`

## Fallback System
If `logopaskib.jpg` is not found, the system will automatically fall back to:
- `public/images/paskibra/logo.jpg` (existing logo)

## How to Add Your Logo
1. Copy your `logopaskib.jpg` file
2. Paste it into: `public/images/logopaskib.jpg`
3. Refresh your browser - the logo should appear automatically

## Where the Logo Appears
✅ **Sidebar** - Dashboard layout  
✅ **Login/Register pages** - Guest layout  
✅ **Welcome page** - Footer section  
✅ **Navigation** - Top navigation bar  
✅ **All dashboard views** - Consistent branding  

## Notes
- The logo is automatically styled with rounded corners and proper sizing
- All logos are responsive and work on mobile devices
- The system includes error handling if the logo file is missing