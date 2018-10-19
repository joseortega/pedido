<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Office;

class OfficeFixture extends Fixture
{
    
    public function load(ObjectManager $manager)
    {
        $office = new Office();
        $office->setName('Matriz');
        $this->addReference('office-0', $office);
        $manager->persist($office);
        
        
        $office = new Office();
        $office->setName('Loja');
        $this->addReference('office-1', $office);
        $manager->persist($office);
        
        $office = new Office();
        $office->setName('Zamora');
        $this->addReference('office-2', $office);
        $manager->persist($office);
        
        $office = new Office();
        $office->setName('Yacuambi');
        $this->addReference('office-3', $office);
        $manager->persist($office);
        
        $office = new Office();
        $office->setName('Yantzaza');
        $this->addReference('office-4', $office);
        $manager->persist($office);
        
        $office = new Office();
        $office->setName('Manu');
        $this->addReference('office-5', $office);
        $manager->persist($office);
        
        $office = new Office();
        $office->setName('Quito');
        $this->addReference('office-6', $office);
        $manager->persist($office);
        
        $office = new Office();
        $office->setName('Guayzimi');
        $this->addReference('office-7', $office);
        $manager->persist($office);
        
        $manager->flush();
    }
}
