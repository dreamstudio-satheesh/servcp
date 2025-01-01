# Stage 1: Build Stage
FROM php:8.3-fpm-alpine AS builder

# Install dependencies for building PHP extensions
RUN apk add --no-cache \
    autoconf \
    bash \
    gcc \
    g++ \
    make \
    linux-headers \
    libjpeg-turbo-dev \
    libpng-dev \
    libxml2-dev \
    libzip-dev \
    sqlite-dev \
    bison \
    re2c \
    zlib-dev && \
    docker-php-ext-install \
    pdo \
    pdo_sqlite \
    mbstring \
    xml \
    bcmath \
    zip && \
    pecl install redis && \
    docker-php-ext-enable redis

# Stage 2: Final Image
FROM php:8.3-fpm-alpine

# Set working directory
WORKDIR /var/www/html

# Install runtime dependencies only
RUN apk add --no-cache \
    nano \
    sqlite \
    libjpeg-turbo \
    libpng \
    libxml2 \
    libzip \
    zlib && \
    rm -rf /var/cache/apk/*

# Copy compiled PHP extensions from the build stage
COPY --from=builder /usr/local/lib/php/extensions/ /usr/local/lib/php/extensions/
COPY --from=builder /usr/local/etc/php/conf.d /usr/local/etc/php/conf.d

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set permissions for Laravel
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Copy application files
COPY . .

# Expose port
EXPOSE 9000

# Run the Laravel application
CMD ["php", "-S", "0.0.0.0:9000", "-t", "public"]
