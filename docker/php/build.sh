#!/usr/bin/env bash

COMPOSER_PHAR=composer.phar
if [ ! -f $COMPOSER_PHAR ]; then
   php -r "readfile('https://getcomposer.org/installer');" | php
fi

composer install
