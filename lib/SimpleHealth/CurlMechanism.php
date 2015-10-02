<?php
namespace SimpleHealth;
use \SimpleHealth\EndpointMechanismInterface as EndpointMechanismInterface;
use \ValueObjects\Web\Url as Url;
use \GuzzleHttp\Client;
use \ValueObjects\Web\NullPortNumber as NullPortNumber;

class CurlMechanism implements EndpointMechanismInterface {
  protected $client;
  protected $url;

  function __construct(\GuzzleHttp\Client $client, Url $url) {
    $this->client = $client;
    $this->url = $url;
  }

  protected function getResolveHost() {
/*    $port = $this->url->getPort();
    $port = ($port instanceof NullPortNumber) ? 80 : $port;
    return "{$this->url->getDomain()}:{$port}:127.0.0.1";*/
  }

  public function request() {
    // Local var shortcut
    $client = $this->client;

    // Do request. Head to minimise RTT
    return $client->request('HEAD', $this->url, [
        'curl' => [
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_RESOLVE => [$this->getResolveHost()]
        ]
    ]);
  }
}