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
use App\Helper\ProductHelper;


class ApiAdminController extends BaseController
{
    private $login_error_msg = [' User Admin '=>'Oops Login Error' ];
    /**
     * @Route("/api/admin/products/{username}/{password}", name="view_all_products")
     */
    public function show_products( $username, $password, ProductHelper $ph )
    {
      // ToDO display all products to Admin with credentials
       if( $this->islogin( $username, $password ) && $this->isAdmin() ){
            return $this->json( ['Content'=>$ph->get_products() ] );
       }
       return $this->json( $this->login_error_msg );

    }

    /**
     * @Route("/api/admin/product/{id}/{username}/{password}", name="view_single_product")
     */
    public function show_product( $id, $username, $password, ProductHelper $ph )
    {
      // ToDO display one products to Admin with credentials
       if( $this->islogin( $username, $password ) && $this->isAdmin() ){
            return $this->json( ['Content'=>$ph->get_products( $id ) ] );
       }
       return $this->json( $this->login_error_msg );

    }

    /**
     * @Route("/api/admin/product/create", name="create_update_product")
     */
    public function create_update_product( Request $request, ProductHelper $ph )
    {
      $auth = $request->request->get('auth');
      $data = $request->request->get('data');
      $resmsg = [];
      
      if( $this->islogin( $auth[0], $auth[1] ) && $this->isAdmin() ){
          $get_product = $ph->get_product( @$data['id'] );
          $product= $get_product['product'];

          if( $product ){
            $product->setProduct( $data );
            $ph->save( $product );
            $resmsg = array_merge( $get_product['msg'], ['ProductId'=>$product->getId()] );
          }

          return $this->json( $resmsg );
      }
      return $this->json( $this->login_error_msg );

    }



}
