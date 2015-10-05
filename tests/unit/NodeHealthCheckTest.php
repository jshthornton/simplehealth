<?php
use \SimpleHealth\NodeHealthCheck as NodeHealthCheck;
use \SimpleHealth\ValidatorInterface as ValidatorInterface;
use \SimpleHealth\EndpointHealthCheckFactory as EndpointHealthCheckFactory;
use \Mockery;

class NodeHealthCheckTest extends PHPUnit_Framework_TestCase {
  public function test() {
  	$validator_mock = \Mockery::mock('\SimpleHealth\ValidatorInterface');
  	$heatlhcheck_factory_mock = \Mockery::mock('\SimpleHealth\EndpointHealthCheckFactory');
  	$healthcheck_mock = \Mockery::mock('\SimpleHealth\EndpointHealthCheck');
  	$endpoint_report_mock = \Mockery::mock('\SimpleHealth\EndpointReport');
  	$node_report_mock = \Mockery::mock('\SimpleHealth\ValidatorResult');

  	$validator_mock->shouldReceive('isValid')->andReturn($node_report_mock);
  	$heatlhcheck_factory_mock->shouldReceive('make')->andReturn($healthcheck_mock);
  	$healthcheck_mock->shouldReceive('check')->andReturn($endpoint_report_mock);

  	$subject = new NodeHealthCheck(['http://www.php.net'], $validator_mock, $heatlhcheck_factory_mock);

  	$node_report = $subject->check();

  	$this->assertEquals($node_report, $node_report_mock);
  }
}