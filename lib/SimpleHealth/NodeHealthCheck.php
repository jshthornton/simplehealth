<?php
namespace SimpleHealth;

class NodeHealthCheck {
	function __construct($endpoints, ValidatorInterface $validator, EndpointHealthCheckFactory $healthcheck_factory) {
		$this->endpoints = $endpoints;
		$this->validator = $validator;
		$this->healthcheckFactory = $healthcheck_factory;
	}

	public function check() {
		$endpoint_reports = [];

		$healthcheck_factory = $this->healthcheckFactory;

		foreach ($this->endpoints as $endpoint) {
			$healthcheck = $healthcheck_factory->make($endpoint);
			$endpoint_reports[] = $healthcheck->check();
		}

		$validator_result = $this->validator->isValid($endpoint_reports);
		if($validator_result->pass === true) {
			return new \SimpleHealth\NodeReport(true, '', $endpoint_reports);
		} else {
			return new \SimpleHealth\NodeReport(false, $validator_result->message. $endpoint_reports);
		}
	}
}