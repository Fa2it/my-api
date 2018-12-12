<?php

namespace App\Helper;
use App\Entity\Product;
use  Doctrine\ORM\EntityManagerInterface;


 class ProductHelper {


  private $entityManager;

  public function __construct(EntityManagerInterface $entityManager )
  {
      $this->entityManager = $entityManager;
  }



  public function processOrder( array $data =[]): array {
      $t =[];
      if( count($data) ){
        $t['order'] = array_map ( function( $item ){
                  $price = ( isset( $item['discount_price'] ) ) ? $item['discount_price'] : $item['unit_price'] ;
                  $res['sub_total'] = $item['quantity'] * $price;
                  return array_merge($item, $res );
        } , $data );
        // process order Total.
        $t['total'] = array_sum( array_map ( function( $item ){ return $item['sub_total']; }, $t['order'] ) );
      }
      return $t;
  }

  public function filterdDisplayProduct(array $products =[] ) : array {

      return  array_map(function($product){
            return [
                    'name'=>$product['name'],
                    'description'=>$product['description'],
                    'unit_price'=>$product['unit_price'],
                    'discount_price'=>$product['discount_price']
                   ];
        }, $products );

  }

  public function get_products(int $id=0 ):array {
    $products = null;
    if( $id > 0 ){
        $products =   $this->entityManager->getRepository(Product::class)->find( $id ) ;
    } else {
        $products =   $this->entityManager->getRepository(Product::class)->findAll();
    }
    if( count( $products ) > 1 ){
        return array_map(function( $product ){
          return  $product->serializeProduct();
        }, $products );
    } elseif( $products ){
      return $products->serializeProduct();
    }
    return $products;
  }

  public function get_product( int $id ):array{
    $product = $msg = null;
    if( $id > 0 ){
        $product =   $this->entityManager->getRepository(Product::class)->find( $id ) ;
        $msg = [ 'Message'=>'Product updated '];

    } else {
        $product = new Product();
        $msg = [ 'Message'=>'A new Product is created '];
    }

    if(!$product){
       $msg = ['Message'=>'Error Product not found!'];
    }

    return ['product'=> $product, 'msg'=> $msg ];

  }


  public function save(Product $product ){
    // tell Doctrine you want to (eventually) save the Product (no queries yet)
    $this->entityManager->persist( $product );
    // actually executes the queries (i.e. the INSERT query)
    $this->entityManager->flush();
  }

 }
