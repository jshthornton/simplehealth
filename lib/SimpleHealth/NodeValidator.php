<?php
namespace SimpleHealth;
use \SimpleHealth\ValidatorReport as ValidatorReport;

class NodeValidator {
	protected $reports;

	function __construct($reports) {
		$this->reports = $reports;
	}

	public function validate() {
		foreach ($this->reports as $report) {
			if($report->pass === false) {
				return new ValidatorReport(false, $report->message);
			}
		}

		return new ValidatorReport(true, '');
	}
}