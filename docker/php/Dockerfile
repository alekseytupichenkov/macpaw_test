FROM php:7.3-fpm

RUN apt update
RUN apt install -y \
        git \
        mc \
        vim \
        libzip-dev \
        libicu-dev \
        memcached \
        netcat \
        libmemcached-dev

# PHP-ext
RUN docker-php-ext-install zip \
    pdo_mysql \
    bcmath \
    sockets \
    intl \
    pcntl

COPY docker/php/php.ini /usr/local/etc/php/
COPY docker/php/macpawtest.pool.conf /usr/local/etc/php-fpm.d/

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN groupadd -r code && useradd -r -g root -s /bin/bash -m code

COPY docker/php/entrypoint.sh /
RUN chmod +x /entrypoint.sh
ENTRYPOINT ["/entrypoint.sh"]

WORKDIR /var/www/macpawtest

CMD ["php-fpm"]
