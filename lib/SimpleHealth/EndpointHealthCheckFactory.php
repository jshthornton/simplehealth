<?php
namespace SimpleHealth;

use \GuzzleHttp\Client;
use \ValueObjects\Web\Url as Url;

class EndpointHealthCheckFactory {
	public function make($endpoint) {
		$client = new \GuzzleHttp\Client();
		$url = Url::fromNative($endpoint);

		return new EndpointHealthCheck($endpoint, new CurlMechanism($client, $url), new CurlValidator());
	}
}