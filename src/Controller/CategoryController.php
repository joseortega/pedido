<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class CategoryController extends Controller
{
    /**
     * @Route("/v1/category", name="category_index", methods="GET", defaults={"_format":"json"})
     */
    public function index(CategoryRepository $categoryRepository): Response{
        $serializer = $this->get('jms_serializer');
        
        $categories = $categoryRepository->findAll();
        
        $response = [
            'code'=> 200,
            'error'=> false,
            'data' => $categories,
        ];
        
        return new Response($serializer->serialize($response, 'json'));
    }
}
