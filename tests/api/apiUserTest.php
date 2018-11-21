<?php
  include '../vendor/autoload.php';

  // Create a client with a base URI
  $client = new GuzzleHttp\Client( ['base_uri' => 'http://localhost:8000/api/user/'] );

  /* Testing all products using get
  *
  */
  $response = $client->request( 'GET', 'index' );
  $body = $response->getBody();
  // Implicitly cast the body to a string and echo it
  echo $body;
  echo "\n\n";
