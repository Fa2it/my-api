<?php

  require_once( "vendor/autoload.php" );

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

$body = $response->getBody();
// Implicitly cast the body to a string and echo it
echo $body;
echo "\n\n";


/* Testing islogin and
* And getting a Response
*/

$data =[
    'form_params' => [
      'auth' => ['Brown Thomas', 'customer'],
    ]
];

$response = $client->request('POST', 'customerlogin', $data );

$body = $response->getBody();
// Implicitly cast the body to a string and echo it
echo $body;
echo "\n\n";
