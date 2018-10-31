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
        $category->setName('Toner');
        $this->addReference('toner', $category);
        $manager->persist($category);
        
        $category = new Category();
        $category->setName('Cartucho de Cinta');
        $this->addReference('cartucho-cinta', $category);
        $manager->persist($category);
        
        $category = new Category();
        $category->setName('Papel');
        $this->addReference('papel', $category);
        $manager->persist($category);
        
        $category = new Category();
        $category->setName('Esferográfico');
        $this->addReference('esferografico', $category);
        $manager->persist($category);
        
        $category = new Category();
        $category->setName('Sobre manila');
        $this->addReference('sobre-manila', $category);
        $manager->persist($category);
        
        $category = new Category();
        $category->setName('Estuche');
        $this->addReference('estuche', $category);
        $manager->persist($category);
        
        $category = new Category();
        $category->setName('Archivador');
        $this->addReference('archivador', $category);
        $manager->persist($category);
        
        $category = new Category();
        $category->setName('Carpeta');
        $this->addReference('carpeta', $category);
        $manager->persist($category);
        
        $category = new Category();
        $category->setName('Vincha para carpetas');
        $this->addReference('vincha', $category);
        $manager->persist($category);
        
        $category = new Category();
        $category->setName('Lapiz');
        $this->addReference('lapiz', $category);
        $manager->persist($category);
        
        $category = new Category();
        $category->setName('Resaltador');
        $this->addReference('resaltador', $category);
        $manager->persist($category);
        
        $category = new Category();
        $category->setName('Borrador');
        $this->addReference('borrador', $category);
        $manager->persist($category);
        
        $category = new Category();
        $category->setName('Goma');
        $this->addReference('goma', $category);
        $manager->persist($category);
        
        $category = new Category();
        $category->setName('Clip');
        $this->addReference('clip', $category);
        $manager->persist($category);
        
        $category = new Category();
        $category->setName('Almohadilla');
        $this->addReference('almohadilla', $category);
        $manager->persist($category);
        
        $category = new Category();
        $category->setName('Tinta');
        $this->addReference('tinta', $category);
        $manager->persist($category);
        
        $category = new Category();
        $category->setName('Cera');
        $this->addReference('cera', $category);
        $manager->persist($category);
        
        $category = new Category();
        $category->setName('Liga');
        $this->addReference('liga', $category);
        $manager->persist($category);
        
        $category = new Category();
        $category->setName('Cinta');
        $this->addReference('cinta', $category);
        $manager->persist($category);
        
        $category = new Category();
        $category->setName('Estilete');
        $this->addReference('estilete', $category);
        $manager->persist($category);
        
        $category = new Category();
        $category->setName('Tijera');
        $this->addReference('tijera', $category);
        $manager->persist($category);
        
        $category = new Category();
        $category->setName('Perforadora');
        $this->addReference('perforadora', $category);
        $manager->persist($category);
        
        $category = new Category();
        $category->setName('Engrapadora');
        $this->addReference('engrapadora', $category);
        $manager->persist($category);

        $category = new Category();
        $category->setName('Grapa');
        $this->addReference('grapa', $category);
        $manager->persist($category);
        
        $category = new Category();
        $category->setName('Accesocrio de limpieza');
        $this->addReference('accesorio-limpieza', $category);
        $manager->persist($category);


        $manager->flush();
    }
}
