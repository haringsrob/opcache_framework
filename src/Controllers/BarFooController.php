<?php

namespace App\Controllers;

use Framework\Controller;

class BarFooController extends Controller
{
    public function index(): string {
        return 'Hi from BarFooController: index';
    }
    public function barFoo(): string {
        return 'Hi from BarFooController: barFoo';
    }
}
