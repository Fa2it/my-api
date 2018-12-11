<?php
/**
 * @author Felix Ashu Aba
 * @author-url https://www.fa2.it/about/
 */
 #namespace App\Tests\Api;

 use GuzzleHttp\Client;
 use PHPUnit\Framework\TestCase;


 class apiCustomerTest extends TestCase{

  protected $client;

  protected function setUp()
  {
      $this->client = new GuzzleHttp\Client( ['base_uri' => 'http://localhost:8000/api/'] );
  }

  protected function tearDown()
  {
      unset( $this->client );
  }

  public function testCustomerGetAllProducts(){
    $response = $this->client->request( 'GET', 'products/Brown Thomas/customer' );
    $this->assertEquals( 200, $response->getStatusCode() );
    $res = json_decode( $response->getBody() );
    $this->assertCount(26, $res->Content );
  }

  public function testCustomerOrder(){

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

     $response = $this->client->request( 'POST', 'products/processorder', $order );
     $res = json_decode( $response->getBody() );

    // echo "\nTesting for Customer Order: ********\n";
    // echo "\nTesting for sub total Product ID ". $res->order[0]->product_id .": ";
     $this->assertEquals(  $res->order[0]->sub_total, 900 );
    // echo "\nTesting for sub total Product ID ". $res->order[1]->product_id .": ";
     $this->assertEquals(  $res->order[1]->sub_total, 1200 );
    // echo "\nTesting for sub total Product ID ". $res->order[2]->product_id .": ";
     $this->assertEquals(  $res->order[2]->sub_total, 100 );

     // echo "\nTesting for total for Order: ";
     $this->assertEquals(  $res->total, 2200 );
     // echo "\n-----------------------------------------\n";
  }

}
