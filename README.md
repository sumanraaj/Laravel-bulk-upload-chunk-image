# Task A — Bulk CSV Import & Chunked Image Upload (Laravel)

This project implements:
- Bulk CSV import with upsert logic
- Chunked & resumable image upload
- Image variant generation (256, 512, 1024)
- Idempotent primary image attachment
- Unit tests


## Tech Stack
- PHP 8.2+
- Laravel 10+
- MySQL / SQLite
- Intervention Image
- PHPUnit


## Setup Instructions

git clone https://github.com/sumanraaj/Laravel-bulk-upload-chunk-image.git
cd Laravel-bulk-upload-chunk-image
composer install
cp .env.example .env
cp .env.example .env.testing
php artisan key:generate

## Update value inside .env.testing
APP_ENV=testing
DB_CONNECTION=sqlite
DB_DATABASE=:memory:

## Running Tests

php artisan test