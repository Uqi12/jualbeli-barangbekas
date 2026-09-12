FROM php:8.2-fpm

# Install system dependencies & SQLite
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    sqlite3 \
    libsqlite3-dev \
    nginx

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql pdo_sqlite mbstring exif pcntl bcmath gd

# Get Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Setup permissions
RUN mkdir -p /app/storage/framework/cache /app/storage/framework/sessions /app/storage/framework/views /app/storage/logs /app/bootstrap/cache \
    && chmod -R 777 /app/storage /app/bootstrap/cache

EXPOSE 8080

CMD sh -c "mkdir -p /app/database && touch /app/database/database.sqlite && chmod 777 /app/database/database.sqlite && php artisan migrate --force && php artisan config:clear && php artisan cache:clear && php artisan serve --host=0.0.0.0 --port=${PORT:-8080}"