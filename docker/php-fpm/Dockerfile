FROM php:7.4-fpm

WORKDIR /var/www/adminBSPro

ARG user_id=1000

RUN apt-get update \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install pdo pdo_mysql \
    && usermod -u $user_id www-data