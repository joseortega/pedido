<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

Use App\Entity\Product;
use App\DataFixtures\CategoryFixture;



class ProductFixture extends Fixture implements DependentFixtureInterface
{
    public function getDependencies(): array {
        return array(CategoryFixture::class,
               );
    }
    
    public function load(ObjectManager $manager)
    {
        $product = new Product();
        $product->setName('Toner Impresora Samsung Xpress M2020-M2022-M2070-M2071');
        $product->setDescription('Toner Max Color MCL-111A Impresora Samsung Xpress M2020-M2022-M2070-M2071 1000 pag.');
        $product->setCategory($this->getReference('toners'));
        $this->addReference('product-0', $product);
        $manager->persist($product);
        
        $product = new Product();
        $product->setName('Toner Impresora Samsung ML-2160/ML-2161/2162/2163/2165/2168/3401/CSX-3400/05');
        $product->setDescription('Toner Max Color MLT-1015 Toner Impresora Samsung ML-2160/ML-2161/2162/2163/2165/2168/3401/CSX-3400/05 1500 pag.');
        $product->setCategory($this->getReference('toners'));
        $this->addReference('product-1', $product);
        $manager->persist($product);
        
        
        $product = new Product();
        $product->setName('Cartucho de Cinta Epson fx-890');
        $product->setDescription('Cartucho de Cinta Epson fx-890 CODE S015329');
        $product->setCategory($this->getReference('cintas'));
        $this->addReference('product-2', $product);
        $manager->persist($product);
        
        $product = new Product();
        $product->setName('Resma de papel tamaño A4');
        $product->setDescription('Resmas de palel de tamaño A4');
        $product->setCategory($this->getReference('papel'));
        $this->addReference('product-3', $product);
        $manager->persist($product);
        
        $product = new Product();
        $product->setName('Esferos Bic');
        $product->setDescription('Esfereros Bic por unidades');
        $product->setCategory($this->getReference('esfero'));
        $this->addReference('product-4', $product);
        $manager->persist($product);
        

        $manager->flush();
    }
}
