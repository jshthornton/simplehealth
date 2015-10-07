<?php
namespace SimpleHealth;

use \GuzzleHttp\Client;
use \ValueObjects\Web\Url as Url;

class EndpointHealthCheckFactory {
	public function make(Url $endpoint) {
		$client = new \GuzzleHttp\Client();

		return new EndpointHealthCheck($endpoint, new CurlMechanism($client, $url), new CurlValidator());
	}
}