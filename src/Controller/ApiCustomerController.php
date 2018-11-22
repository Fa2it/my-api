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
    /**
     * @Route("/api/customer/products", name="api_customer")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ApiCustomerController.php',
        ]);
    }


}
