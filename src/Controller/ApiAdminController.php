<?php

namespace App\Controller;
use App\Controller\BaseController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;

class ApiAdminController extends BaseController
{
    /**
     * @Route("/api/admin/products", name="api_admin")
     */
    public function index()
    {
      // ToDO display products to Admin with credentials
       $this->login( 'Admin', 'Admin' );
       
       return $this->json(['Is User and Admin '=>$this->isAdmin() ] );
    }

    /**
     * @Route("/api/admin/new_user", name="new_user")
     */
    public function new_user(){
      // you can fetch the EntityManager via $this->getDoctrine()
      // or you can add an argument to your action: index(EntityManagerInterface $entityManager)
      $entityManager = $this->getDoctrine()->getManager();

      $user = new User();
      $user->setName('Brown Thomas');
      $user->setEmail('customer@admin.com');
      $user->setRole('customer');
      $user->setPassword('customer');

      // tell Doctrine you want to (eventually) save the Product (no queries yet)
      $entityManager->persist( $user );

      // actually executes the queries (i.e. the INSERT query)
      $entityManager->flush();

      return $this->json(['New User with id '=>$user->getId() ] );


    }


}
