<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

abstract class Controller
{
    private $notification = null;
    private $sharedData = [];

    protected function view($data = [], $mergeData = [])
    {
        $action = Route::currentRouteAction();

        if (!$action) {
            abort(500, 'Cannot determine the current controller action.');
        }

        [$controller, $method] = explode('@', $action);

        $viewPath = str_replace('App\\Http\\Controllers\\', '', $controller);
        $viewPath = str_replace('Controller', '', $viewPath);
        $viewPath = str_replace('\\', '.', $viewPath);

        $viewName = 'pages.' . strtolower($viewPath . '.' . $method);

        if (!view()->exists($viewName)) {
            abort(500, "View [{$viewName}] not found.");
        }

        // Pass a single notification to the view
        return view($viewName, array_merge($data, $this->sharedData, ['notification' => $this->notification]), $mergeData);
    }

    /**
     * Redirect back with notification (success or error)
     */
    protected function back()
    {
        if ($this->notification) {
            return redirect()->back()->with('notification', $this->notification);
        }

        return redirect()->back();
    }

    /**
     * Redirect to a named route with optional notification (success or error)
     */
    protected function redirectRoute(string $routeName, array $params = [])
    {
        if ($this->notification) {
            return redirect()->route($routeName, $params)->with('notification', $this->notification);
        }

        return redirect()->route($routeName, $params);
    }

    protected function shared($data)
    {
        $this->sharedData = array_merge($this->sharedData, $data);
    }

    /**
     * Successful message assignment (overwrite)
     */
    protected function setSuccessMessage(string $message)
    {
        $this->notification = [
            'type' => 'success',
            'message' => $message,
        ];
    }

    /**
     * Message assignment failed (overwritten)
     */
    protected function setErrorMessage(string $message)
    {
        $this->notification = [
            'type' => 'error',
            'message' => $message,
        ];
    }
}
