FROM php:8.2-fpm

COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/

RUN apt-get update && apt-get install -y --no-install-recommends unzip

RUN install-php-extensions zip pdo_pgsql xdebug

RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini

COPY ./docker/common/php/conf.d /usr/local/etc/php/conf.d
COPY ./docker/dev/php/conf.d /usr/local/etc/php/conf.d

COPY ./docker/dev/php/entrypoint.sh /usr/local/bin/docker-php-entrypoint
RUN chmod +x /usr/local/bin/docker-php-entrypoint

CMD ["php-fpm"]