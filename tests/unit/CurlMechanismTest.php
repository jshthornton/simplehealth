<?php
use \SimpleHealth\CurlMechanism as CurlMechanism;
use \ValueObjects\Web\Url as Url;
use \GuzzleHttp\Client;
use \Mockery;

class CurlMechanismTest extends PHPUnit_Framework_TestCase {
  public function testCheckReturnsCode() {
  	$client_mock = \Mockery::mock('\GuzzleHttp\Client');
  	$response_mock = \Mockery::mock('\GuzzleHttp\Psr7\Response');
    $url = Url::fromNative('http://www.php.net');

    $client_mock->shouldReceive('request')->andReturn($response_mock);

    $obj = new \SimpleHealth\CurlMechanism($client_mock, $url);
    $code = $obj->request();
  }
}