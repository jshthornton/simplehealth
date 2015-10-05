<?php
namespace SimpleHealth;

class EndpointReport {
	public $endpoint;
	public $pass;
	public $message;

	function __construct($endpoint, $pass, $message) {
		$this->endpoint = $endpoint;
		$this->pass = $pass;
		$this->message = $message;
	}
}
