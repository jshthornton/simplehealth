<?php
namespace SimpleHealth;

use \ValueObjects\Structure\Collection as Collection;
use \ValueObjects\StringLiteral\StringLiteral as StringLiteral;

class NodeHealthCheck {
	function __construct(Collection $endpoints, ValidatorInterface $validator, EndpointHealthCheckFactory $healthcheck_factory) {
		$this->endpoints = $endpoints;
		$this->validator = $validator;
		$this->healthcheckFactory = $healthcheck_factory;
	}

	protected function collectEndpointReports() {
		$endpoint_reports = new \SplFixedArray($this->endpoints->count()->toNative());

		$healthcheck_factory = $this->healthcheckFactory;

		$index = 0;
		foreach ($this->endpoints->toArray() as $endpoint) {
			$healthcheck = $healthcheck_factory->make($endpoint);
			$endpoint_reports[$index] = $healthcheck->check();
			$index++;
		}

		return new Collection($endpoint_reports);
	}

	protected function createNodeReportFromValidatorResult(\SimpleHealth\ValidatorResult $result, Collection $endpoint_reports) {
		if($result->pass === true) {
			return new \SimpleHealth\NodeReport(true, StringLiteral::fromNative(''), $endpoint_reports);
		} else {
			return new \SimpleHealth\NodeReport(false, $result->message, $endpoint_reports);
		}
	}

	public function check() {
		$endpoint_reports = $this->collectEndpointReports();

		$result = $this->validator->isValid($endpoint_reports);
		return $this->createNodeReportFromValidatorResult($result, $endpoint_reports);
	}
}