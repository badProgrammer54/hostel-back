FROM php:7.3-fpm

RUN apt-get update \
    && apt-get install -y --no-install-recommends libpq-dev libpng-dev libxslt-dev libzip-dev
RUN apt-get install -y \
       libxml2-dev \
       curl

RUN apt-get install -y libcurl4-gnutls-dev

RUN docker-php-ext-install pdo

RUN docker-php-ext-install xml

RUN docker-php-ext-install pdo_mysql

RUN docker-php-ext-install mbstring

RUN docker-php-ext-install zip

RUN docker-php-ext-install gd

RUN docker-php-ext-install intl

RUN docker-php-ext-install xsl

RUN docker-php-ext-install curl

RUN docker-php-ext-install opcache
