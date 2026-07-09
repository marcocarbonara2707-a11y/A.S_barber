FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
    curl \
    unzip \
    zip \
    git \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    nodejs \
    npm \
    && docker-php-ext-install pdo pdo_mysql mbstring zip xml ctype bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

RUN composer install --no-dev --no-scripts --no-interaction --optimize-autoloader

RUN npm install && npm run build

RUN mkdir -p storage/framework/{sessions,views,cache,testing} storage/logs bootstrap/cache \
    && chmod -R a+rw storage bootstrap/cache

CMD php artisan serve --host=0.0.0.0 --port=$PORT