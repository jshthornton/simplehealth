<?php
namespace SimpleHealth;

use \SimpleHealth\ValidatorInterface as ValidatorInterface;
use \SimpleHealth\ValidatorResult as ValidatorResult;
use \GuzzleHttp\Psr7\Response;

class CurlValidator implements ValidatorInterface {
	function __construct() {
	}

	public function isValid(\GuzzleHttp\Psr7\Response $data) {
		$http_status = $data->getStatusCode();

		if($http_status === 200) {
			return new ValidatorResult(true, '');
		}

		return new ValidatorResult(false, "Unhealthy http response code ({$http_status})");
	}
}
