<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Category;

class CategoryFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $category = new Category();
        $category->setName('Toners');
        $this->addReference('toners', $category);
        $manager->persist($category);
        
        $category = new Category();
        $category->setName('Cintas');
        $this->addReference('cintas', $category);
        $manager->persist($category);
        
        $category = new Category();
        $category->setName('Papel');
        $this->addReference('papel', $category);
        $manager->persist($category);
        
        $category = new Category();
        $category->setName('Esferos');
        $this->addReference('esfero', $category);
        $manager->persist($category);

        $manager->flush();
    }
}
