<?php

use App\Controllers\BarFooController;
use Framework\Core\Routes;

Routes::registerRoute(path: '', class: BarFooController::class, method: 'index');
Routes::registerRoute(path: 'bar/foo', class: BarFooController::class, method: 'barFoo');
