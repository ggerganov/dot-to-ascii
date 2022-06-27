FROM php:7.2-apache

# This Dockerfile does the minimum requires to host this locally. It does no
# performance tuning or security hardening.
# NOT FOR PRODUCTION USE.

# Perl Graph::Easy lib and script.
RUN curl -Ls https://cpanmin.us | perl - App::cpanminus && cpanm Graph::Easy

# PHP app itself.
COPY config.php dot-load.php dot-save.php dot-to-ascii.css dot-to-ascii.php index.html samples.js split.min.js /var/www/html/

# Other needed directories and files, most fetched from https://dot-to-ascii.ggerganov.com/ itself.
RUN mkdir -p /var/www/html/lib /var/www/html/mode/dot /usr/local/share/dot-to-ascii/requests/ \
    && chown -R www-data:www-data /usr/local/share/dot-to-ascii \
    && curl -sL https://dot-to-ascii.ggerganov.com/lib/codemirror.js > /var/www/html/lib/codemirror.js \
    && curl -sL https://dot-to-ascii.ggerganov.com/lib/codemirror.css > /var/www/html/lib/codemirror.css \
    && curl -sL https://dot-to-ascii.ggerganov.com/mode/dot/dot.js > /var/www/html/mode/dot/dot.js \
    && curl -sl https://dot-to-ascii.ggerganov.com/favicon.ico > /var/www/html/favicon.ico
