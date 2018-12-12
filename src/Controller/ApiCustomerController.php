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
use App\Helper\ProductHelper;
// use App\Entity\User;

class ApiCustomerController extends BaseController
{
  private $login_error_msg = ['User'=>'Oops Login Error' ];
  /**
   * @Route("/api/products/{username}/{password}", name="view_allproducts")
   */
  public function show_products( $username, $password , ProductHelper $ph )
  {
    // ToDO display all products to Admin with credentials
     if( $this->islogin( $username, $password ) && $this->isCustomer() ){
          $allproducts = $ph->filterdDisplayProduct( $ph->get_products() );
          return $this->json( ['Content'=>$allproducts ] );
     }
     return $this->json( $this->login_error_msg );

  }

  /**
   * @Route("/api/products/processorder", name="process_order")
   */
  public function order_products( Request $request, ProductHelper $ph )
  {
    $auth = $request->request->get('auth');
    $data = $request->request->get('data');
     if( $this->islogin( $auth[0], $auth[1] ) && $this->isCustomer() ){
        // process order subtotal.
        if( count($data) ){
            return $this->json( $ph->processOrder( $data ) );
        }
        return $this->json( ['error'=>'array is empty'] );
     }
     return $this->json( $this->login_error_msg );

  }


}
