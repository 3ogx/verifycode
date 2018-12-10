<?php

namespace Cenzimo\Verifycode;

use Cenzimo\Verifycode\VerifycodeManager as Manager;

class Verifycode extends Controller {
	
	public function postSendCode() {
		return Manager::validateSendable();
	}
}