FROM php:7.2.3-fpm-alpine3.7

RUN apk update && docker-php-ext-install pdo pdo_mysql
RUN apk add --no-cache icu-dev
RUN docker-php-ext-install intl
