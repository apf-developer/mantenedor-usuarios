FROM php:8.3

RUN apt-get update && apt-get install -y \
    libpq-dev \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

WORKDIR /var/www/html

COPY . .

RUN chown -R www-data:www-data \
    /var/www/html/storage \
    /var/www/html/bootstrap/cache

CMD php artisan serve --host=0.0.0.0 --port=8000