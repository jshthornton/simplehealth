<?php
namespace SimpleHealth;

use \SimpleHealth\NodeHealthCheck as NodeHealthCheck;
use \SimpleHealth\NodeValidator as NodeValidator;
use \SimpleHealth\EndpointHealthCheckFactory as EndpointHealthCheckFactory;
use \ValueObjects\Structure\Collection as Collection;

class NodeHealthCheckFactory {

	public function make(Collection $endpoints) {
		return new NodeHealthCheck(
			$endpoints,
			new NodeValidator(),
			new EndpointHealthCheckFactory()
		);
	}
}