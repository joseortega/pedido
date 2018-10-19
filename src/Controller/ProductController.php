<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Repository\ProductRepository;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/api")
 */
class ProductController extends Controller
{
    /**
     * @Route("/v1/product", name="product", methods="GET", defaults={"_format":"json"})
     */
    public function index(ProductRepository $productRepository, Request $request, PaginatorInterface $paginator)
    {
        $serializer = $this->get('jms_serializer');
        
        $query = $productRepository->findAllQuery();
        
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );
        
        return new Response($serializer->serialize($pagination, 'json'));  
    }
    
    /**
     * @Route("/v1/product/search", name="product_search", methods="GET", defaults={"_format":"json"})
     */
    public function search(ProductRepository $productRepository, Request $request){
        $serializer = $this->get('jms_serializer');
        
        $query = $request->query->get('query');
        
        $products = $productRepository->search($query);
        
        return new Response($serializer->serialize($products, 'json'));
    }
}
