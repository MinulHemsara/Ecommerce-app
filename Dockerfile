FROM php:8.2-fpm

# System deps + PHP extensions commonly needed by Laravel 9
RUN apt-get update && apt-get install -y \
    git curl unzip \
    libpng-dev libjpeg62-turbo-dev libfreetype6-dev \
    libonig-dev libzip-dev \
  && docker-php-ext-configure gd --with-freetype --with-jpeg \
  && docker-php-ext-install pdo_mysql mbstring zip exif pcntl gd \
  && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
