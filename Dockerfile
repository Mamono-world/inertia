# Base image for PHP + Composer + Node
FROM php:8.3-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    zip unzip curl git libpng-dev libjpeg-dev libfreetype6-dev libpq-dev nodejs npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/mamono

# Copy everything
COPY --chown=www-data:www-data . .

# Set proper permissions
RUN chmod -R 775 storage bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache

# Install backend dependencies
RUN composer install --no-dev --optimize-autoloader --prefer-dist

# Now that Ziggy exists, we can safely build frontend
RUN npm install && npm run build
RUN php artisan migrate

EXPOSE 9000
CMD ["php-fpm"]
