<?php
namespace SimpleHealth;

use \Curl\Curl as Curl;
use \SimpleHealth\ValidatorReport as ValidatorReport;

class CurlValidator {
	protected $curl;

	function __construct(Curl $curl) {
		$this->curl = $curl;
	}

	public function validate() {
		if($this->curl->error) {
			return new ValidatorReport(false, $this->curl->errorMessage);
		}

		$http_status = curl_getinfo($curl->curl, CURLINFO_HTTP_CODE);

		if($http_status === 200) {
			return new ValidatorReport(true, '');
		}

		return new ValidatorReport(false, "Unhealthy http response code ({$http_status})");
	}
}
