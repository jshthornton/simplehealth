<?php
namespace SimpleHealth;

class EndpointReport {
	protected $endpoint;
	protected $pass;
	protected $message;

	function __construct($endpoint, $pass, $message) {
		$this->endpoint = $endpoint;
		$this->pass = $pass;
		$this->message = $message;
	}
}
