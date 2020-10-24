FROM php:7.3-fpm

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        libpq-dev \
        libpng-dev \
        libxslt-dev \
        libxml2-dev \
        libzip-dev \
        libcurl4-gnutls-dev \
&& \
    docker-php-ext-install pdo \
        xml \
        pdo_mysql \
        mbstring \
        zip \
        gd \
        intl \
        xsl \
        opcache \
        curl \
&& \
    curl -sS https://getcomposer.org/installer | php -- \
        --filename=composer \
        --install-dir=/usr/local/bin \
&& \
        composer --version \
&& \
        mkdir -p /app /.composer \
&& \
        chown 1000:1000 /.composer

WORKDIR /app
