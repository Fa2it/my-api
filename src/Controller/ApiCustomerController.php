<?php
/**
 * @author Felix Ashu Aba
 * @author-url https://www.fa2.it/about/
 */

namespace App\Controller;
use App\Controller\BaseController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Product;
// use App\Entity\User;

class ApiCustomerController extends BaseController
{
  private $login_error_msg = ['User'=>'Oops Login Error' ];
  /**
   * @Route("/api/products/{username}/{password}", name="view_allproducts")
   */
  public function show_products( $username, $password )
  {
    // ToDO display all products to Admin with credentials
     if( $this->islogin( $username, $password ) && $this->isCustomer() ){
          $allproducts = array_map(function($product){
              return [
                      'name'=>$product['name'],
                      'description'=>$product['description'],
                      'unit_price'=>$product['unit_price'],
                      'discount_price'=>$product['discount_price']
                     ];
          }, $this->get_products() );
          return $this->json( ['Content'=>$allproducts ] );
     }
     return $this->json( $this->login_error_msg );

  }

  /**
   * @Route("/api/products/processorder", name="process_order")
   */
  public function order_products( Request $request )
  {
    $auth = $request->request->get('auth');
    $data = $request->request->get('data');
     if( $this->islogin( $auth[0], $auth[1] ) && $this->isCustomer() ){
        // process order subtotal.
        $st_p = array_map ( function( $item ){
                  $res['sub_total'] = $item['quantity'] * $item['unit_price'];
                  return array_merge($item, $res );
        } , $data );

        // process order Total.
        $t_p = array_map ( function( $item ){  return  $item['sub_total'];  } , $st_p );

        $t['total'] = array_sum( $t_p );
        $t['order'] = $st_p;

        return $this->json( $t );
     }
     return $this->json( $this->login_error_msg );

  }


}
