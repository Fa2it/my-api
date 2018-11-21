<?php
  include '../vendor/autoload.php';

  // Create a client with a base URI
  $client = new GuzzleHttp\Client( ['base_uri' => 'http://localhost:8000/api/admin/'] );

  /* Testing all products using get
  *
  */
  $response = $client->request( 'GET', 'index' );
  $body = $response->getBody();
  // Implicitly cast the body to a string and echo it
  echo $body;
  echo "\n\n";


  /* Testing single product using get and prodict id
  *
  *
  $response = $client->request( 'GET', 'product/10' );
  $body = $response->getBody();
  // Implicitly cast the body to a string and echo it
  echo $body;
  echo "\n\n";


  /* Testing Sending post request for a single product
   * And getting a Response
   *

  $data =[
        'form_params' => [
          'action'=>'update',
          'product_id'=>10,
          'unit_price' => 10,
          'discounts'=> 10,
          'percent'=>'true'
        ]
    ];

  $response = $client->request('POST', 'set/product_price/', $data );

  $body = $response->getBody();
  // Implicitly cast the body to a string and echo it
  echo $body;
  echo "\n\n";

  */
