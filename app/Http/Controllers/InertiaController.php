<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

abstract class InertiaController extends Controller
{
    /**
     * Return an Inertia response
     */
    protected function inertia(string $component, array $props = []): InertiaResponse
    {
        return Inertia::render($component, $props);
    }

    /**
     * Auto-generate component name from controller and method
     */
    protected function view($data = [], $mergeData = [])
    {
        $action = Route::currentRouteAction();

        if (!$action) {
            abort(500, 'Cannot determine the current controller action.');
        }

        [$controller, $method] = explode('@', $action);

        $componentPath = str_replace('App\\Http\\Controllers\\', '', $controller);
        $componentPath = str_replace('Controller', '', $componentPath);
        $componentPath = str_replace('\\', '/', $componentPath);

        // Convert to PascalCase for component names
        $parts = explode('/', $componentPath);
        $parts = array_map('ucfirst', $parts);
        $componentPath = implode('/', $parts);

        $componentName = $componentPath . '/' . ucfirst($method);

        return Inertia::render($componentName, $data);
    }

    /**
     * Redirect back with notification (success or error)
     */
    protected function back()
    {
        return redirect()->back();
    }

    /**
     * Redirect to a named route with optional notification (success or error)
     */
    protected function redirectRoute(string $routeName, array $params = [])
    {
        return redirect()->route($routeName, $params);
    }

    /**
     * Set success message
     */
    protected function setSuccessMessage(string $message)
    {
        session()->flash('message', $message);
    }

    /**
     * Set error message
     */
    protected function setErrorMessage(string $message)
    {
        session()->flash('error', $message);
    }
}
