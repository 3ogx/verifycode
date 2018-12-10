<?php
namespace Cenzimo\Verifycode\Facades;

use Illuminate\Support\Facades\Facade;

class Verifycode extends Facade {
	protected static function getFacadeAccessor()
	{
			return 'Cenzimo\\Verifycode\\Verifycode';
	}
}