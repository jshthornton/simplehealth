<?php
namespace SimpleHealth;

use \SimpleHealth\SimpleHealth as SimpleHealth;
use \SimpleHealth\NodeHealthCheckFactory as NodeHealthCheckFactory;

class SimpleHealthBuilder {
	public $endpoints;

	function __construct() {
		$this->endpoints = [];
	}

	public function build() {
		$node_healthcheck_factory = new NodeHealthCheckFactory();
		$node_healthcheck = $node_healthcheck_factory->make($this->endpoints);
		return new SimpleHealth($this->endpoints, $node_healthcheck);
	}
}