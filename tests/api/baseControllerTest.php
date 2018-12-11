<?php
/**
 * @author Felix Ashu Aba
 * @author-url https://www.fa2.it/about/
 */


  use GuzzleHttp\Client;
  use PHPUnit\Framework\TestCase;


  class baseControllerTest extends TestCase{

   protected $client;

   protected function setUp()
   {
       $this->client = new GuzzleHttp\Client( ['base_uri' => 'http://localhost:8000/api/test/'] );
   }

   protected function tearDown()
   {
       unset( $this->client );
   }

   public function testAdminLogin(){

     $data =[
           'form_params' => [
             'auth' => ['Admin', 'Admin'],
           ]
       ];

     $response = $this->client->request('POST', 'adminlogin', $data );
     $res = json_decode( $response->getBody() );
     // echo "\nTesting for Admin Login: \n";
     $this->assertTrue( $res->isAdminLogin, 1 );

   }

   public function testCustomerLogin(){
     $data =[
         'form_params' => [
           'auth' => ['Brown Thomas', 'customer'],
         ]
     ];

     $response = $this->client->request('POST', 'customerlogin', $data );
     $res = json_decode( $response->getBody() );
     // echo "\n Testing for User/customer Login: \n";
     $this->assertEquals( $res->isLogin, 1 );

   }

 }
