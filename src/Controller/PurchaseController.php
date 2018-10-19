<?php

namespace App\Controller;

use App\Entity\Purchase;
use App\Entity\Office;
use App\Entity\PurchaseStatus;
use App\Form\CategoryType;
use App\Repository\PurchaseRepository;
use App\Repository\OfficeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/api")
 */
class PurchaseController extends Controller
{
    /**
     * @Route("/v1/purchase", name="purchase", methods="GET", defaults={"_format":"json"})
     */
    public function index(PurchaseRepository $purchaseRepository, Request $request,PaginatorInterface $paginator){
        $serializer = $this->get('jms_serializer');

        $query = $purchaseRepository->findByUserQuery($this->getUser());
        
        
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );
        
        return new Response($serializer->serialize($pagination, 'json'));  
    }
    
    /**
     * @Route("/v1/purchase-request", name="purchase-list-request", methods="GET", defaults={"_format":"json"})
     */
    public function RequestList(PurchaseRepository $purchaseRepository, Request $request,PaginatorInterface $paginator){
        $serializer = $this->get('jms_serializer');

        $query = $purchaseRepository->findRequestQuery();

        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );
        
        return new Response($serializer->serialize($pagination, 'json'));  
    }
    
    /**
     * @Route("/v1/purchase/{id}.{_format}", name="purchase-detail", methods="GET", defaults={"_format":"json"})
     */
    public function detail(PurchaseRepository $purchaseRepository, $id){
        $serializer = $this->get('jms_serializer');
        
        $purchase = $purchaseRepository->findOneBy([
            'id'=>$id
        ]);
        
        $status = 'success';
        $code= 200;
        
        if (!$purchase) { 
            $messageError = 'Purchase does not exist';
            $status = 'error';
            $code = 500;
        }
        
        $response = [
            'status' => $status,
            'code' => $code,
            'message' => $code == 200 ? 'Success' : $messageError,
        ];
        
        if($code == 200){
            $response['data'] = $purchase;
        }
        
        return new Response($serializer->serialize($response, 'json'), $code);  
    }
    
    /**
     * @Route("/v1/purchase/create", name="purchase_create", methods="POST", defaults={"_format":"json"})
     */
    public function create(Request $request, ValidatorInterface $validator, OfficeRepository $officeRepository){
        $serializer = $this->get('jms_serializer');
        $em = $this->getDoctrine()->getManager();
        
        $content = json_decode($request->getContent());
        
        $office = $officeRepository->find($content->office->id);
        
        $purchase = new Purchase();
        
        $purchase->setCreatedAt(new \DateTime());
        $purchase->setOffice($office);
        $purchase->setUser($this->getUser());
        
        $errors = $validator->validate($purchase);
        
        $status = 'success';
        $code= 200;
        
        if(count($errors) == 0){
            $em->persist($purchase);
            $em->flush();
        }else{
            $messageError = (array)$errors;
            $status = 'error';
            $code = 500;
        }
        
        $response = [
            'status' => $status,
            'code' => $code,
            'message' => $code == 200 ? 'Solicitud registrada' : $messageError,
        ];
        
        if($code == 200){
            $response['data'] = $purchase;
        }
        
        return new Response($serializer->serialize($response, 'json'), $code);
        
    }
    
    /**
     * @Route("/v1/purchase/update/{id}", name="purchase_update", methods="POST", defaults={"_format":"json"})
     */
    public function update(Request $request, ValidatorInterface $validator, PurchaseRepository $purchaseRepository, $id, OfficeRepository $officeRepository){
        $serializer = $this->get('jms_serializer');
        $em = $this->getDoctrine()->getManager();
        
        $purchase = $purchaseRepository->find($id);
        
        $content = json_decode($request->getContent());
        $office = $officeRepository->find($content->office->id);
        
        $purchase->setOffice($office);
        $purchase->setUser($this->getUser());
        
        $errors = $validator->validate($purchase);
        
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
            'message' => $code == 200 ? 'Actualización Realizada' : $messageError,
        ];
        
        if($code == 200){
            $response['data'] = $purchase;
        }
        
        return new Response($serializer->serialize($response, 'json'), $code);
    }
    
    /**
     * @Route("/v1/purchase/request/{id}.{_format}", name="purchase-request", methods="GET", defaults={"_format":"json"})
     */
    public function requestPurchase($id, PurchaseRepository $purchaseRepository, \Swift_Mailer $mailer){
        $serializer = $this->get('jms_serializer');
        $em = $this->getDoctrine()->getManager();
        
        $purchase = $purchaseRepository->find($id);
        
        $status = 'success';
        $code= 200;
        
        if ($purchase && count($purchase->getPurchaseItems()) > 0) { 
            
            $purchase->setStatus(PurchaseStatus::REQUEST_STATUS);
            $purchase->setRequestDate(new \DateTime('now'));
            $em->flush();

            $this->sendMail($mailer, $purchase);   
             
        }else{
            $messageError = 'Pedido no existe o no tiene ningun item asignado';
            $status = 'error';
            $code = 500;
        }
        
        $response = [
            'status' => $status,
            'code' => $code,
            'message' => $code == 200 ? 'Peticion Enviada' : $messageError,
        ];
        
        if($code == 200){
            $response['data'] = $purchase;
        }

        
        return new Response($serializer->serialize($response, 'json'), $code);
    }
    
    /**
     * @Route("/v1/purchase/dispatch/{id}.{_format}", name="purchase-dispatch", methods="GET", defaults={"_format":"json"})
     */
    public function dispatchPurchase($id, PurchaseRepository $purchaseRepository){
        $serializer = $this->get('jms_serializer');
        $em = $this->getDoctrine()->getManager();
        
        $purchase = $purchaseRepository->find($id);
        
        $status = 'success';
        $code= 200;
        
        if ($purchase) { 
            $purchase->setStatus(PurchaseStatus::DISPATCHED_STATUS);
            $purchase->setDispatchDate(new \DateTime('now'));
            $purchase->setUserResponse($this->getUser());
            $em->flush();
        }else{
            $messageError = 'Purchase does not exist';
            $status = 'error';
            $code = 500;
        }
        
        $response = [
            'status' => $status,
            'code' => $code,
            'message' => $code == 200 ? 'Despacho registrado' : $messageError,
        ];
        
        if($code == 200){
            $response['data'] = $purchase;
        }
        
        return new Response($serializer->serialize($response, 'json'), $code);
    }
    
    
    /**
     * @Route("/v1/purchase/cancel/{id}.{_format}", name="purchase-cancel", methods="GET", defaults={"_format":"json"})
     */
    public function cancelPurchase($id, PurchaseRepository $purchaseRepository){
        $serializer = $this->get('jms_serializer');
        $em = $this->getDoctrine()->getManager();
        
        $purchase = $purchaseRepository->find($id);
        
        $status = 'success';
        $code= 200;
        
        if ($purchase) { 
            $purchase->setStatus(PurchaseStatus::CANCELED_STATUS);
            $purchase->setCanceledDate(new \DateTime('now'));
            $purchase->setUserResponse($this->getUser());
            $this->PurchaseItemsDefaultValues($purchase);
            $em->flush();
        }else{
            $messageError = 'Purchase does not exist';
            $status = 'error';
            $code = 500;
        }
        
        $response = [
            'status' => $status,
            'code' => $code,
            'message' => $code == 200 ? 'Pedido Anulado' : $messageError,
        ];
        
        if($code == 200){
            $response['data'] = $purchase;
        }
        
        return new Response($serializer->serialize($response, 'json'), $code);

    }
    
    
    /**
     * @Route("/v1/purchase/delete/{id}.{_format}", name="purchase-delete", methods="GET", defaults={"_format":"json"})
     */
    public function deletePurchase($id, PurchaseRepository $purchaseRepository){
        $serializer = $this->get('jms_serializer');
        $em = $this->getDoctrine()->getManager();
        
        $purchase = $purchaseRepository->find($id);
        
        $status = 'success';
        $code= 200;
        
        if ($purchase && $purchase->getStatus()== 'edicion') { 
            $em->remove($purchase);
            $em->flush();
        }else{
            $messageError = 'Order does not exist or is already sent or canceled';
            $status = 'error';
            $code = 500;
        }
        
        $response = [
            'status' => $status,
            'code' => $code,
            'message' => $code == 200 ? 'Solicitud Eliminada' : $messageError,
        ];
        
        return new Response($serializer->serialize($response, 'json'), $code);

    }
    
    public function sendMail($mailer, Purchase $purchase){
        $message = (new \Swift_Message('Pedido en Solicitud de: '.$purchase->getUser()->getUsername()))
            ->setFrom('sistemas@semilladelprogreso.fin.ec')
            ->setTo('sistemas@semilladelprogreso.fin.ec')
            ->setBody('Revise Su App de Pedidos tiene una solicitud Pendiente de: '.$purchase->getUser()->getName().' Agencia: '. $purchase->getOffice()->getName());

        $mailer->send($message);
    }
    
    /**
     * En caso que se anule un pedido setear a los items del pedido campo: deliveredQuantity in 0
     * 
     * @param Purchase $purchase
     */
    private function PurchaseItemsDefaultValues(Purchase $purchase){
       
        foreach($purchase->getPurchaseItems() as $item){
            $item->setDispatchQuantity(0);
        }
    }
}
