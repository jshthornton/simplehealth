<?php
namespace SimpleHealth;

use \SimpleHealth\NodeReport as NodeReport;

class NodeReportFormatter {

	function __construct(NodeReport $report) {
		$this->report = $report;
	}

	public function format() {
		$data = [];
		$report = $this->report;

		$data['pass'] = $report->pass;
		$data['message'] = (string) $report->message;
		$data['endpointReports'] = array_map(function($endpoint_report) {
			return (object) [
				'pass' => $endpoint_report->pass,
				'message' => (string) $endpoint_report->message,
				'endpoint' => (string) $endpoint_report->endpoint
			];
		}, $report->endpointReports->toArray());

		return (object) $data;
	}
}