<?php
namespace SimpleHealth;
use \SimpleHealth\ValidatorReport as ValidatorReport;

class NodeValidator {
	protected $reports;

	function __construct() {
	}

	public function validate($reports) {
		foreach ($reports as $report) {
			if($report->pass === false) {
				return new ValidatorReport(false, $report->message);
			}
		}

		return new ValidatorReport(true, '');
	}
}