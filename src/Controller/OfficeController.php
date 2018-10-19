<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\OfficeRepository;

/**
 * @Route("/api")
 */
class OfficeController extends Controller
{
    /**
     * @Route("/v1/office", name="office_index", methods="GET", defaults={"_format":"json"})
     */
    public function index(OfficeRepository $officeRepository): Response{
        $serializer = $this->get('jms_serializer');
        
        $offices = $officeRepository->findAll();
        
        $response = [
            'code'=> 200,
            'error'=> false,
            'data' => $offices,
        ];
        
        return new Response($serializer->serialize($response, 'json'));
    }
}
