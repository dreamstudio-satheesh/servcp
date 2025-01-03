# Use PHP with FPM and Alpine
FROM php:8.2-fpm-alpine

# Set working directory
WORKDIR /var/www/html

# Install necessary extensions and dependencies
RUN apk add --no-cache \
    libzip-dev sqlite-dev nginx supervisor \
    && docker-php-ext-install pdo pdo_sqlite zip \
    && apk add --no-cache bash curl

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy application files (relative to the build context)
COPY . /var/www/html

# Set up necessary directories before running Composer
RUN mkdir -p storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache \
    && chmod -R 775 storage \
    && chmod -R 755 bootstrap/cache 

# Install Laravel dependencies
RUN composer install --optimize-autoloader --no-dev

# Run database migrations and seed
RUN php artisan config:cache && \
    php artisan migrate --force --seed || true

# Copy Nginx configuration
COPY ./docker/production/nginx.conf /etc/nginx/nginx.conf

# Copy Supervisor configuration
COPY ./docker/production/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

RUN chown -R www-data:www-data /var/www/html


# Switch to non-root user
USER www-data


# Expose HTTP and HTTPS ports
EXPOSE 80 443

# Start Supervisor to manage processes
CMD ["supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
