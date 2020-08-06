FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
    curl \
    libpq-dev \
    openssl \
    libssl-dev \
    libcurl4-openssl-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    unzip \
    git

RUN docker-php-ext-install \
    pgsql \
    bcmath \
    ctype \
    json \
    mbstring \
    pdo_pgsql \
    tokenizer \
    xml \
    zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/backend

CMD ["php-fpm"]
