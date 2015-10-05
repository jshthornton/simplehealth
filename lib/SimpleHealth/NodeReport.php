<?php
namespace SimpleHealth;

class NodeReport {
	function __construct($pass, $message, $endpoint_reports) {
		$this->pass = $pass;
		$this->message = $message;
	}
}