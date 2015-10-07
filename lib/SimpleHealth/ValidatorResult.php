<?php
namespace SimpleHealth;

use \ValueObjects\StringLiteral\StringLiteral as StringLiteral;

class ValidatorResult {
	function __construct($pass, $message) {
		$this->pass = $pass;
		$this->message = \ValueObjects\StringLiteral\StringLiteral::fromNative((string) $message);
	}
}