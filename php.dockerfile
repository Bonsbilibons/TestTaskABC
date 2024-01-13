FROM php:7.4.1-apache

RUN apt-get update && apt-get install -y libpq-dev
RUN docker-php-ext-install pgsql pdo pdo_pgsql

RUN mkdir -p /var/www/html

RUN groupadd -g 1000 test && useradd -u 1000 -g test -m test

ADD php/www.conf /usr/local/etc/php-fpm.d/www.conf

ADD src /var/www/html

ADD php/php.ini /usr/local/etc/php/conf.d/php.ini