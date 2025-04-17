# Use PHP 8.4 base image with FPM
FROM php:8.4-fpm

# Install system dependencies & PHP extensions
RUN apt-get update && apt-get install -y \
    zip unzip curl git libpq-dev libpng-dev libjpeg-dev libfreetype6-dev npm nodejs \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql gd

# Install Composer globally
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/mamono

# Copy Laravel project files and set ownership to www-data (PHP user)
COPY --chown=www-data:www-data . .

# Set file/folder permissions properly (use Laravel recommended ones)
RUN chmod -R 775 storage bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache

# Install Laravel backend dependencies
RUN composer install --no-dev --optimize-autoloader --prefer-dist

# Install frontend dependencies and build for production
RUN npm install && npm run build

# Expose PHP-FPM port
EXPOSE 9000

# Start PHP-FPM server
CMD ["php-fpm"]
