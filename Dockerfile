# ============================================================================
# Multi-stage Docker build for Laravel 12 School Management System on Render
# ============================================================================
# This Dockerfile is optimized for production with minimal image size
# and all necessary Laravel dependencies pre-configured.

# Stage 1: Build stage - Install dependencies and build assets
# ============================================================================
FROM php:8.2-cli as builder

# Set working directory
WORKDIR /app

# Install system dependencies required for building
RUN apt-get update && apt-get install -y --no-install-recommends \
    ca-certificates \
    curl \
    git \
    build-essential \
    libssl-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && rm -rf /var/lib/apt/lists/*

# Install Node.js (required for Vite build)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get install -y --no-install-recommends nodejs && \
    rm -rf /var/lib/apt/lists/*

# Install PHP extensions required for Laravel and packages
RUN docker-php-ext-install -j$(nproc) \
    bcmath \
    ctype \
    curl \
    dom \
    fileinfo \
    filter \
    hash \
    json \
    mbstring \
    openssl \
    pdo \
    pdo_sqlite \
    pdo_mysql \
    pcre \
    session \
    simplexml \
    tokenizer \
    xml \
    xmlreader \
    xmlwriter \
    zip

# Install GD extension (for image handling)
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install -j$(nproc) gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application files
COPY . .

# Install PHP dependencies with production optimization
RUN composer install \
    --no-dev \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist \
    --optimize-autoloader \
    --classmap-authoritative

# Run post-install composer scripts
RUN composer run-script post-autoload-dump

# Install Node.js dependencies
RUN npm install --production=false

# Build frontend assets with Vite
RUN npm run build

# Clear npm cache to reduce image size
RUN npm cache clean --force

# Create necessary directories with correct permissions
RUN mkdir -p storage/logs \
    storage/app/private \
    storage/app/public \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    bootstrap/cache

# ============================================================================
# Stage 2: Runtime stage - Minimal production image
# ============================================================================
FROM php:8.2-fpm

# Install runtime dependencies only
RUN apt-get update && apt-get install -y --no-install-recommends \
    ca-certificates \
    libfreetype6 \
    libjpeg62-turbo \
    libpng16-16 \
    nginx \
    supervisor \
    curl \
    git \
    && rm -rf /var/lib/apt/lists/*

# Install production PHP extensions
RUN docker-php-ext-install -j$(nproc) \
    bcmath \
    ctype \
    curl \
    dom \
    fileinfo \
    filter \
    hash \
    json \
    mbstring \
    openssl \
    pdo \
    pdo_sqlite \
    pdo_mysql \
    pcre \
    session \
    simplexml \
    tokenizer \
    xml \
    xmlreader \
    xmlwriter \
    zip

# Install GD extension
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install -j$(nproc) gd

# Set working directory
WORKDIR /app

# Copy built application from builder stage
COPY --from=builder /app /app

# Copy Nginx configuration
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/site.conf /etc/nginx/sites-enabled/default

# Copy Supervisor configuration for queue worker
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Copy PHP FPM configuration
COPY docker/php-fpm.conf /usr/local/etc/php-fpm.conf
COPY docker/php.ini /usr/local/etc/php/conf.d/laravel.ini

# Set environment variables for production
ENV APP_ENV=production
ENV LOG_CHANNEL=single
ENV LOG_LEVEL=warning

# Set correct permissions for storage and bootstrap directories
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache && \
    chmod -R 775 /app/storage /app/bootstrap/cache

# Create health check endpoint file
RUN echo '<?php http_response_code(200); echo "OK";' > /app/public/health.php

# Expose port (will be overridden by Render's PORT env variable)
EXPOSE 8000

# Create entrypoint script
RUN echo '#!/bin/bash\n\
set -e\n\
\n\
echo "Running Laravel migrations..."\n\
php artisan migrate --force\n\
\n\
echo "Creating storage symlink..."\n\
php artisan storage:link --force || true\n\
\n\
echo "Caching configuration..."\n\
php artisan config:cache\n\
php artisan route:cache\n\
php artisan view:cache\n\
\n\
echo "Starting application services..."\n\
\n\
# Start Supervisor to manage PHP-FPM and queue worker\n\
/usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf\n\
' > /app/entrypoint.sh && chmod +x /app/entrypoint.sh

# Health check
HEALTHCHECK --interval=30s --timeout=10s --start-period=5s --retries=3 \
    CMD curl -f http://localhost:${PORT:-8000}/health.php || exit 1

# Run entrypoint
CMD ["/app/entrypoint.sh"]
