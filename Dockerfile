FROM php:8.2-apache

# Install required packages
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev \
    libxml2-dev \
    tesseract-ocr \
    && docker-php-ext-install zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy project
COPY . /var/www/html/

WORKDIR /var/www/html

# Install PHP packages
RUN composer install --no-dev --optimize-autoloader

# Create uploads folder
RUN mkdir -p /var/www/html/uploads \
    && chmod -R 777 /var/www/html/uploads

EXPOSE 80
