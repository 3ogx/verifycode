<?php
namespace Cenzimo\Verifycode\Facades;

use Illuminate\Support\Facades\Facade;

class VerifycodeManager extends Facade {
	protected static function getFacadeAccessor()
	{
			return 'Cenzimo\\Verifycode\\VerifycodeManager';
	}
}