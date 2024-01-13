FROM php:8.1-fpm-alpine

RUN mkdir -p /var/www/html

RUN addgroup -g 1000 test && adduser -G test -g test -s /bin/sh -D test

ADD php/www.conf /usr/local/etc/php-fpm.d/www.conf

ADD src /var/www/html

RUN apk add --no-cache postgresql-dev libpq

RUN docker-php-ext-install pdo pdo_pgsql \
    && docker-php-ext-enable pdo_pgsql \
    && php -m | grep -q 'pdo_pgsql'