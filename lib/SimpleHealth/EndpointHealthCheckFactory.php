<?php
namespace SimpleHealth;

use \Curl\Curl as Curl;
use \ValueObjects\Web\Url as Url;

class EndpointHealthCheckFactory {
	public function make($endpoint) {
		$curl = new Curl();
		$url = new Url($endpoint);

		return new EndpointHealthCheck($endpoint, new CurlMechanism($curl, $url), new CurlValidator());
	}
}