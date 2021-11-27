FROM alpine:3.15

RUN apk add --no-cache \
    acl \
    coreutils \
    gettext \
    php8-fpm \
    php8-ctype \
    php8-curl \
    php8-dom \
    php8-gd \
    php8-iconv \
    php8-json \
    php8-intl \
    php8-fileinfo\
    php8-mbstring \
    php8-opcache \
    php8-openssl \
    php8-pdo \
    php8-pdo_pgsql \
    php8-pgsql \
    php8-xml \
    php8-xsl \
    php8-zlib \
    php8-phar \
    php8-tokenizer \
    php8-session \
    php8-simplexml \
    php8-zip \
    php8-xmlwriter \
    php8-sodium \
    php8-pecl-apcu \
    make \
    curl

RUN curl -sS https://getcomposer.org/installer | tee composer-setup.php \
    && php8 composer-setup.php && rm composer-setup.php* \
    && chmod +x composer.phar && mv composer.phar /usr/bin/composer \
    && ln -s /usr/bin/php8 /usr/local/bin/php

COPY ./docker/php/symfony.ini /etc/php8/conf.d/
COPY ./docker/php/symfony.ini /etc/php8/cli/conf.d/

COPY ./docker/php/symfony.pool.conf /etc/php8/php-fpm.d/

RUN apk --no-cache add shadow && usermod -u 1000 www-data && groupmod -g 1000 www-data
USER "1000:1000"

WORKDIR '/var/www/symfony'

COPY . .
RUN --mount=type=secret,id=DATABASE_URL \
  export DATABASE_URL=$(cat /run/secrets/DATABASE_URL) && \
  echo $DATABASE_URL

ENV APP_ENV=prod

RUN composer install --prefer-dist --no-progress --no-interaction --no-dev --optimize-autoloader --no-scripts

CMD ["php-fpm8", "-F"]

EXPOSE 9001