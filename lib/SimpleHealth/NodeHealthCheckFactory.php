<?php
namespace SimpleHealth;

class NodeHealthCheckFactory {

	public function make(array $endpoints) {
		return new \SimpleHealth\NodeHealthCheck(
			$endpoints,
			new \SimpleHealth\NodeValidator(),
			new \SimpleHealth\EndpointHealthCheckFactory()
		);
	}
}