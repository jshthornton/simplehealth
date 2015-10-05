<?php
namespace SimpleHealth;

use \SimpleHealth\ValidatorInterface as ValidatorInterface;
use \SimpleHealth\ValidatorReport as ValidatorReport;

class CurlValidator implements ValidatorInterface {
	function __construct() {
	}

	public function isValid(\Guzzle\ResponseInterface $data) {
		$http_status = $data->getStatusCode();

		if($http_status === 200) {
			return new ValidatorReport(true, '');
		}

		return new ValidatorReport(false, "Unhealthy http response code ({$http_status})");
	}
}
