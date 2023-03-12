FROM php:7.3-alpine3.14

USER root

RUN curl -sS https://getcomposer.org/installer -o /tmp/composer-setup.php
RUN php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer

RUN apk add --update php-pgsql php-mysqli php-pdo php-pdo_mysql php-curl php-bcmath php-json php-mbstring php-xml php-tokenizer php-zip

COPY ./ /usr/src/app

WORKDIR /usr/src/app

RUN composer update
RUN composer install

RUN php artisan migrate:refresh

EXPOSE 8000
