FROM php:8.3-fpm-alpine

# Instalar extensiones PHP necesarias
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instalar otros útiles
RUN apk add --no-cache \
    git \
    curl \
    vim

WORKDIR /app

# Copiar composer.json y composer.lock si existen
COPY composer.* ./

# Instalar dependencias de PHP
RUN composer install --no-scripts --no-autoloader 2>/dev/null || true

EXPOSE 9000

CMD ["php-fpm"]