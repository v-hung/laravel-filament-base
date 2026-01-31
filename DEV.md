### docker

docker compose exec app bash
docker compose exec app composer install

docker compose exec -u root app bash

### Setup

git clone ...

composer install

copy .env.example -> .env (edit)

php artisan key:generate
php artisan storage:link

npm install & npm run build

php artisan filament:assets

<!-- php artisan shield:super-admin -->

php artisan migrate --seed

php artisan shield:generate --all

https://jthemes.net/themes/html/organic/index.html
https://jenka.info/

composer dump-autoload

### develop (clear cache):

    - php artisan icons:clear
    - php artisan filament:optimize-clear
    - php artisan optimize:clear

### production (optimize)

    - php artisan icons:cache
    - php artisan filament:optimize
    - php artisan optimize

### Permission

sudo chown -R hungnv:hungnv storage bootstrap/cache
