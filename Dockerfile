FROM php:8.4-fpm

# Install required extensions
RUN apt-get update && apt-get install -y \
    zip unzip curl git libpq-dev libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-install pdo pdo_mysql gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/mamono

# Copy Laravel project
COPY . .

# Create a non-root user for security
RUN useradd -m laraveluser
USER laraveluser

# Set permissions for storage and cache directories
RUN chmod -R 775 storage bootstrap/cache storage/framework/views storage/app/public
RUN chown -R www-data:www-data storage bootstrap/cache storage/framework/views

# Install Laravel dependencies with optimizations
RUN composer install --no-dev --optimize-autoloader --prefer-dist

# Install npm dependencies and build assets (use production flag)
RUN npm install --production

# Optionally, you can add custom php.ini configurations (increase limits)
# COPY ./php.ini /usr/local/etc/php/conf.d/

# Expose the port that PHP-FPM listens on
EXPOSE 9000

# Set the entrypoint for the container
CMD ["php-fpm"]
