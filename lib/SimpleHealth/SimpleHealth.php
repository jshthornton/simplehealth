<?php
namespace SimpleHealth;

use \SimpleHealth\NodeHealthCheck as NodeHealthCheck;
use \ValueObjects\Structure\Collection as Collection;

class SimpleHealth {
	protected $endpoints;
	protected $nodeHealthCheck;

	function __construct(Collection $endpoints, NodeHealthCheck $node_healthcheck) {
		$this->endpoints = $endpoints;
		$this->nodeHealthCheck = $node_healthcheck;
	}

	public function run() {
		return $this->nodeHealthCheck->check();
	}
}