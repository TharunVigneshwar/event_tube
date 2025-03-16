# PeerTube
----
Video System for BIT
Built using Laravel 10.x and PostgreSQL
### Install application dependencies and DB migration

```sh

git clone https://github.com/tharunelevado/peertube-laravel.git
cd peertube-laravel
cp .env.example .env
composer install
php artisan migrate
php artisan db:seed
php artisan key:generate
php artisan storage:link
npm install
npm run build
php artisan serve

# Access Filament at http://localhost:8000/

```
