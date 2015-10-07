<?php
namespace SimpleHealth;

use \SimpleHealth\NodeHealthCheck as NodeHealthCheck;
use \SimpleHealth\NodeValidator as NodeValidator;
use \SimpleHealth\EndpointHealthCheckFactory as EndpointHealthCheckFactory;

class NodeHealthCheckFactory {

	public function make(array $endpoints) {
		return new NodeHealthCheck(
			$endpoints,
			new NodeValidator(),
			new EndpointHealthCheckFactory()
		);
	}
}