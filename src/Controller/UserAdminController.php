<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;
Use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserAdminController extends BaseAdminController
{
    public function __construct(UserPasswordEncoderInterface $encoder) {
        $this->encoder = $encoder;
    }
    
    public function createEntity($entity){    
       
       $entity->setPassword($this->encoder->encodePassword($entity, $entity->getPassword()));
       
        parent::createEntity($entity);
    }
    
    public function updateEntity($entity){    
       if($entity->getPlainPassword()){
           $entity->setPassword($this->encoder->encodePassword($entity, $entity->getPlainPassword()));
       }
       
        parent::updateEntity($entity);
    }
}