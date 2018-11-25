<?php
/**
 * @author Felix Ashu Aba
 * @author-url https://www.fa2.it/about/
 */

  require_once( "vendor/autoload.php" );
  require_once( __DIR__."/testFunction.php" );

  // Create a client with a base URI
  $client = new GuzzleHttp\Client( ['base_uri' => 'http://localhost:8000/api/'] );


  /* Testing customer access to all products using get
  */

  $response = $client->request( 'GET', 'products/Brown Thomas/customer' );
  $res = json_decode( $response->getBody() );
  echo "Testing for retriving All products: ";
  compareEquals( count( $res->Content ), 26 );
  echo "\n----------------\n";

  /*
  * Testing Customer Order
  */
  $order =[
      'form_params' => [
        'auth' => ['Brown Thomas','customer'],
        'data' => [
                ['product_id'=>120,
                'quantity'=>5,
                'unit_price'=>180
                ],
                ['product_id'=>127,
                'quantity'=>3,
                'unit_price'=>400
                ],
                ['product_id'=>103,
                'quantity'=>10,
                'unit_price'=>10
                ]
        ]
      ]
  ];

  $response = $client->request( 'POST', 'products/processorder', $order );
   $res = json_decode( $response->getBody() );
   echo "Testing for Customer Order: ********\n";
   echo "\nTesting for sub total ". $res->order[0]->product_id .": ";
   compareEquals( $res->order[0]->sub_total, 900 );
   echo "\nTesting for sub total ". $res->order[1]->product_id .": ";
   compareEquals( $res->order[1]->sub_total, 1200 );
   echo "\nTesting for sub total ". $res->order[2]->product_id .": ";
   compareEquals( $res->order[2]->sub_total, 100 );

   echo "\nTesting for total for Order: ";
   compareEquals( $res->total, 2200 );
   echo "\n----------------\n";
