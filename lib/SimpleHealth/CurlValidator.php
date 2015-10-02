<?php
namespace SimpleHealth;

use \SimpleHealth\ValidatorReport as ValidatorReport;

class CurlValidator {
	function __construct() {
	}

	public function validate(\Guzzle\ResponseInterface $reponse) {
		$http_status = $reponse->getStatusCode();

		if($http_status === 200) {
			return new ValidatorReport(true, '');
		}

		return new ValidatorReport(false, "Unhealthy http response code ({$http_status})");
	}
}
