<?php

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
          $id = @$data['id'];
          $entityManager = $this->getDoctrine()->getManager();
          if( $id ){
              $product =   $this->getDoctrine()->getRepository(Product::class)->findOneBy( ['id' => $id ] ) ;
          } else {
              $product = new Product();
          }

          $this-> set_product( $product ,  $data );
          // tell Doctrine you want to (eventually) save the Product (no queries yet)
          $entityManager->persist( $product );
          // actually executes the queries (i.e. the INSERT query)
          $entityManager->flush();
          return $this->json(['A new Product created with id '=>$product->getId() ] );
      }
      return $this->json( $this->login_error_msg );

    }

    private function get_products( $id=0 ){
      $products = null;
      if( $id > 0 ){
          $products =   $this->getDoctrine()->getRepository(Product::class)->findOneBy( ['id' => $id ] ) ;
      } else {
          $products =   $this->getDoctrine()->getRepository(Product::class)->findAll();
      }
      if( count( $products ) > 1 ){
          return array_map(function( $product ){
            return  $this->serialize_product( $product );
          }, $products );
      } elseif( $products ){
        return $this->serialize_product( $products );
      }
      return $products;
    }

    private function serialize_product(Product $product ){
       return [
          'id'=>$product->getId(),
          'name'=>$product->getName(),
          'supplier_id'=>$product->getSupplierId(),
          'category_id'=>$product->getCategoryId(),
          'description'=>$product->getDescription(),
          'unit_price'=>$product->getUnitPrice(),
          'creation_date'=>$product->getCreationDate(),
          'last_modified_date'=>$product->getLastModifiedDate(),
          'group_list'=>$product->getGroupList(),
          'discount' =>$product->getDiscount(),
          'discount_price' =>$product->getDiscountPrice()
       ];

    }

    private function set_product(Product $product , array $data ){
            if( isset( $data['name'] ) ){
              $product->setName( @$data['name'] );
            }
            if( isset( $data['supplier_id'] ) ){
              $product->setSupplierId( @$data['supplier_id'] );
            }

            if( isset( $data['category_id'] ) ){
              $product->setCategoryId( @$data['category_id'] );
            }
            if( isset( $data['description'] ) ){
              $product->setDescription( @$data['description'] );
            }
            if( isset( $data['unit_price'] ) ){
              $product->setUnitPrice( @$data['unit_price'] );
            }

            if( isset( $data['creation_date'] ) ){
              $product->setCreationDate( @$data['creation_date'] );
            }
            if( isset( $data['last_modified_date'] ) ){
              $product->setLastModifiedDate( @$data['last_modified_date']);
            }
            if( isset( $data['group_list'] ) ){
              // TODO if id, make sure elemets of group list are found in
              // otherwise throw and error product
              $product->setGroupList( @$data['group_list'] );
            }
            if( isset( $data['discount'] ) ){
              $product->setDiscount( @$data['discount'] );
            }
            if( isset( $data['unit_price'],  $data['discount'] ) ){
              $product->setDiscountPrice( $data['unit_price'],  $data['discount'] );
            }

    }



}
