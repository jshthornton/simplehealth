<?php
namespace SimpleHealth;

use \ValueObjects\StringLiteral\StringLiteral as StringLiteral;

class EndpointReport implements \SimpleHealth\ReportInterface {
	public $endpoint;
	public $pass;
	public $message;

	function __construct($endpoint, $pass, $message) {
		$this->endpoint = StringLiteral::fromNative($endpoint);
		$this->pass = $pass;
		$this->message = StringLiteral::fromNative($message);
	}
}
