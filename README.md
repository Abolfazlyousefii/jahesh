# jahesh

## Requirements
- PHP 8.3+
- Composer
- Node.js + npm
- MySQL (Laragon)

## Setup
composer install
cp .env.example .env
php artisan key:generate

## Database
php artisan migrate

## Frontend
npm install
npm run dev

## Run
php artisan serve
