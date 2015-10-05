<?php
use \SimpleHealth\NodeValidator as NodeValidator;
use \SimpleHealth\EndpointReport as EndpointReport;
use \Mockery;

class NodeValidatorTest extends PHPUnit_Framework_TestCase {
  public function testWhenAllReportsPassed() {
  	$report_mock = \Mockery::mock('\SimpleHealth\EndpointReport');
  	$report_mock->pass = true;

  	$subject = new NodeValidator();
  	$report = $subject->isValid([$report_mock]);

  	$this->assertEquals($report->pass, true);
  }

  public function testWhenThereIsAFailedReport() {
  	$report_mock = \Mockery::mock('\SimpleHealth\EndpointReport');
    $report_mock->pass = false;

    $subject = new NodeValidator();
    $report = $subject->isValid([$report_mock]);

    $this->assertEquals($report->pass, false);
  }
}