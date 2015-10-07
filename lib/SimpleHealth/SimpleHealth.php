<?php
namespace SimpleHealth;

/*use \SimpleHealth\CurlHealthChcek as CurlHealthChcek;
use \SimpleHealth\CurlValidator as CurlValidator;
use \SimpleHealth\EndpointReport as EndpointReport;
use \SimpleHealth\EndpointHealthCheckFactory as EndpointHealthCheckFactory;*/

class SimpleHealth {
	protected $endpoints;
	protected $nodeHealthCheck;

	function __construct(array $endpoints, $node_healthcheck) {
		$this->endpoints = Collection::fromNative($endpoints);
		$this->nodeHealthCheck = $node_healthcheck;
	}

	public function run() {
		return $this->nodeHealthCheck->check();
	}
}