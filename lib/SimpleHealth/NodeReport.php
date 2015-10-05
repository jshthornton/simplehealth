<?php
namespace SimpleHealth;

class NodeReport implements \SimpleHealth\ReportInterface {
	function __construct($pass, $message, $endpoint_reports) {
		$this->pass = $pass;
		$this->message = $message;
		$this->endpointReports = $endpoint_reports;
	}
}