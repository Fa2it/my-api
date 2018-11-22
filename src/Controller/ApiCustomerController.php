<?php
/**
 * @author Felix Ashu Aba
 * @author-url https://www.fa2.it/about/
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ApiCustomerController extends AbstractController
{
  private $login_error_msg = ['User'=>'Oops Login Error' ];
  /**
   * @Route("/api/products/{username}/{password}", name="view_allproducts")
   */
  public function show_products( $username, $password )
  {
    // ToDO display all products to Admin with credentials
     if( $this->islogin( $username, $password ) && $this->isCustomer() ){
          return $this->json( ['Content'=>$this->get_products() ] );
     }
     return $this->json( $this->login_error_msg );

  }


}
