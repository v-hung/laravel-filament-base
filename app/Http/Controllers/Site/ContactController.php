<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\InertiaController;
use App\Http\Controllers\Shared\SharedData;
use Illuminate\Http\Request;

class ContactController extends InertiaController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->inertia('Site/Contact', []);
    }
}
