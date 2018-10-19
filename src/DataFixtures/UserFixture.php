<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
Use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class UserFixture extends Fixture implements DependentFixtureInterface
{
    private $encoder; 
    
    public function __construct(UserPasswordEncoderInterface $encoder) {
        $this->encoder = $encoder;
    }
    
    public function getDependencies(): array {
        return array(
            CategoryFixture::class,
            ProductFixture::class,
        );
    }

    public function load(ObjectManager $manager)
    {
        //Matriz
        
        $user = new User();
        $user->setUsername('admin');
        $user->setName('admin');
        $user->setEmail('admin@semilladelprogreso.fin.ec');
        $password = $this->encoder->encodePassword($user, 'admin');
        $user->setPassword($password);
        $user->setActive(true);
        $user->setRoles(['ROLE_ADMIN']);
        
        $this->addReference('user-0', $user);
        $manager->persist($user);
        
        $user = new User();
        $user->setUsername('xrey');
        $user->setName('Ximena Rey Granda');
        $user->setEmail('gerencia@semilladelprogreso.fin.ec');
        $password = $this->encoder->encodePassword($user, 'xrey');
        $user->setPassword($password);
        $user->setActive(true);
        $user->setRoles(['ROLE_RESPONSE']);
        
        $this->addReference('user-1', $user);
        $manager->persist($user);
        
        $user = new User();
        $user->setUsername('msordonez');
        $user->setName('Maria Stefania Ordoñez');
        $user->setEmail('msordonez@semilladelprogreso.fin.ec');
        $password = $this->encoder->encodePassword($user, 'msordonez');
        $user->setPassword($password);
        $user->setActive(true);
        
        $this->addReference('user-2', $user);
        $manager->persist($user);
        
        $user = new User();
        $user->setUsername('lgualan');
        $user->setName('Luz del Carmen Gualan');
        $user->setEmail('lgualan@semilladelprogreso.fin.ec');
        $password = $this->encoder->encodePassword($user, 'lgualan');
        $user->setPassword($password);
        $user->setActive(true);
        
        $this->addReference('user-3', $user);
        $manager->persist($user);
        
        $user = new User();
        $user->setUsername('jsarango');
        $user->setName('Jumanti Sarango');
        $user->setEmail('jsarango@semilladelprogreso.fin.ec');
        $password = $this->encoder->encodePassword($user, 'jsarango');
        $user->setPassword($password);
        $user->setActive(true);
        
        $this->addReference('user-4', $user);
        $manager->persist($user);
        
        $user = new User();
        $user->setUsername('lordonez');
        $user->setName('Luis Enrique Ordoñez');
        $user->setEmail('lordonez@semilladelprogreso.fin.ec');
        $password = $this->encoder->encodePassword($user, 'lordonez');
        $user->setPassword($password);
        $user->setActive(true);
        $user->setRoles(['ROLE_RESPONSE']);
        
        $this->addReference('user-5', $user);
        $manager->persist($user);

        $user = new User();
        $user->setUsername('mordonez');
        $user->setName('Maria del Cisne Ordoñez');
        $user->setEmail('mordonez@semilladelprogreso.fin.ec');
        $password = $this->encoder->encodePassword($user, 'mordonez');
        $user->setPassword($password);
        $user->setActive(true);
        
        $this->addReference('user-6', $user);
        $manager->persist($user);

        $user = new User();
        $user->setUsername('bgualan');
        $user->setName('Bertha Liliana Gualan');
        $user->setEmail('bgualan@semilladelprogreso.fin.ec');
        $password = $this->encoder->encodePassword($user, 'bgualan');
        $user->setPassword($password);
        $user->setActive(true);
        
        $this->addReference('user-7', $user);
        $manager->persist($user);

        $user = new User();
        $user->setUsername('pavila');
        $user->setName('Paola Avila');
        $user->setEmail('pavila@semilladelprogreso.fin.ec');
        $password = $this->encoder->encodePassword($user, 'pavila');
        $user->setPassword($password);
        $user->setActive(true);
        
        $this->addReference('user-8', $user);
        $manager->persist($user);

        $user = new User();
        $user->setUsername('mgonzalez');
        $user->setName('Maria Gonzalez');
        $user->setEmail('mgonzalez@semilladelprogreso.fin.ec');
        $password = $this->encoder->encodePassword($user, 'mgonzalez');
        $user->setPassword($password);
        $user->setActive(true);
        
        $this->addReference('user-9', $user);
        $manager->persist($user);
        
        //Agencia Loja
        
        $user = new User();
        $user->setUsername('rmorocho');
        $user->setName('Rosa Morocho');
        $user->setEmail('rmorocho@semilladelprogreso.fin.ec');
        $password = $this->encoder->encodePassword($user, 'rmorocho');
        $user->setPassword($password);
        $user->setActive(true);
        
        $this->addReference('user-10', $user);
        $manager->persist($user);
        
        $user = new User();
        $user->setUsername('htene');
        $user->setName('Hugo Tene');
        $user->setEmail('htene@semilladelprogreso.fin.ec');
        $password = $this->encoder->encodePassword($user, 'htene');
        $user->setPassword($password);
        $user->setActive(true);
        
        $this->addReference('user-11', $user);
        $manager->persist($user);
        
        $user = new User();
        $user->setUsername('svasquez');
        $user->setName('Santiago Vasquez');
        $user->setEmail('svasquez@semilladelprogreso.fin.ec');
        $password = $this->encoder->encodePassword($user, 'svasquez');
        $user->setPassword($password);
        $user->setActive(true);
        
        $this->addReference('user-12', $user);
        $manager->persist($user);
        
        //Agencia Zamora
        
        $user = new User();
        $user->setUsername('nmaldonado');
        $user->setName('Narcisa Maldonado');
        $user->setEmail('nmaldonado@semilladelprogreso.fin.ec');
        $password = $this->encoder->encodePassword($user, 'nmaldonado');
        $user->setPassword($password);
        $user->setActive(true);
        
        $this->addReference('user-13', $user);
        $manager->persist($user);
        
        $user = new User();
        $user->setUsername('jarmijos');
        $user->setName('Jheisson Armijos');
        $user->setEmail('jarmijos@semilladelprogreso.fin.ec');
        $password = $this->encoder->encodePassword($user, 'jarmijos');
        $user->setPassword($password);
        $user->setActive(true);
        
        $this->addReference('user-14', $user);
        $manager->persist($user);
        
        //Agencia Yantzaza
        
        $user = new User();
        $user->setUsername('wjapon');
        $user->setName('Wilman Japon');
        $user->setEmail('wjapon@semilladelprogreso.fin.ec');
        $password = $this->encoder->encodePassword($user, 'wjapon');
        $user->setPassword($password);
        $user->setActive(true);
        
        $this->addReference('user-15', $user);
        $manager->persist($user);
        
        $user = new User();
        $user->setUsername('fmacas');
        $user->setName('Fanny Macas');
        $user->setEmail('fmacas@semilladelprogreso.fin.ec');
        $password = $this->encoder->encodePassword($user, 'fmacas');
        $user->setPassword($password);
        $user->setActive(true);
        
        $this->addReference('user-16', $user);
        $manager->persist($user);
        
        //Agencia Yacuambi
        
        $user = new User();
        $user->setUsername('mcango');
        $user->setName('Meysi Cango');
        $user->setEmail('mcango@semilladelprogreso.fin.ec');
        $password = $this->encoder->encodePassword($user, 'mcango');
        $user->setPassword($password);
        $user->setActive(true);
        
        $this->addReference('user-17', $user);
        $manager->persist($user);
        
        $user = new User();
        $user->setUsername('ccartuche');
        $user->setName('Celia Cartuche');
        $user->setEmail('ccartuche@semilladelprogreso.fin.ec');
        $password = $this->encoder->encodePassword($user, 'ccartuche');
        $user->setPassword($password);
        $user->setActive(true);
        
        $this->addReference('user-18', $user);
        $manager->persist($user);
        
        //Agencia Guayzimi
        
        $user = new User();
        $user->setUsername('jbuestan');
        $user->setName('Jessica Buestan');
        $user->setEmail('jbuestan@semilladelprogreso.fin.ec');
        $password = $this->encoder->encodePassword($user, 'jbuestan');
        $user->setPassword($password);
        $user->setActive(true);
        
        $this->addReference('user-19', $user);
        $manager->persist($user);
        
        $user = new User();
        $user->setUsername('ejimenez');
        $user->setName('Enith Jimenez');
        $user->setEmail('ejimenez@semilladelprogreso.fin.ec');
        $password = $this->encoder->encodePassword($user, 'ejimenez');
        $user->setPassword($password);
        $user->setActive(true);
        
        $this->addReference('user-20', $user);
        $manager->persist($user);
        
        //Agencia Quito
        
        $user = new User();
        $user->setUsername('mlima');
        $user->setName('Maria Esperanza Lima');
        $user->setEmail('mlima@semilladelprogreso.fin.ec');
        $password = $this->encoder->encodePassword($user, 'mlima');
        $user->setPassword($password);
        $user->setActive(true);
        
        $this->addReference('user-21', $user);
        $manager->persist($user);
        
        //Agencia Manu
        
        $user = new User();
        $user->setUsername('ssaca');
        $user->setName('Sara Saca');
        $user->setEmail('ssaca@semilladelprogreso.fin.ec');
        $password = $this->encoder->encodePassword($user, 'ssaca');
        $user->setPassword($password);
        $user->setActive(true);
        
        $this->addReference('user-22', $user);
        $manager->persist($user);
        
        //Usuario Matriz Sistemas
        
        $user = new User();
        $user->setUsername('jortega');
        $user->setName('Jose Claudio Ortega');
        $user->setEmail('sistemas@semilladelprogreso.fin.ec');
        $password = $this->encoder->encodePassword($user, 'jortega');
        $user->setPassword($password);
        $user->setActive(true);
        
        $this->addReference('user-23', $user);
        $manager->persist($user);
        
        $manager->flush();
    }
}