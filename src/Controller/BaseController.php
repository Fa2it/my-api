<?php
/**
 * @author Felix Ashu Aba
 * @author-url https://www.fa2.it/about/
 */

namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Entity\Product;

class BaseController extends AbstractController
{

  private $_user = null;
  /*
   *Fetch User in Databse , May use session, but at the moment all request.
   * Will not use session just normal login
   */

    protected function isAdmin()
    {
        return ($this->_user != null ) ? ( $this->_user->getRole() == 'Admin' ) : false;
    }

    protected function isCustomer()
    {
        return ($this->_user != null ) ? ( $this->_user->getRole() == 'Customer' ) : false;
    }

    protected function islogin( string $username , string $password ){
      //READ
		    $user =   $this->getDoctrine()->getRepository(User::class)->findOneBy( ['name' => $username ] ) ;
        if( $user ){
          if( password_verify( $password, $user->getPassword() ) )
              $this->_user = $user;
              return true;
        }
        return false;
    }

    public function getUser(){
      return $this->_user;
    }

    /**
     * @Route("/api/test/adminlogin", name="test_adminlogin")
     */
     public function admin_login_test(Request $request ){
       $auth = $request->request->get('auth');
       if( count($auth) > 1 ){
           if( $this->islogin( $auth[0] , $auth[1] ) ){
              return $this->json( ['isAdminLogin'=> $this->isAdmin() ] );
           }
       }
       return $this->json( ['isAdminLogin'=> "Error" ] );
     }

     /**
      * @Route("/api/test/customerlogin", name="test_customerlogin")
      */
     public function customer_login_test(Request $request ){
       $auth = $request->request->get('auth');
       if( count($auth) > 1 ){
           if( $this->islogin( $auth[0] , $auth[1] ) ){
              return $this->json( ['isLogin'=> $this->isCustomer() ] );
           }
       }
       return $this->json( ['isLogin'=> "Error" ] );
     }

     protected function get_products( $id=0 ){
       $products = null;
       if( $id > 0 ){
           $products =   $this->getDoctrine()->getRepository(Product::class)->find( $id ) ;
       } else {
           $products =   $this->getDoctrine()->getRepository(Product::class)->findAll();
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

}
