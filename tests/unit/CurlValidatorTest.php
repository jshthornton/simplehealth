<?php
use \SimpleHealth\CurlValidator as CurlValidator;
use \GuzzleHttp\Psr7\Response;
use \Mockery;

class CurlValidatorTest extends PHPUnit_Framework_TestCase {
  public function testWhen200CodeValidatePasses() {
  	$response_mock = \Mockery::mock('\GuzzleHttp\Psr7\Response');
  	$response_mock->shouldReceive('getStatusCode')->andReturn(200);

  	$subject = new CurlValidator();
  	$report = $subject->isValid($response_mock);

  	$this->assertEquals($report->pass, true);
  }

  public function testWhenNon200CodeValidateFails() {
  	$response_mock = \Mockery::mock('\GuzzleHttp\Psr7\Response');
  	$response_mock->shouldReceive('getStatusCode')->andReturn(500);

  	$subject = new CurlValidator();
  	$report = $subject->isValid($response_mock);

  	$this->assertEquals($report->pass, false);
  }
}