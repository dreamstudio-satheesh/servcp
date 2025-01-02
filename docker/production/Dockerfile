# Stage 1: Build Stage
FROM php:8.3-fpm-alpine as build

WORKDIR /var/www/html

# Install necessary dependencies
RUN apk add --no-cache \
    libzip-dev \
    sqlite-dev \
    zip \
    curl \
    && docker-php-ext-install \
    pdo \
    pdo_sqlite \
    zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

# Copy application files
COPY . /var/www/html

# Set up necessary directories before running Composer
RUN mkdir -p storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache \
    && chmod -R 775 storage \
    && chmod -R 755 bootstrap/cache

# Install Composer dependencies
RUN composer install --no-dev --optimize-autoloader && \
    composer clear-cache

# Stage 2: Production Stage
FROM php:8.3-fpm-alpine

WORKDIR /var/www/html

# Copy files from the build stage
COPY --from=build /var/www/html /var/www/html

# Set up necessary directories and permissions
RUN mkdir -p storage/logs \
    storage/framework/sessions \
    storage/framework/views \
    storage/framework/cache \
    bootstrap/cache \
    && chmod -R 755 bootstrap/cache \
    && chmod -R 775 storage \
    && chown -R www-data:www-data /var/www/html

# Switch to non-root user
USER www-data

# Start PHP-FPM
CMD ["php-fpm"]
