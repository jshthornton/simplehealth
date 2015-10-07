<?php
namespace SimpleHealth;

use ValueObjects\Structure\Collection as Collection;

class NodeHealthCheck {
	function __construct(array $endpoints, ValidatorInterface $validator, EndpointHealthCheckFactory $healthcheck_factory) {
		$this->endpoints = Collection::fromNative($endpoints);
		$this->validator = $validator;
		$this->healthcheckFactory = $healthcheck_factory;
	}

	protected function collectEndpointReports() {
		$endpoint_reports = [];

		$healthcheck_factory = $this->healthcheckFactory;

		foreach ($this->endpoints->toArray() as $endpoint) {
			$healthcheck = $healthcheck_factory->make($endpoint);
			$endpoint_reports[] = $healthcheck->check();
		}

		return $endpoint_reports;
	}

	protected function createNodeReportFromValidatorResult(\SimpleHealth\ValidatorResult $result, array $endpoint_reports) {
		if($result->pass === true) {
			return new \SimpleHealth\NodeReport(true, '', $endpoint_reports);
		} else {
			return new \SimpleHealth\NodeReport(false, $result->message. $endpoint_reports);
		}
	}

	public function check() {
		$endpoint_reports = $this->collectEndpointReports();

		$result = $this->validator->isValid($endpoint_reports);
		return $this->createNodeReportFromValidatorResult($result, $endpoint_reports);
	}
}