<?php
namespace SimpleHealth;

class ValidatorResult {
	function __construct($pass, $message) {
		$this->pass = $pass;
		$this->message = $message;
	}
}