<?php

define('BASE_URL', 'https://vericoindice.com/api');

class VericoindiceError extends Exception { /* ... */ }

function object_to_array($d)
{
  if (is_object($d))
    $d = get_object_vars($d);
 
  if (is_array($d))
    return array_map(__FUNCTION__, $d);
  return $d;
}
 
class VericoindiceClient
{
  private $api;

  public function __construct($apiKey)
  {
    $this->api = $apiKey;
  }

  private function make_contents($contents)
  {
    $contents = json_decode($contents);
    $contents = object_to_array($contents);

    if (array_key_exists('error', $contents))
      throw new VericoindiceError($contents['error']);

    return $contents;
  }

  public function get_balance()
  {
    $url = BASE_URL . '/getbalance?api=' . $this->api;
    $contents = file_get_contents($url);

    return $this->make_contents($contents)['balance'];
  }

  public function roll($amount, $chance)
  {
    $url = BASE_URL . '/roll';

    $data = array('api' => $this->api, 'amount' => $amount, 'chance' => $chance);

    $options = array(
      'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data),
      )
    );

    $context  = stream_context_create($options);
    $contents = file_get_contents($url, false, $context);

    return $this->make_contents($contents);
  }
}

?>
