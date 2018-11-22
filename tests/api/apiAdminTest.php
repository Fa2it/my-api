<?php
/**
 * @author Felix Ashu Aba
 * @author-url https://www.fa2.it/about/
 */
  require_once( "vendor/autoload.php" );
  require_once( __DIR__."/testFunction.php" );

  // Create a client with a base URI
  $client = new GuzzleHttp\Client( ['base_uri' => 'http://localhost:8000/api/admin/'] );

  /* Testing getting a single product
  *
  */

  $response = $client->request( 'GET', 'product/107/Admin/Admin' );
  // Implicitly cast the body to a string and echo it
  $res = json_decode( $response->getBody() );
  echo "Testing for retriving product/107: ";
  compareEquals( $res->Content->id, 107 );
  echo "\n----------------\n";

  /*
  * Testing getting a all products
  */

  $response = $client->request( 'GET', 'products/Admin/Admin' );
  $res = json_decode( $response->getBody() );
  echo "Testing for retriving all products: ";
  compareEquals( count( $res->Content ), 26 );
  echo "\n----------------\n";


  /*
  * Testing Creating a new product
  * There maybe need for checks if product exist ???
  * if product contains other products or product bundle
  * this is double test,  new product, new product bundle
  */
  $data =[
      'form_params' => [
        'auth' => ['Admin', 'Admin'],
        'data' => [
                'id'=>128,
                'name'=>'Lenovo Laptop',
                'supplier_id'=>87123,
                'category_id'=>0,
                'description'=>'i7 32gb RAM, multicore processors',
                'unit_price'=>500,
                'creation_date'=>date('Y-m-d h:i:s', time() ),
                'group_list'=>'120, 125, 128',
                'discount'=>'-50'
        ]
      ]
  ];

  $response = $client->request( 'POST', 'product/create', $data );
  $res = json_decode( $response->getBody() );
  echo "Testing for setting discount by value: ";
  compareEquals( $res->ProductId, 128 );
  echo "\n";
  $response = $client->request( 'GET', 'product/128/Admin/Admin' );
  // Implicitly cast the body to a string and echo it
  $res = json_decode( $response->getBody() );
  echo "Testing for Expected discount price: ";
  compareEquals( $res->Content->discount_price, 450 );
  echo "\n----------------\n";


  $data =[
      'form_params' => [
        'auth' => ['Admin', 'Admin'],
        'data' => [
                'id'=>127,
                'name'=>'Samsung Handy',
                'supplier_id'=>87123,
                'category_id'=>0,
                'description'=>'i7 32gb RAM, multicore processors',
                'unit_price'=>400,
                'creation_date'=>date('Y-m-d h:i:s', time() ),
                'group_list'=>'120, 125, 128',
                'discount'=>'50%'
        ]
      ]
  ];

  $response = $client->request( 'POST', 'product/create', $data );
  $res = json_decode( $response->getBody() );
  echo "Testing for setting discount by value: ";
  compareEquals( $res->ProductId, 127 );
  echo "\n";
  $response = $client->request( 'GET', 'product/127/Admin/Admin' );
  // Implicitly cast the body to a string and echo it
  $res = json_decode( $response->getBody() );
  echo "Testing for Expected discount price: ";
  compareEquals( $res->Content->discount_price, 200 );
  echo "\n----------------\n";
