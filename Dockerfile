FROM php:8.3-fpm-alpine

# Set working directory
WORKDIR /var/www/html

# Install required dependencies
RUN apk add --no-cache \
    nano \
    sqlite \
    sqlite-dev \
    libxml2-dev \
    oniguruma-dev \
    autoconf \
    bash \
    gcc \
    g++ \
    make \
    linux-headers \
    libjpeg-turbo-dev \
    libpng-dev \
    libzip-dev \
    zlib-dev \
    bison \
    re2c && \
    docker-php-ext-install \
    pdo \
    pdo_sqlite \
    mbstring \
    xml \
    bcmath \
    zip && \
    pecl install redis && \
    docker-php-ext-enable redis

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set permissions for the application
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Copy application files
COPY . .

# Expose port
EXPOSE 9000

# Run the Laravel application
CMD ["php", "-S", "0.0.0.0:9000", "-t", "public"]
