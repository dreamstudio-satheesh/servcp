# Use PHP with FPM and Alpine
FROM php:8.2-fpm-alpine

# Set working directory
WORKDIR /var/www/html

# Install necessary extensions and dependencies
RUN apk add --no-cache libzip-dev sqlite-dev \
    && docker-php-ext-install pdo pdo_sqlite zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy application files (relative to the build context)
COPY . /var/www/html

# Set permissions for Laravel
RUN chmod -R 777 storage bootstrap/cache

# Expose port
EXPOSE 8000

# Start Laravel's built-in server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
