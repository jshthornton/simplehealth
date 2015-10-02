<?php
namespace SimpleHealth;

use \Curl\Curl as Curl;
use \ValueObjects\Web\Url as Url;
use \SimpleHealth\CurlHealthChcek as CurlHealthChcek;
use \SimpleHealth\CurlValidator as CurlValidator;
use \SimpleHealth\EndpointReport as EndpointReport;

class SimpleHealth {
	protected $endpoints;

	function __construct($endpoints) {
		$this->endpoints = $endpoints;
	}

	public function run() {
		$endpoint_reports = [];

		foreach ($this->endpoints as $endpoint) {
			$curl = new Curl();
			$url = new Url($endpoint);

			$healthcheck = new CurlHealthChcek($curl, $url);
			$healthcheck->check();

			$report = (new CurlValidator($curl))->validate();

			$endpoint_reports[] = new EndpointReport($endpoint, $report->pass, $report->message);
		}

		$node_report = (new NodeValidator($endpoint_reports))->validate();

		return $node_report;
	}
}