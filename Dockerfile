FROM php:8.4-cli-alpine

RUN apk add --no-cache git curl zip unzip postgresql-dev oniguruma-dev libxml2-dev

RUN docker-php-ext-install pdo pdo_pgsql mbstring xml bcmath

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

RUN composer install --no-dev --optimize-autoloader
RUN chmod -R 777 storage bootstrap/cache

EXPOSE 8080

CMD php artisan migrate --force && php artisan db:seed --class=ProductSeeder --force && php artisan db:seed --class=AdminSeeder --force && php artisan serve --host=0.0.0.0 --port=8080
