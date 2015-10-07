<?php
namespace SimpleHealth;

use \ValueObjects\StringLiteral\StringLiteral as StringLiteral;

class ValidatorResult {
	function __construct($pass, StringLiteral $message) {
		$this->pass = $pass;
		$this->message = $message;
	}
}