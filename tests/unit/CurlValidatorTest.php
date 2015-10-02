<?php
use \SimpleHealth\CurlValidator as CurlValidator;
use \Guzzle\ResponseInterface;
use \Mockery;

class CurlValidatorTest extends PHPUnit_Framework_TestCase {
  public function testWhen200CodeValidatePasses() {
  	$response_mock = \Mockery::mock('\Guzzle\ResponseInterface');
  	$response_mock->shouldReceive('getStatusCode')->andReturn(200);

  	$subject = new CurlValidator();
  	$report = $subject->validate($response_mock);

  	$this->assertEquals($report->pass, true);
  }

  public function testWhenNon200CodeValidateFails() {
  	$response_mock = \Mockery::mock('\Guzzle\ResponseInterface');
  	$response_mock->shouldReceive('getStatusCode')->andReturn(500);

  	$subject = new CurlValidator();
  	$report = $subject->validate($response_mock);

  	$this->assertEquals($report->pass, false);
  }
}