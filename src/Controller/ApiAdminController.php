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
use App\Entity\User;
use App\Entity\Product;

class ApiAdminController extends BaseController
{
    private $login_error_msg = [' User Admin '=>'Oops Login Error' ];
    /**
     * @Route("/api/admin/products/{username}/{password}", name="view_all_products")
     */
    public function show_products( $username, $password )
    {
      // ToDO display all products to Admin with credentials
       if( $this->islogin( $username, $password ) && $this->isAdmin() ){
            return $this->json( ['Content'=>$this->get_products() ] );
       }
       return $this->json( $this->login_error_msg );

    }

    /**
     * @Route("/api/admin/product/{id}/{username}/{password}", name="view_single_product")
     */
    public function show_product( $id, $username, $password )
    {
      // ToDO display one products to Admin with credentials
       if( $this->islogin( $username, $password ) && $this->isAdmin() ){
            return $this->json( ['Content'=>$this->get_products( $id ) ] );
       }
       return $this->json( $this->login_error_msg );

    }

    /**
     * @Route("/api/admin/product/create", name="create_update_product")
     */
    public function create_update_product( Request $request )
    {
      $auth = $request->request->get('auth');
      $data = $request->request->get('data');

      if( $this->islogin( $auth[0], $auth[1] ) && $this->isAdmin() ){
          $product = null;
          $msg = $resmsg = [];
          $entityManager = $this->getDoctrine()->getManager();
          if( @$data['id'] ){
              $product =   $this->getDoctrine()->getRepository(Product::class)->find( @$data['id'] ) ;
              $msg = [ 'Message'=>'Product updated '];
          } else {
              $product = new Product();
              $msg = [ 'Message'=>'A new Product is created '];
          }

          if( $product ){
            $product->setProduct( $data );
            // tell Doctrine you want to (eventually) save the Product (no queries yet)
            $entityManager->persist( $product );
            // actually executes the queries (i.e. the INSERT query)
            $entityManager->flush();
            $resmsg = array_merge( $msg, ['ProductId'=>$product->getId()] );
          } else{
            $resmsg = ['Message'=>'Error Product not found!'];
          }
          return $this->json( $resmsg );
      }
      return $this->json( $this->login_error_msg );

    }

    private function get_products( $id=0 ){
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
