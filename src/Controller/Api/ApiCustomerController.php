<?php

namespace App\Api\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ApiCustomerController extends AbstractController
{
    /**
     * @Route("/api/customer", name="api_customer")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ApiCustomerController.php',
        ]);
    }
}
