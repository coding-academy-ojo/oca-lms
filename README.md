# OCA-LMS (Orange Coding Academy Learning Management System)

A Laravel-based Learning Management System for Orange Coding Academy.

## Requirements

- PHP 8.2+
- Composer
- Node.js & npm
- MySQL/SQLite (for local development)

## Installation

```bash
# Install dependencies
composer install
npm install

# Copy environment file
cp .env.example .env

# Generate key
php artisan key:generate

# Run migrations
php artisan migrate

# Seed database (optional)
php artisan db:seed

# Start development server
php artisan serve
```

## Features

- PDF generation (via barryvdh/laravel-dompdf)
- Excel import/export (via maatwebsite/excel)
- RESTful API ready
- Authentication & Authorization

## Tech Stack

- **Backend**: Laravel 12
- **PHP**: 8.2+
- **Database**: MySQL/SQLite
- **Frontend**: Blade Templates + Vue.js (optional)

## Commands

```bash
# Clear cache
php artisan cache:clear

# Run tests
php artisan test

# Create new controller
php artisan make:controller ControllerName
```

## License

MIT