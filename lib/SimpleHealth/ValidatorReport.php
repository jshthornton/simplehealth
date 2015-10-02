<?php
namespace SimpleHealth;

class ValidatorReport {

	function __construct($pass, $message) {
		$this->pass = $pass;
		$this->message = $message;
	}
}