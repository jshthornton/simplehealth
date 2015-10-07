<?php
namespace SimpleHealth;

use \SimpleHealth\NodeHealthCheck as NodeHealthCheck;
use \ValueObjects\Structure\Collection as Collection;

class SimpleHealth {
	protected $endpoints;
	protected $nodeHealthCheck;

	function __construct(array $endpoints, NodeHealthCheck $node_healthcheck) {
		$this->endpoints = Collection::fromNative($endpoints);
		$this->nodeHealthCheck = $node_healthcheck;
	}

	public function run() {
		return $this->nodeHealthCheck->check();
	}
}