FROM php:8.2-fpm

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libpq-dev \
    libonig-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

EXPOSE 9000

CMD ["php-fpm"]
