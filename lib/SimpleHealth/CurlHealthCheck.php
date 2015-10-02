<?php
namespace SimpleHealth;
use SimpleHealth\HealthCheckInterface as HealthCheckInterface;
use ValueObjects\Web\Url as Url;
use \Curl\Curl as Curl;
use ValueObjects\Web\NullPortNumber as NullPortNumber;

class CurlHealthCheck implements HealthCheckInterface {
  protected $curl;
  protected $url;

  function __construct(Curl $curl, Url $url) {
    $this->curl = $curl;
    $this->url = $url;
  }

  protected function getResolveHost() {
    $port = $this->url->getPort();
    $port = ($port instanceof NullPortNumber) ? 80 : $port;
    return "{$this->url->getDomain()}:{$port}:127.0.0.1";
  }

  public function check() {
    // Local var shortcut
    $curl = $this->curl;

    // Set options
    $curl->setOpt(CURLOPT_FOLLOWLOCATION, true); // Follows redirects.
    $curl->setOpt(CURLOPT_RESOLVE, [$this->getResolveHost()]); // All services should be on the local machine.

    // Do request. Head to minimise RTT
    $curl->head($this->url);

    $curl->close();
    return $curl;
  }
}