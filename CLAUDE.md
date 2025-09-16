# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a Laravel portfolio application called "Linettefolio" that uses the TALL stack (Tailwind CSS, Alpine.js, Laravel, Livewire) with Filament for admin functionality. The application is a personal portfolio website with pages for home, about, services, portfolio, and contact.

## Tech Stack

- **Backend**: Laravel 12 with PHP 8.2+
- **Frontend**: Livewire 3.6, Tailwind CSS, JavaScript/jQuery
- **Admin Panel**: Filament 3.2
- **Build Tool**: Vite
- **Package Manager**: Composer (PHP), npm (Node.js)
- **Additional**: PDF.js for PDF viewing, Spatie Laravel Image Optimizer, RomanZipp Laravel SEO

## Development Commands

### Quick Start
```bash
composer run dev
```
This runs a concurrent development environment with:
- Laravel development server (`php artisan serve`)
- Queue worker (`php artisan queue:listen --tries=1`)
- Log viewer (`php artisan pail --timeout=0`)
- Vite dev server (`npm run dev`)

### Individual Commands
```bash
# PHP/Laravel
php artisan serve          # Start Laravel development server
php artisan migrate        # Run database migrations
php artisan queue:work     # Process queue jobs
php artisan pail          # View application logs

# Frontend
npm run dev               # Start Vite development server
npm run build            # Build assets for production

# Testing
composer run test         # Run PHPUnit tests (clears config first)
php artisan test         # Run tests directly

# Code Quality
vendor/bin/pint          # Laravel Pint code formatter
```

## Architecture

### Frontend Architecture
- **Livewire Components**: Located in `app/Livewire/`
  - Main pages: `Home.php`, `About.php`, `Service.php`, `Portfolio.php`, `Contact.php`
  - Partials: `CategoryNavigation.php`, `Menu.php`, `MobileMenu.php`, `Preloader.php`
- **Views**: Blade templates in `resources/views/`
- **Assets**: CSS/JS in `resources/css/` and `resources/js/`

### Backend Architecture
- **Models**: Standard Eloquent models in `app/Models/`
  - Core models: `User.php`, `PortfolioItem.php`, `Service.php`, `Category.php`
- **Routes**: Single web routes file at `routes/web.php` using Livewire components
- **Admin**: Filament resources in `app/Filament/Resources/`

### Styling
- **Tailwind Config**: Custom breakpoints (bigger, large, middle, small)
- **Fonts**: Poppins, Montserrat, Mulish
- **Colors**: Custom orange theme color `#f25835`
- **Animations**: Custom `page-in` animation for smooth transitions

## Key Features
- Portfolio item management with categories
- PDF viewing capabilities (using PDF.js)
- Image optimization (Spatie package)
- SEO optimization (RomanZipp package)
- Responsive design with custom breakpoints
- Queue-based background job processing

## File Structure
```
app/
├── Filament/Resources/     # Admin panel resources
├── Http/Controllers/       # Traditional controllers (if any)
├── Livewire/              # Livewire components
├── Models/                # Eloquent models
└── Providers/             # Service providers

resources/
├── css/                   # Stylesheets
├── js/                    # JavaScript files
└── views/                 # Blade templates

routes/
└── web.php               # Web routes (Livewire-based)
```