#!/bin/bash
set -e

composer install

exec "php-fpm"

