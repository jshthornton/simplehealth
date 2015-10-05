<?php
namespace SimpleHealth;
use \SimpleHealth\ValidatorReport as ValidatorReport;
use \SimpleHealth\ValidatorInterface as ValidatorInterface;

class NodeValidator implements ValidatorInterface {
	function __construct() {
	}

	public function isValid($reports) {
		foreach ($reports as $report) {
			if($report->pass === false) {
				return new ValidatorReport(false, $report->message);
			}
		}

		return new ValidatorReport(true, '');
	}
}