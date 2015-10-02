<?php
use \SimpleHealth\CurlMechanism as CurlMechanism;
use \ValueObjects\Web\Url as Url;
use \GuzzleHttp\Client;

class CurlMechanismTest extends PHPUnit_Framework_TestCase {
  public function testCheckReturnsCode() {
    $client = new GuzzleHttp\Client();
    $url = Url::fromNative('http://www.php.net');

    $obj = new \SimpleHealth\CurlMechanism($client, $url);
    $code = $obj->request();
  }
}