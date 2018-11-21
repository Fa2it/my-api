<?php

  require_once( "vendor/autoload.php" );

  // Create a client with a base URI
  $client = new GuzzleHttp\Client( ['base_uri' => 'http://localhost:8000/api/admin/'] );

  /* Testing all products using get
  *
  */
  $response = $client->request( 'GET', 'products' );


  $body = $response->getBody();
  // Implicitly cast the body to a string and echo it
  echo $body;
  echo "\n\n";


  /* Creating new users
  *
  */
  $response = $client->request( 'GET', 'new_user' );


  $body = $response->getBody();
  // Implicitly cast the body to a string and echo it
  echo $body;
  echo "\n\n";
