FROM php:8.0-apache

RUN cp $APACHE_CONFDIR/mods-available/rewrite.load $APACHE_CONFDIR/mods-enabled/rewrite.load

RUN echo "zend_extension=opcache" >> $PHP_INI_DIR/php.ini;
RUN echo "[opcache]" >> $PHP_INI_DIR/php.ini;
RUN echo "opcache.enable=1" >> $PHP_INI_DIR/php.ini;
RUN echo "opcache.preload_user=root" >> $PHP_INI_DIR/php.ini;
#RUN echo "opcache.preload=/var/www/html/framework/preload.php" >> $PHP_INI_DIR/php.ini;
