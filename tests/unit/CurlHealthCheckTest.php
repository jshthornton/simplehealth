<?php
use SimpleHealth\CurlHealthCheck as CurlHealthCheck;
use ValueObjects\Web\Url as Url;
use \Curl\Curl as Curl;

class CurlHealthCheckTest extends PHPUnit_Framework_TestCase {
  public function testCheckReturnsCode() {
    $curl = new Curl();
    $url = Url::fromNative('http://www.php.net');

    $obj = new \SimpleHealth\CurlHealthCheck($curl, $url);
    $code = $obj->check();
    $this->assertEquals($code, 200);
  }
}