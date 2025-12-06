FROM php:8.3-fpm-alpine

# Instalar extensiones PHP necesarias
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instalar otras herramientas útiles
RUN apk add --no-cache \
    git \
    curl \
    vim \
    netcat-openbsd

WORKDIR /app

# Copiar composer.json y composer.lock si existen
COPY composer.* ./

# Instalar dependencias CON autoloader
RUN if [ -f composer.json ]; then \
    composer install --no-interaction --no-progress; \
else \
    composer init --no-interaction --name=mvc-php-starter/app; \
fi

EXPOSE 9000

CMD ["php-fpm"]