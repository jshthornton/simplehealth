<?php
namespace SimpleHealth;

/*use \SimpleHealth\CurlHealthChcek as CurlHealthChcek;
use \SimpleHealth\CurlValidator as CurlValidator;
use \SimpleHealth\EndpointReport as EndpointReport;
use \SimpleHealth\EndpointHealthCheckFactory as EndpointHealthCheckFactory;*/

class SimpleHealth {
	protected $endpoints;

	function __construct($endpoints) {
		$this->endpoints = $endpoints;
	}

	public function run() {
		$node_healthcheck = new NodeHealthCheck();
		return $node_healthcheck->check();
	}
}