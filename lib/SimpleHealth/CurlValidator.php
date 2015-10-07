<?php
namespace SimpleHealth;

use \SimpleHealth\ValidatorInterface as ValidatorInterface;
use \SimpleHealth\ValidatorResult as ValidatorResult;
use \GuzzleHttp\Psr7\Response;
use \ValueObjects\StringLiteral\StringLiteral as StringLiteral;

class CurlValidator implements ValidatorInterface {
	function __construct() {
	}

	public function isValid(\GuzzleHttp\Psr7\Response $data) {
		$http_status = $data->getStatusCode();

		if($http_status === 200) {
			return new ValidatorResult(true, StringLiteral::fromNative(''));
		}

		return new ValidatorResult(false, StringLiteral::fromNative("Unhealthy http response code ({$http_status})"));
	}
}
