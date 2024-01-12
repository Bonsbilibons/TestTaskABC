FROM php:8.1-fpm-alpine

RUN mkdir -p /var/www/html

ADD src /var/www/html

RUN apk add --no-cache postgresql-dev libpq \
    && docker-php-ext-install pdo pdo_pgsql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
