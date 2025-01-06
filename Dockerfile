# Build stage
FROM php:8.2-fpm-alpine3.18 AS builder

# Install build dependencies
RUN apk add --no-cache --virtual .build-deps \
    git \
    curl \
    libzip-dev \
    build-base \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    zlib-dev \
    libxml2-dev \
    linux-headers \
    autoconf \
    openssl-dev

# Install and configure PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo_mysql \
        gd \
        zip \
        xml \
        opcache \
        sockets \
    && pecl install excimer mongodb \
    && docker-php-ext-enable excimer mongodb

# Install composer
COPY --from=composer:2.6.5 /usr/bin/composer /usr/bin/composer

# Copy only composer files first
COPY composer.* ./

# Install dependencies
RUN composer install --no-dev --no-interaction --optimize-autoloader --prefer-dist --no-progress --no-scripts

# Production stage
FROM php:8.2-fpm-alpine3.18 AS production

# Install production dependencies
RUN apk add --no-cache \
    nginx \
    supervisor \
    mysql-client \
    nodejs \
    npm \
    tzdata \
    bash

# Copy PHP extensions and configs from builder
COPY --from=builder /usr/local/lib/php/extensions/ /usr/local/lib/php/extensions/
COPY --from=builder /usr/local/etc/php/conf.d/ /usr/local/etc/php/conf.d/

# Set working directory
WORKDIR /var/www/html

# Copy configuration files
COPY docker/php/php.ini /usr/local/etc/php/php.ini
COPY docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY docker/supervisor/supervisord.conf /etc/supervisord.conf

# Copy application files and vendor
COPY . .
COPY --from=builder /var/www/html/vendor/ ./vendor/

# Set PHP to production mode
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

USER root

# Add non-root user and set permissions
RUN addgroup -S laravel && adduser -S laravel -G laravel \
    && chown -R laravel:laravel /var/www/html \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache \
    && find storage/logs/ -type f -name "*.log" -exec chmod 775 {} \;

# Set production environment variables
ENV APP_ENV=production \
    APP_DEBUG=false

# Expose port and set user
EXPOSE 80

# Start supervisor
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]