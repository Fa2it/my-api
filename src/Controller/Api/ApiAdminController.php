<?php

namespace App\Api\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ApiAdminController extends AbstractController
{
    /**
     * @Route("/api/admin", name="api_admin")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ApiAdminController.php',
        ]);
    }
}
