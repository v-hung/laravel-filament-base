<?php

namespace App\Http\Controllers;

use BackedEnum;
use Inertia\Inertia;
use Inertia\ResponseFactory;
use UnitEnum;

abstract class Controller
{

    protected function render(string $component, array $props = [])
    {
        return Inertia::render($component, $props);
    }

    protected function flash(BackedEnum|UnitEnum|string|array $key, mixed $value = null)
    {
        return Inertia::flash($key, $value);
    }
}
