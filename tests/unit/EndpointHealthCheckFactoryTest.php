<?php
use \SimpleHealth\EndpointHealthCheck as EndpointHealthCheck;
use \SimpleHealth\EndpointHealthCheckFactory as EndpointHealthCheckFactory;
use \SimpleHealth\ValidatorInterface as ValidatorInterface;
use \ValueObjects\Web\Url as Url;
use \ValueObjects\StringLiteral\StringLiteral as StringLiteral;
use \Mockery;

class EndpointHealthCheckFactoryTest extends PHPUnit_Framework_TestCase {
  public function testCorrespondingObjectIsReturned() {
  	$subject = new EndpointHealthCheckFactory();
  	$obj = $subject->make(Url::fromNative('http://www.php.net/'));

  	$this->assertInstanceOf('\SimpleHealth\EndpointHealthCheck', $obj);
  }
}
