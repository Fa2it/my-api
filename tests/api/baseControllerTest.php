<?php
/**
 * @author Felix Ashu Aba
 * @author-url https://www.fa2.it/about/
 */

  require_once( "vendor/autoload.php" );
    require_once( __DIR__."/testFunction.php" );

  // Create a client with a base URI
  $client = new GuzzleHttp\Client( ['base_uri' => 'http://localhost:8000/api/test/'] );

  /* Testing islogin and
  * And getting a Response
 */

$data =[
      'form_params' => [
        'auth' => ['Admin', 'Admin'],
      ]
  ];

$response = $client->request('POST', 'adminlogin', $data );
$res = json_decode( $response->getBody() );
echo "Testing for Admin Login: ";
compareEquals( $res->isAdminLogin, 1 );
echo "\n----------------\n";


/* Testing islogin and
* And getting a Response
*/

$data =[
    'form_params' => [
      'auth' => ['Brown Thomas', 'customer'],
    ]
];

$response = $client->request('POST', 'customerlogin', $data );
$res = json_decode( $response->getBody() );
echo "Testing for User/customer Login: ";
compareEquals( $res->isLogin, 1 );
