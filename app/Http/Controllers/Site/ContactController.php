<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->render('site/contact');
    }
}
