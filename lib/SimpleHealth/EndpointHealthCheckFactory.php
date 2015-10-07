<?php
namespace SimpleHealth;

use \GuzzleHttp\Client;
use \ValueObjects\Web\Url as Url;

class EndpointHealthCheckFactory {
	public function make($endpoint) {
		$client = new \GuzzleHttp\Client();
		$url = Url::fromNative((string) $endpoint);

		return new EndpointHealthCheck((string) $endpoint, new CurlMechanism($client, $url), new CurlValidator());
	}
}