<?php
use \SimpleHealth\NodeValidator as NodeValidator;
use \SimpleHealth\EndpointReport as EndpointReport;
use \ValueObjects\Structure\Collection as Collection;
use \ValueObjects\StringLiteral\StringLiteral as StringLiteral;
use \Mockery;

class NodeValidatorTest extends PHPUnit_Framework_TestCase {
  public function testWhenAllReportsPassed() {
  	$report_mock = \Mockery::mock('\SimpleHealth\EndpointReport');
  	$report_mock->pass = true;
    $report_mock->message = StringLiteral::fromNative('');
    $reports = new Collection(\SplFixedArray::fromArray([$report_mock]));

  	$subject = new NodeValidator();
  	$report = $subject->isValid($reports);

  	$this->assertEquals($report->pass, true);
  }

  public function testWhenThereIsAFailedReport() {
  	$report_mock = \Mockery::mock('\SimpleHealth\EndpointReport');
    $report_mock->pass = false;
    $report_mock->message = StringLiteral::fromNative('');
    $reports = new Collection(\SplFixedArray::fromArray([$report_mock]));

    $subject = new NodeValidator();
    $report = $subject->isValid($reports);

    $this->assertEquals($report->pass, false);
  }
}