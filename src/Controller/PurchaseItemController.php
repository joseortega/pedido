<?php

namespace App\Controller;

use App\Entity\Purchase;
use App\Form\CategoryType;
use App\Repository\PurchaseRepository;
use App\Repository\PurchaseItemRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
Use App\Entity\PurchaseItem;
Use App\Entity\PurchaseStatus;

/**
 * @Route("/api/v1/purchase")
 */
class PurchaseItemController extends Controller
{
    /**
     * @Route("/{id}/items", name="purchase_items", methods="GET", defaults={"_format":"json"})
     */
    public function purchaseItems(PurchaseItemRepository $purchaseItemRepository, PurchaseRepository $purchaseRepository, $id){
        $serializer = $this->get('jms_serializer');
        
        $purchase = $purchaseRepository->findOneBy([
//            'user'=> $this->getUser(),
            'id'=>$id
        ]);
        
        return new Response($serializer->serialize($purchase->getPurchaseItems(), 'json'));  
    }
    
    /**
     * @Route("/{id}/item/create", name="purchase_item_create", methods="POST", defaults={"_format":"json"})
     */
    public function create(
            PurchaseItemRepository $purchaseItemRepository, 
            PurchaseRepository $purchaseRepository, $id, 
            Request $request, 
            ValidatorInterface $validator,
            ProductRepository $productRepository){
        
        $serializer = $this->get('jms_serializer');
        $em = $this->getDoctrine()->getManager();
        
        $purchase = $purchaseRepository->findOneBy([
            'user'=> $this->getUser(),
            'id'=>$id
        ]);
        
        $content = json_decode($request->getContent());
        
        $product = $productRepository->findOneBy([
            'id'=>$content->product->id
        ]);
        
        $purchaseItem = new PurchaseItem();
        
        $purchaseItem->setRequestQuantity($content->request_quantity);
        $purchaseItem->setDispatchQuantity($content->request_quantity);
        $purchaseItem->setPurchase($purchase);
        $purchaseItem->setProduct($product);
        
        $errors = $validator->validate($purchaseItem);
        
        $status = 'success';
        $code= 200;
        
        if(count($errors) == 0){
            $em->persist($purchaseItem);
            $em->flush();
        }else{
            $messageError = (array)$errors;
            $status = 'error';
            $code = 500;
        }
        
        $response = [
            'status' => $status,
            'code' => $code,
            'message' => $code == 200 ? 'Item añadido' : $messageError,
        ];
        
        if($code == 200){
            $response['data'] = $purchaseItem;
        }
        
        return new Response($serializer->serialize($response, 'json'), $code);
    }
    
    /**
     * @Route("/{id}/item/update/{itemId}", name="purchase_item_update", methods="POST", defaults={"_format":"json"})
     */
    public function update(
            PurchaseItemRepository $purchaseItemRepository, 
            PurchaseRepository $purchaseRepository, $id, $itemId,
            Request $request, 
            ValidatorInterface $validator,
            ProductRepository $productRepository){
        
        $serializer = $this->get('jms_serializer');
        $em = $this->getDoctrine()->getManager();
        
        $purchase = $purchaseRepository->findOneBy([
            'id'=>$id
        ]);
        
        $content = json_decode($request->getContent());
        
        $purchaseItem = $purchaseItemRepository->find($itemId);
        
        $purchaseItem->setRequestQuantity($content->request_quantity);
        
        if($purchase->getStatus()== PurchaseStatus::EDITION_STATUS){
            $purchaseItem->setDispatchQuantity($content->request_quantity);
        }else{
            $purchaseItem->setDispatchQuantity($content->dispatch_quantity);
        }
        
        $errors = $validator->validate($purchaseItem);
        
        $status = 'success';
        $code= 200;
        
        if(count($errors) == 0){
            $em->flush();
        }else{
            $messageError = (array)$errors;
            $status = 'error';
            $code = 500;
        }
        
        $response = [
            'status' => $status,
            'code' => $code,
            'message' => $code == 200 ? 'Item actualizado' : $messageError,
        ];
        
        if($code == 200){
            $response['data'] = $purchaseItem;
        }
        
        return new Response($serializer->serialize($response, 'json'), $code);
    }
    
    /**
     * @Route("/{id}/item/delete/{itemId}", name="purchase_item_delete", methods="GET", defaults={"_format":"json"})
     */
    public function delete(PurchaseItemRepository $purchaseItemRepository, $id, $itemId){
        
        $serializer = $this->get('jms_serializer');
        $em = $this->getDoctrine()->getManager();
        
        $purchaseItem = $purchaseItemRepository->find($itemId);  
        
        $status = 'success';
        $code= 200;
        
        try{
            $em->remove($purchaseItem);
            $em->flush();
        } catch (Exception $e){
            $messageError = 'Error de persistencia';
            $status = 'error';
            $code = 500;
        }
        
        $response = [
            'status' => $status,
            'code' => $code,
            'message' => $code == 200 ? 'Item eliminado' : $messageError,
        ];
        
        return new Response($serializer->serialize($response, 'json'), $code);
    }
}
