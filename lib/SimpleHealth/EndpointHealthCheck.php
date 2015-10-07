<?php
namespace SimpleHealth;

use \SimpleHealth\EndpointMechanismInterface as EndpointMechanismInterface;
use \SimpleHealth\ValidatorInterface as ValidatorInterface;
use \ValueObjects\StringLiteral\StringLiteral as StringLiteral;

class EndpointHealthCheck {
	protected $mechanism;

	function __construct($endpoint, EndpointMechanismInterface $mechanism, ValidatorInterface $validator) {
		$this->endpoint = StringLiteral::fromNative($endpoint);
		$this->mechanism = $mechanism;
		$this->validator = $validator;
	}

	public function check() {
		try {
			$response = $this->mechanism->request();
		} catch (\GuzzleHttp\Exception\TransferException $ex) {
			return new EndpointReport((string) $this->endpoint, false, $ex->getMessage());
		}

		$report = $this->validator->isValid($response);
		return new EndpointReport((string) $this->endpoint, $report->pass, $report->message);
	}
}