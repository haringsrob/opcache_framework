<?php

// The main file is always loaded.
$classes = ['main.php' => __DIR__ . '/main.php'];

// Scan framework files.
$framework = new RecursiveDirectoryIterator(__DIR__ . "/src");
foreach (new RecursiveIteratorIterator($framework) as $file) {
    if ($file->getExtension() === 'php' && !str_contains($file->getRealPath(), 'Cached')) {
        $classes[$file->getFilename()] = $file->getRealPath();
    }
}

// Scan implementation files.
$impl = new RecursiveDirectoryIterator(__DIR__ . "/../src");
foreach (new RecursiveIteratorIterator($impl) as $file) {
    if ($file->getExtension() === 'php') {
        $classes[$file->getFilename()] = $file->getRealPath();
    }
}

function _preload(array $classes, bool $dev = false): void
{
    $routesFile = null;
    if ($dev) {
        foreach ($classes as $file) {
            require_once $file;
        }
    } else {
        foreach ($classes as $filename => $file) {
            // Do no handle the routes.php file as it will be generating later.
            if ($filename !== 'routes.php') {
                include $file;
            }
            else {
                $routesFile = $file;
            }
        }
    }

    if ($routesFile) {
        // First included the routesFile.
        include  $routesFile;

        if (!$dev) {
            // Generate a class.
            $cacheFile = __DIR__ . '/src/Cached/RouteList.php';
            $file = fopen($cacheFile, 'wb');

            $printed = var_export(\Framework\Core\Routes::$routes, true);

            $stub = <<<PHP
<?php

namespace Framework;

class RouteList {
    public static array \$routes = $printed;
}
PHP;

            fwrite($file, $stub);
            opcache_compile_file($cacheFile);
        }
    }
}



// @todo: how to handle the debug param easily?
_preload($classes, true);
