# What is this?

This is a small experiment/free time project to see how a no-dependency framework optimized for OPcache precache will
work.

Currently, it serves **10000** requests in about **8.5** seconds using `ab` on my machine from docker (0.851 ms / req).

Without the OPcache in place (route discovery) it serves 10000 requests in **15.597** seconds. (1.560 ms /req).

You can run `make benchmark` to run the benchmark in docker.

## Structure

For now the framework lives in the `framework` folder, application specific code in the `src` folder.

Routes can be added to `routes.php` and will generate a `RouteList.php` class that will be stored with opcache.

## Develop without opcache

Comment the line: `RUN echo "opcache.preload=/var/www/html/framework/preload.php" >> $PHP_INI_DIR/php.ini;` in
the `docker/php.Dockerfile` then run `docker-compose build`. Finally run `docker-compose up` again.

In `index.php` add `require_once 'framework/preload.php'`

With opcache you need to restart php every time you update code, for faster development you can set the debug flag
in `preload.php` to true.

# Why?

Why not?


