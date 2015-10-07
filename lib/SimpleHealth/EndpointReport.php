<?php
namespace SimpleHealth;

use \ValueObjects\StringLiteral\StringLiteral as StringLiteral;
use \ValueObjects\Web\Url as Url;

class EndpointReport implements \SimpleHealth\ReportInterface, \ValueObjects\ValueObjectInterface {
	public $endpoint;
	public $pass;
	public $message;

	function __construct(Url $endpoint, $pass, StringLiteral $message) {
		$this->endpoint = $endpoint;
		$this->pass = $pass;
		$this->message = $message;
	}

	public static function fromNative() {
		
	}

	public function sameValueAs(\ValueObjects\ValueObjectInterface $object) {

	}

	public function __toString() {

	}
}
