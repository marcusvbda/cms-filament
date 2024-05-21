FROM php:8.2-fpm-alpine

RUN mkdir -p /var/www/html

COPY ./config/php/www.conf /usr/local/etc/php-fpm.d/www.conf

ARG UID
ARG GID
ARG DB_PROD_HOST
ARG DB_PROD_PORT
ARG SSH_PROD_USER
ARG SSH_PROD_SERVER
ARG SSH_MYSQL_FORWARD_PORT

ENV UID=${UID}
ENV GID=${GID}
ENV DB_PROD_HOST=${DB_PROD_HOST}
ENV DB_PROD_PORT=${DB_PROD_PORT}
ENV SSH_PROD_USER=${SSH_PROD_USER}
ENV SSH_PROD_SERVER=${SSH_PROD_SERVER}
ENV SSH_MYSQL_FORWARD_PORT=${SSH_MYSQL_FORWARD_PORT}

RUN apk --no-cache update \
    && apk --no-cache upgrade \
    && apk add --no-cache icu-dev pcre-dev $PHPIZE_DEPS \
    freetype-dev \
    jpeg-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    libzip-dev

RUN apk add openjdk8
RUN wget https://gitlab.com/pdftk-java/pdftk/-/jobs/924565145/artifacts/raw/build/libs/pdftk-all.jar
RUN mv pdftk-all.jar /usr/local/bin/pdftk.jar
COPY ./config/php/pdftk /usr/local/bin/pdftk
RUN chmod 775 /usr/local/bin/pdftk*

RUN docker-php-ext-configure gd \
    --with-freetype=/usr/lib/ \
    --with-jpeg=/usr/include/ \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && docker-php-ext-enable intl \
    && docker-php-ext-install -j$(getconf _NPROCESSORS_ONLN) gd zip pdo pdo_mysql exif\
    && pecl install redis \
    && docker-php-ext-enable redis.so

RUN docker-php-ext-install pcntl

RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer
RUN alias composer='php /usr/bin/composer' && \
    apk add --update nodejs npm

RUN addgroup -g ${GID} --system laravel
RUN adduser -G laravel --system -D -s /bin/sh -u ${UID} laravel

RUN apk --no-cache add nano zsh git zsh-autosuggestions zsh-syntax-highlighting bind-tools curl openssh && \
    rm -rf /var/cache/apk/*

USER laravel

RUN sh -c "$(curl -fsSL https://raw.github.com/robbyrussell/oh-my-zsh/master/tools/install.sh)"

RUN echo "source /usr/share/zsh/plugins/zsh-syntax-highlighting/zsh-syntax-highlighting.zsh" >> ~/.zshrc && \
    echo "source /usr/share/zsh/plugins/zsh-autosuggestions/zsh-autosuggestions.zsh" >> ~/.zshrc && \
    echo "alias configzsh='nano ~/.zshrc && source ~/.zshrc'" >> ~/.zshrc && \
    echo "alias home='cd ~/'" >> ~/.zshrc && \
    echo "alias workdir='cd /var/www/html'" >> ~/.zshrc && \
    echo "alias artisan='php artisan'" >> ~/.zshrc && \
    echo "alias tinker='php artisan tinker'" >> ~/.zshrc && \
    echo "alias watch='npm run watch'" >> ~/.zshrc && \
    echo "alias dumpa='composer dump-autoload -o'" >> ~/.zshrc && \
    echo "alias mysql_tunnel='ssh -4 -N -L ${SSH_MYSQL_FORWARD_PORT}:${DB_PROD_HOST}:${DB_PROD_PORT} ${SSH_PROD_USER}@${SSH_PROD_SERVER}'" >> ~/.zshrc

COPY ./config/ssh/ /home/laravel/.ssh/
