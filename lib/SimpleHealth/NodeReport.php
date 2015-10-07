<?php
namespace SimpleHealth;

use \ValueObjects\StringLiteral\StringLiteral as StringLiteral;
use \ValueObjects\Structure\Collection as Collection;

class NodeReport implements \SimpleHealth\ReportInterface {
	function __construct($pass, $message, array $endpoint_reports) {
		$this->pass = $pass;
		$this->message = StringLiteral::fromNative($message);
		$this->endpointReports = Collection::fromNative($endpoint_reports);
	}
}