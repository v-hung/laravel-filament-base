<?php

namespace App\Http\Controllers;

use BackedEnum;
use Inertia\ResponseFactory;
use UnitEnum;

abstract class Controller
{
	protected ResponseFactory $inertia;

	public function __construct(ResponseFactory $inertia)
	{
		$this->inertia = $inertia;
	}

	protected function render(string $component, array $props = [])
	{
		return $this->inertia->render($component, $props);
	}

	protected function flash(BackedEnum|UnitEnum|string|array $key, mixed $value = null)
	{
		return $this->inertia->flash($key, $value);
	}
}
