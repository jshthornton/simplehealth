<?php
namespace SimpleHealth;

class NodeHealthCheckFactory {

	public function make($endpoints) {
		return new \SimpleHealth\NodeHealthCheck(
			$endpoints,
			new \SimpleHealth\NodeValidator(),
			new \SimpleHealth\EndpointHealthCheckFactory()
		);
	}
}