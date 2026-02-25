# =============================================================================
# Dockerfile untuk CodeIgniter 3 dengan PHP 7.4 Apache
# Base image ringan: php:7.4-apache
# =============================================================================

FROM php:7.4-apache

# Install dependencies sistem yang diperlukan
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && rm -rf /var/lib/apt/lists/*

# Install ekstensi PHP yang diperlukan
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    mysqli \
    pdo \
    pdo_mysql \
    gd \
    zip

# Aktifkan mod_rewrite untuk .htaccess (CodeIgniter)
RUN a2enmod rewrite

# Aktifkan mod_headers (diperlukan untuk beberapa fitur)
RUN a2enmod headers

# Set working directory
WORKDIR /var/www/html

# Ubah ownership folder www agar bisa ditulis (untuk logs dan cache)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Konfigurasi Apache
# Override DocumentRoot jika perlu
# Apache sudah dikonfigurasi untuk melayani /var/www/html secara default

# Expose port 80
EXPOSE 80
