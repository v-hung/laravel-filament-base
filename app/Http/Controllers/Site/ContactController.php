<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Shared\SharedData;
use Illuminate\Http\Request;

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
