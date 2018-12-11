<?php
/**
 * @author Felix Ashu Aba
 * @author-url https://www.fa2.it/about/
 */

  use GuzzleHttp\Client;
  use PHPUnit\Framework\TestCase;


  class apiAdminTest extends TestCase{

   protected $client;

   protected function setUp()
   {
       $this->client = new GuzzleHttp\Client( ['base_uri' => 'http://localhost:8000/api/admin/'] );
   }

   protected function tearDown()
   {
       unset( $this->client );
   }

   public function testProductbyID(){
     $response = $this->client->request( 'GET', 'product/107/Admin/Admin' );
     $res = json_decode( $response->getBody() );
     // echo "\n Testing for retriving product/107: \n";
     $this->assertEquals( $res->Content->id, 107 );

   }

   public function testAdminGetAllProduct(){
     $response = $this->client->request( 'GET', 'products/Admin/Admin' );
     $res = json_decode( $response->getBody() );
     // echo "\n Testing for retriving all products: \n";
      $this->assertCount( 26, $res->Content );

   }

   public function testSettingDiscountByValue(){

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

     $response = $this->client->request( 'POST', 'product/create', $data );
     $res = json_decode( $response->getBody() );
     // echo "Testing for setting discount by value: ";
     $this->assertEquals( $res->ProductId, 128 );

     $response = $this->client->request( 'GET', 'product/128/Admin/Admin' );
     // Implicitly cast the body to a string and echo it
     $res = json_decode( $response->getBody() );
     // echo "Testing for Expected discount price: ";
     $this->assertEquals( $res->Content->discount_price, 450 );
   }

   public function testSettingDiscountByPercentage(){
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

     $response = $this->client->request( 'POST', 'product/create', $data );
     $res = json_decode( $response->getBody() );
     //echo "Testing for setting discount by percentage%: ";
     $this->assertEquals( $res->ProductId, 127 );

     $response = $this->client->request( 'GET', 'product/127/Admin/Admin' );
     // Implicitly cast the body to a string and echo it
     $res = json_decode( $response->getBody() );
     // echo "Testing for Expected discount price: ";
     $this->assertEquals( $res->Content->discount_price, 200 );


   }

 }
