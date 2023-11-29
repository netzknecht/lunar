ARG PHP_VERSION
FROM php:${PHP_VERSION}-alpine3.18
COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN curl -sSL https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions -o - | sh -s \
    bcmath exif intl zip gd xdebug
RUN apk fix && \
    apk --no-cache --update add git git-lfs gpg openssh patch bash nano && \
    git lfs install
RUN mv "$PHP_INI_DIR/php.ini-development" ${PHP_INI_DIR}/php.ini
RUN adduser -D -s /bin/bash lunar
COPY ./docker-entrypoint /docker-entrypoint
RUN chmod +x /docker-entrypoint
ENTRYPOINT [ "/docker-entrypoint" ]
WORKDIR /home/lunar
