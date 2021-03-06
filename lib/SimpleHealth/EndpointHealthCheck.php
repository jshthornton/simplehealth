<?php
namespace SimpleHealth;

use \SimpleHealth\EndpointMechanismInterface as EndpointMechanismInterface;
use \SimpleHealth\ValidatorInterface as ValidatorInterface;
use \ValueObjects\StringLiteral\StringLiteral as StringLiteral;
use \ValueObjects\Web\Url as Url;

class EndpointHealthCheck {
	protected $mechanism;

	function __construct(Url $endpoint, EndpointMechanismInterface $mechanism, ValidatorInterface $validator) {
		$this->endpoint = $endpoint;
		$this->mechanism = $mechanism;
		$this->validator = $validator;
	}

	public function check() {
		try {
			$response = $this->mechanism->request();
		} catch (\GuzzleHttp\Exception\TransferException $ex) {
			return new EndpointReport($this->endpoint, false, StringLiteral::fromNative($ex->getMessage()));
		}

		$report = $this->validator->isValid($response);
		return new EndpointReport($this->endpoint, $report->pass, $report->message);
	}
}