# SPA testing

Laravel, Vue.js SPA testing

## Installation

Install dependencies:

```bash
composer update
npm update
```

Run migrations:

```bash
php artisan migrate
```

Populate database with **test** data:

```bash
php artisan db:seed
```

Optimizations for production environment:

```bash
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
```
