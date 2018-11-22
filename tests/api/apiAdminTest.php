<?php

  require_once( "vendor/autoload.php" );

  // Create a client with a base URI
  $client = new GuzzleHttp\Client( ['base_uri' => 'http://localhost:8000/api/admin/'] );

  /* Testing getting a single product
  *
  *

  $response = $client->request( 'GET', 'product/107/Admin/Admin' );
  $body = $response->getBody();
  // Implicitly cast the body to a string and echo it
  echo $body;
  echo "\n\n";

  /*
  * Testing getting a all products
  *

  $response = $client->request( 'GET', 'products/Admin/Admin' );
  $body = $response->getBody();
  // Implicitly cast the body to a string and echo it
  echo $body;
  echo "\n\n";
*/


  /*
  * Testing Post creating a new product
  *
  $data =[
      'form_params' => [
        'auth' => ['Admin', 'Admin'],
        'data' => [
                'name'=>'Samsung handy',
                'supplier_id'=>87123,
                'category_id'=>0,
                'description'=>'Best handy 8gb RAM, multicore processors',
                'unit_price'=>400,
                'creation_date'=>date('Y-m-d h:i:s', time() )
              //  'last_modified_date'=>null,
              //  'group_list'=>''
        ]
      ]
  ];

  $response = $client->request( 'POST', 'product/create', $data );
  $body = $response->getBody();
  // Implicitly cast the body to a string and echo it
  echo $body;
  echo "\n\n";
*/
/********************************************************************************/
/*
$data =[
    'form_params' => [
      'auth' => ['Admin', 'Admin'],
      'data' => [
              'id' => 128,
              'name'=>'Moto Rolla 4',
              'supplier_id'=>87123,
              'category_id'=>0,
              'description'=>'Dual Core handy 16gb RAM, multicore processors',
              'unit_price'=>300,
              'last_modified_date'=>date('Y-m-d h:i:s', time() ),
              'group_list'=>'A,B,C'
      ]
    ]
];

$response = $client->request( 'POST', 'product/create', $data );
$body = $response->getBody();
// Implicitly cast the body to a string and echo it
echo $body;
echo "\n\n";
*/
/*****************************************************************************/
$data =[
    'form_params' => [
      'auth' => ['Admin', 'Admin'],
      'data' => [
              'id' => 128,
              'name'=>'Moto Rolla 4',
              'supplier_id'=>87123,
              'category_id'=>0,
              'description'=>'Dual Core handy 16gb RAM, multicore processors',
              'unit_price'=>300,
              'last_modified_date'=>date('Y-m-d h:i:s', time() ),
              'group_list'=>'120,125,121',
              'discount'=>'-100'
      ]
    ]
];

$response = $client->request( 'POST', 'product/create', $data );
$body = $response->getBody();
// Implicitly cast the body to a string and echo it
echo $body;
echo "\n\n";
