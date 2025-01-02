# Use PHP with FPM and Ubuntu 22.04 Slim for the base image
FROM php:8.3-fpm-bullseye AS base

# Set working directory
WORKDIR /var/www/html

# Install dependencies and PHP extensions
RUN apt-get update && apt-get install -y --no-install-recommends \
    libzip-dev \
    libsqlite3-dev \
    unzip \
    && docker-php-ext-install \
    pdo \
    pdo_sqlite \
    zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Copy Composer from the official Composer image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Ensure the www-data user exists and belongs to the predefined www-data group
RUN id -u www-data || useradd -u 82 -d /var/www/html -s /bin/bash -M www-data

# Copy application files
COPY . /var/www/html

# Ensure required directories exist and have correct permissions
RUN mkdir -p storage/logs \
    storage/framework/sessions \
    storage/framework/views \
    storage/framework/cache \
    bootstrap/cache && \
    chmod -R 755 bootstrap/cache && \
    chmod -R 775 storage && \
    chown -R www-data:www-data /var/www/html

# Switch to non-root user
USER www-data



# Install Composer dependencies for production
RUN composer install --no-dev --optimize-autoloader

# Clear and cache configurations
RUN php artisan config:clear && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache

# Expose port for PHP-FPM
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
