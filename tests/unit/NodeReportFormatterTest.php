<?php
use \SimpleHealth\NodeReportFormatter as NodeReportFormatter;
use \ValueObjects\Web\Url as Url;
use \ValueObjects\StringLiteral\StringLiteral as StringLiteral;
use \ValueObjects\Structure\Collection as Collection;
use \Mockery;

class NodeReportFormatterTest extends PHPUnit_Framework_TestCase {
  public function testCanFormat() {
  	$node_report_mock = \Mockery::mock('\SimpleHealth\NodeReport');
  	$endpoint_report_mock = \Mockery::mock('\SimpleHealth\EndpointReport');
  	$collection_mock = \Mockery::mock('\ValueObjects\Structure\Collection');
  	$message_mock = \Mockery::mock('\ValueObjects\StringLiteral\StringLiteral');
  	$url_mock = \Mockery::mock('\ValueObjects\Web\Url');

  	$collection_mock->shouldReceive('toArray')->andReturn([$endpoint_report_mock]);
  	$message_mock->shouldReceive('__toString')->andReturn('hello');
  	$url_mock->shouldReceive('__toString')->andReturn('http://www.php.net/');

  	$node_report_mock->pass = true;
  	$node_report_mock->message = $message_mock;
  	$node_report_mock->endpointReports = $collection_mock;

  	$endpoint_report_mock->pass = true;
  	$endpoint_report_mock->message = clone $message_mock;
  	$endpoint_report_mock->url = $url_mock;

  	$subject = new NodeReportFormatter($node_report_mock);
  	$formatted = $subject->format();

  	$this->assertEquals($formatted, (object) [
  		'pass' => true,
  		'message' => 'hello',
  		'endpointReports' => [
  			(object) [
  				'pass' => true,
  				'message' => 'hello',
  				'url' => 'http://www.php.net/'
  			]
  		]
  	]);
  }
}
