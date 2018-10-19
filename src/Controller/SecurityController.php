<?php


namespace App\Controller;

use App\Entity\Board;
use App\Entity\Task;
use App\Entity\User;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/api")
 */
class SecurityController extends FOSRestController
{
    /**
     * @Route("/login", name="user_login", methods="POST")
     *
     * @SWG\Response(
     *     response=200,
     *     description="User was logged in successfully"
     * )
     *
     * @SWG\Response(
     *     response=500,
     *     description="User was not logged in successfully"
     * )
     * 
     * @SWG\Tag(name="User")
     */
    public function login(Request $request) {}
    
    /**
     * @Route("/register", name="user_register", methods="POST", defaults={"_format":"json"})
     *
     * @SWG\Response(
     *     response=201,
     *     description="User was successfully registered"
     * )
     *
     * @SWG\Response(
     *     response=500,
     *     description="User was not successfully registered"
     * )
     *
     * @SWG\Parameter(
     *     name="json",
     *     in="body",
     *     type="json",
     *     description="{}",
     *     schema={}
     * )
     *
     * @SWG\Tag(name="User")
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $encoder, ValidatorInterface $validator) {
        $serializer = $this->get('jms_serializer');
        $em = $this->getDoctrine()->getManager();
        
        $parameter = json_decode($request->request->get('json'));
        
        $name = $parameter->name;
        $email = $parameter->email;
        $username = $parameter->username;
        $password = $parameter->password;

        $user = new User();
        $user->setName($name);
        $user->setEmail($email);
        $user->setUsername($username);
        $user->setActive(true);
        $user->setPlainPassword($password);
        $user->setPassword($encoder->encodePassword($user, $password));
            
        $errors = $validator->validate($user);
        
        $status = 'success';
        $code= 200;
         
        if(count($errors) == 0){
            $em->persist($user);
            $em->flush();

        }else{
            $message = (array)$errors;
            $status = 'error';
            $code = 500;
            
        }

        $response = [
            'status' => $status,
            'code' => $code,
            'data' => $code == 200 ? $user : $message,
        ];

        return new Response($serializer->serialize($response, 'json'));
    }
}
