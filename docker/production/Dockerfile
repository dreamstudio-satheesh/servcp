# Use PHP with FPM and Alpine for a lightweight base
FROM php:8.3-fpm-alpine

# Set working directory
WORKDIR /var/www/html

# Install dependencies and PHP extensions
RUN apk add --no-cache libzip-dev sqlite-dev \
    && docker-php-ext-install pdo pdo_sqlite zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy application files
COPY . /var/www/html

# Install Composer dependencies for production
RUN composer install --optimize-autoloader --no-dev

# Set permissions for Laravel
RUN chmod -R 755 storage bootstrap/cache \
    && chown -R www-data:www-data /var/www/html

# Expose port for PHP-FPM
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
