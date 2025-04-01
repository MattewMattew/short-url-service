# Используем официальный образ PHP 8.4 с FPM и установкой необходимых расширений
FROM php:8.2-fpm-alpine

# Установка необходимых утилит и зависимостей
RUN apk add --no-cache \
    bash \
    git \
    curl \
    unzip \
    libzip-dev \
    autoconf \
    gcc \
    g++ \
    make \
    imagemagick-dev \
    libtool \
    pkgconf \
    imagemagick \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev

# Установка расширений PHP
RUN docker-php-ext-install pdo_mysql mysqli zip
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Установка Imagick
RUN pecl install imagick-3.8.0RC2 \
    && docker-php-ext-enable imagick

# Копирование приложения
COPY . /var/www/html

# Установка зависимостей проекта
WORKDIR /var/www/html
RUN composer install --no-dev --optimize-autoloader

CMD ["php-fpm"]