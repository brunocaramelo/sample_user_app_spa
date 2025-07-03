FROM composer:2.7.7 as builder

COPY . /app

RUN composer install  \
    --ignore-platform-reqs \
    --no-ansi \
    --no-autoloader \
    --no-interaction \
    --no-scripts \
    --prefer-dist

RUN composer dump-autoload --optimize --classmap-authoritative

FROM node:22 as build-frontend

WORKDIR /app

COPY ./package.json ./package-lock.json /app/

COPY \
  --from=builder \
  /app/vendor /app/vendor

RUN npm install

COPY . /app

RUN mkdir -p /app/build

RUN npm run build

#RUN cp /app/public/build/.vite/manifest.json /app/public/build/manifest.json


FROM dunglas/frankenphp:1.1.3-php8.3

# COPY --from=builder /app /app

COPY --from=build-frontend /app /app


ENV WEBSERVER_PORT=${WEBSERVER_PORT:-8003}

RUN apt-get update && apt-get install -y \
      libzip-dev \
      sqlite3 \
      libsqlite3-dev \
      libicu-dev \
      libpq-dev \
      && docker-php-ext-install zip pdo_mysql \
      pdo_pgsql \
      pdo_sqlite \
      pcntl \
      posix

WORKDIR /app

COPY docker/webserver/config/Caddyfile /etc/caddy/Caddyfile

COPY docker/webserver/startup/startup.sh /app/startup.sh

RUN chmod +x /app/startup.sh

# RUN chown -R www-data:www-data /app \
#     && mkdir -p /app/storage /app/bootstrap/cache \
#     && chmod -R ug+w /app/storage /app/bootstrap/cache

# USER www-data

EXPOSE ${WEBSERVER_PORT}


CMD ["/bin/bash", "-c", "/app/startup.sh --webserver-port=${WEBSERVER_PORT}"]
