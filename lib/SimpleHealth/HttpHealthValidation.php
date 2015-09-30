<?php
namespace ValueObjects\Number\Natural as Natural;

class HttpHealthValidation {

  function __construct($curl) {
    $this->curl = $curl;
  }

  public function validate() {
    $curl = $this->curl;

    if ($curl->error) {
      return false;
    }

    $http_status = curl_getinfo($curl->curl, CURLINFO_HTTP_CODE);

    if($http_status === 200) {
      return true;
    }

    return false;
  }
}