<?php
namespace SimpleHealth;

use \SimpleHealth\SimpleHealth as SimpleHealth;
use \SimpleHealth\NodeHealthCheckFactory as NodeHealthCheckFactory;
use \ValueObjects\Structure\Collection as Collection;
use \ValueObjects\Web\Url as Url;

class SimpleHealthBuilder {
	public $endpoints;

	function __construct() {
		$this->endpoints = [];
	}

	public function build() {
		$endpoints = \SplFixedArray::fromArray($this->endpoints);
		for($i = 0, $len = count($endpoints); $i < $len; $i++) {
			$endpoints[$i] = Url::fromNative($endpoints[$i]);
		}
		$endpoints = new Collection($endpoints);

		$node_healthcheck_factory = new NodeHealthCheckFactory();
		$node_healthcheck = $node_healthcheck_factory->make($endpoints);
		return new SimpleHealth($endpoints, $node_healthcheck);
	}
}