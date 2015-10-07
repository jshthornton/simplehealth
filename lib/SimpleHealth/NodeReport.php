<?php
namespace SimpleHealth;

use \ValueObjects\StringLiteral\StringLiteral as StringLiteral;
use \ValueObjects\Structure\Collection as Collection;

class NodeReport implements \SimpleHealth\ReportInterface {
	function __construct($pass, StringLiteral $message, Collection $endpoint_reports) {
		$this->pass = $pass;
		$this->message = $message;
		$this->endpointReports = $endpoint_reports;
	}
}