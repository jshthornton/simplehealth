<?php
namespace SimpleHealth;
use SimpleHealth\HealthCheckInterface as HealthCheckInterface;
use ValueObjects\Web\Url as Url;
use \Curl\Curl as Curl;

class CurlHealthCheck implements HealthCheckInterface {
  protected $curl;
  protected $url;

  function __construct(Curl $curl, Url $url) {
    $this->curl = $curl;
    $this->url = $url;
  }

  public function check() {
    $curl = $this->curl;
    $curl->setOpt(CURLOPT_FOLLOWLOCATION, true);
    $curl->head($this->url);

    if ($curl->error) {
      throw new \Exception($curl->errorCode . ': ' . $curl->errorMessage);
    }

    $http_status = curl_getinfo($curl->curl, CURLINFO_HTTP_CODE);

    $curl->close();

    return $http_status;
  }
}