<?php
use \SimpleHealth\EndpointHealthCheck as EndpointHealthCheck;
use \SimpleHealth\EndpointMechanismInterface as EndpointMechanismInterface;
use \SimpleHealth\ValidatorInterface as ValidatorInterface;
use \Mockery;

class EndpointHealthCheckTest extends PHPUnit_Framework_TestCase {
  public function testWhenMechanismWorksTheCorrectReportIsReturned() {
    $mechanism_mock = \Mockery::mock('\SimpleHealth\EndpointMechanismInterface');
    $validator_mock = \Mockery::mock('\SimpleHealth\ValidatorInterface');
    $response_mock = \Mockery::mock('\Guzzle\ResponseInterface');
    $report_mock = \Mockery::mock('\SimpleHealth\ValidatorReport');

    $mechanism_mock->shouldReceive('request')->andReturn($response_mock);
    $validator_mock->shouldReceive('isValid')->andReturn($report_mock);

    $report_mock->pass = true;
    $report_mock->message = '';

    $healthcheck = new EndpointHealthCheck('http://www.php.net', $mechanism_mock, $validator_mock);
    $report = $healthcheck->check();
    $this->assertEquals($report->pass, true);
  }

  public function testWhenMechanismThrowExceptionReportIsFailed() {
    $mechanism_mock = \Mockery::mock('\SimpleHealth\EndpointMechanismInterface');
    $validator_mock = \Mockery::mock('\SimpleHealth\ValidatorInterface');

    $mechanism_mock->shouldReceive('request')->andThrow(new \GuzzleHttp\Exception\TransferException());

    $healthcheck = new EndpointHealthCheck('http://www.php.net', $mechanism_mock, $validator_mock);
    $report = $healthcheck->check();
    $this->assertEquals($report->pass, false);
  }
}