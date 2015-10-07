<?php
namespace SimpleHealth;
use \SimpleHealth\ValidatorResult as ValidatorResult;
use \SimpleHealth\ValidatorInterface as ValidatorInterface;

class NodeValidator implements ValidatorInterface {
	function __construct() {
	}

	public function isValid(array $reports) {
		foreach ($reports as $report) {
			if($report->pass === false) {
				return new ValidatorResult(false, $report->message);
			}
		}

		return new ValidatorResult(true, '');
	}
}