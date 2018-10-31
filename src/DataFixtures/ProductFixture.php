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
        $product->setCategory($this->getReference('toner'));
        $this->addReference('product-0', $product);
        $manager->persist($product);
        
        $product = new Product();
        $product->setName('Toner Impresora Samsung ML-2160/ML-2161/2162/2163/2165/2168/3401/CSX-3400/05');
        $product->setDescription('Toner Max Color MLT-1015 Toner Impresora Samsung ML-2160/ML-2161/2162/2163/2165/2168/3401/CSX-3400/05 1500 pag.');
        $product->setCategory($this->getReference('toner'));
        $this->addReference('product-1', $product);
        $manager->persist($product);
        
        $product = new Product();
        $product->setName('Toner Impresora Xerox Phaser 3320 series');
        $product->setDescription('Toner Impresora Xerox Phaser 3320 series 11000 pag.');
        $product->setCategory($this->getReference('toner'));
        $this->addReference('product-2', $product);
        $manager->persist($product);
        
        
        
        
        $product = new Product();
        $product->setName('Cartucho de Cinta Epson Fx-890/FX-890II');
        $product->setDescription('Cartucho de Cinta Epson Fx-890 CODE S015329');
        $product->setCategory($this->getReference('cartucho-cinta'));
        $this->addReference('product-3', $product);
        $manager->persist($product);
        
        $product = new Product();
        $product->setName('Cartucho de Cinta Epson Fx-300');
        $product->setDescription('Cartucho de Cinta Epson Fx-300/300+/300+II');
        $product->setCategory($this->getReference('cartucho-cinta'));
        $this->addReference('product-4', $product);
        $manager->persist($product);
        
        
        
        $product = new Product();
        $product->setName('Resma de papel tamaño A4');
        $product->setDescription('Resmas de palel de tamaño A4 para copia e impresión');
        $product->setCategory($this->getReference('papel'));
        $this->addReference('product-5', $product);
        $manager->persist($product);
        
        $product = new Product();
        $product->setName('Papel Carbon A4');
        $product->setDescription('Papel Carbon A4');
        $product->setCategory($this->getReference('papel'));
        $this->addReference('product-6', $product);
        $manager->persist($product);
        
        $product = new Product();
        $product->setName('Papel menbretado A4');
        $product->setDescription('Papel menbretado A4');
        $product->setCategory($this->getReference('papel'));
        $this->addReference('product-7', $product);
        $manager->persist($product);
        
        $product = new Product();
        $product->setName('Papel menbretado A5');
        $product->setDescription('Papel menbretado A5');
        $product->setCategory($this->getReference('papel'));
        $this->addReference('product-8', $product);
        $manager->persist($product);
        
        $product = new Product();
        $product->setName('Papel menbretado 1/4 de hoja A4');
        $product->setDescription('Papel menbretado 1/4 de hoja A4');
        $product->setCategory($this->getReference('papel'));
        $this->addReference('product-9', $product);
        $manager->persist($product);
        
        $product = new Product();
        $product->setName('Papeleta de retiro');
        $product->setDescription('Papeleta de retiro');
        $product->setCategory($this->getReference('papel'));
        $this->addReference('product-10', $product);
        $manager->persist($product);
        
        $product = new Product();
        $product->setName('Papeleta de depósito');
        $product->setDescription('Papeleta de depósito');
        $product->setCategory($this->getReference('papel'));
        $this->addReference('product-11', $product);
        $manager->persist($product);
        
        $product = new Product();
        $product->setName('Libretas o Cartolas');
        $product->setDescription('Libretas o Cartolas');
        $product->setCategory($this->getReference('papel'));
        $this->addReference('product-12', $product);
        $manager->persist($product);
        
        $product = new Product();
        $product->setName('Sobre manila para papel A4');
        $product->setDescription('Sobre manila para papel A4');
        $product->setCategory($this->getReference('sobre-manila'));
        $this->addReference('product-13', $product);
        $manager->persist($product);
        
        $product = new Product();
        $product->setName('Sobre manila papel A5');
        $product->setDescription('Sobre manila F5 para papel A5');
        $product->setCategory($this->getReference('sobre-manila'));
        $this->addReference('product-14', $product);
        $manager->persist($product);
        
        $product = new Product();
        $product->setName('Estuche para libretas o cartolas');
        $product->setDescription('Estuche para libretas o cartolas');
        $product->setCategory($this->getReference('estuche'));
        $this->addReference('product-15', $product);
        $manager->persist($product);
        
        
        
        $product = new Product();
        $product->setName('Archivadores para papel A4');
        $product->setDescription('Archivadores para papel A4');
        $product->setCategory($this->getReference('archivador'));
        $this->addReference('product-16', $product);
        $manager->persist($product);
        
        $product = new Product();
        $product->setName('Archivadores para papel A5');
        $product->setDescription('Archivadores para papel A5');
        $product->setCategory($this->getReference('archivador'));
        $this->addReference('product-17', $product);
        $manager->persist($product);
        
        $product = new Product();
        $product->setName('Carpetas para papel A4');
        $product->setDescription('Carpetas para papel A4');
        $product->setCategory($this->getReference('carpeta'));
        $this->addReference('product-18', $product);
        $manager->persist($product);
        
        $product = new Product();
        $product->setName('Carpetas colgantes');
        $product->setDescription('Carpetas colgantes para archivador');
        $product->setCategory($this->getReference('carpeta'));
        $this->addReference('product-19', $product);
        $manager->persist($product);
        
        $product = new Product();
        $product->setName('Vinchas para carpetas');
        $product->setDescription('Vinchas para carpeta');
        $product->setCategory($this->getReference('vincha'));
        $this->addReference('product-20', $product);
        $manager->persist($product);
        
      
        
        
        $product = new Product();
        $product->setName('Esferográfico Bic, Bolígrafo');
        $product->setDescription('Esferográfico Bic por unidades');
        $product->setCategory($this->getReference('esferografico'));
        $this->addReference('product-21', $product);
        $manager->persist($product);
        
        $product = new Product();
        $product->setName('Lapiz mongol');
        $product->setDescription('Lapiz mongol');
        $product->setCategory($this->getReference('lapiz'));
        $this->addReference('product-22', $product);
        $manager->persist($product);
 
        $product = new Product();
        $product->setName('Resaltador color verde');
        $product->setDescription('Resaltador color verde');
        $product->setCategory($this->getReference('resaltador'));
        $this->addReference('product-23', $product);
        $manager->persist($product);
        
        $product = new Product();
        $product->setName('Resaltador color rozado');
        $product->setDescription('Resaltador color rozado');
        $product->setCategory($this->getReference('resaltador'));
        $this->addReference('product-24', $product);
        $manager->persist($product);
        
        $product = new Product();
        $product->setName('Resaltador color azul');
        $product->setDescription('Resaltador color azul');
        $product->setCategory($this->getReference('resaltador'));
        $this->addReference('product-25', $product);
        $manager->persist($product);
        
        
        $product = new Product();
        $product->setName('Borrador de queso');
        $product->setDescription('Borrador de queso');
        $product->setCategory($this->getReference('borrador'));
        $this->addReference('product-26', $product);
        $manager->persist($product);
        
        $product = new Product();
        $product->setName('Goma en barra');
        $product->setDescription('Goma en barra 21g');
        $product->setCategory($this->getReference('goma'));
        $this->addReference('product-27', $product);
        $manager->persist($product);
        
        $product = new Product();
        $product->setName('Clips 1.0 MM');
        $product->setDescription('Clips 1.0 MM 9-32');
        $product->setCategory($this->getReference('clip'));
        $this->addReference('product-28', $product);
        $manager->persist($product);
        
        $product = new Product();
        $product->setName('Clips mariposa N°1');
        $product->setDescription('Clips mariposa N°1');
        $product->setCategory($this->getReference('clip'));
        $this->addReference('product-29', $product);
        $manager->persist($product);
        
        
        
        $product = new Product();
        $product->setName('Almohadilla dactilar');
        $product->setDescription('Almohadilla dactilar');
        $product->setCategory($this->getReference('almohadilla'));
        $this->addReference('product-30', $product);
        $manager->persist($product);
        
        $product = new Product();
        $product->setName('Tinta para sellos');
        $product->setDescription('Tinta para sellos');
        $product->setCategory($this->getReference('tinta'));
        $this->addReference('product-31', $product);
        $manager->persist($product);
        
        
        $product = new Product();
        $product->setName('Cera para contar billetes');
        $product->setDescription('era para contar billetes');
        $product->setCategory($this->getReference('cera'));
        $this->addReference('product-32', $product);
        $manager->persist($product);
        
        $product = new Product();
        $product->setName('Ligas elasticas de colores x 250 Unidas');
        $product->setDescription('Ligas elasticas de colores x 250 Unidas');
        $product->setCategory($this->getReference('liga'));
        $this->addReference('product-33', $product);
        $manager->persist($product);
        
        
        $product = new Product();
        $product->setName('Cintas de embalaje');
        $product->setDescription('Cintas de embalaje');
        $product->setCategory($this->getReference('cinta'));
        $this->addReference('product-34', $product);
        $manager->persist($product);
        
        $product = new Product();
        $product->setName('Estilete');
        $product->setDescription('Estilete');
        $product->setCategory($this->getReference('estilete'));
        $this->addReference('product-35', $product);
        $manager->persist($product);
        
        $product = new Product();
        $product->setName('Tijera');
        $product->setDescription('Tijera');
        $product->setCategory($this->getReference('tijera'));
        $this->addReference('product-36', $product);
        $manager->persist($product);
        
        
        
        $product = new Product();
        $product->setName('Perforadora de papel');
        $product->setDescription('Perforadora de papel');
        $product->setCategory($this->getReference('perforadora'));
        $this->addReference('product-37', $product);
        $manager->persist($product);
        
        $product = new Product();
        $product->setName('Engrapadora M-764');
        $product->setDescription('Engrapadora M-764');
        $product->setCategory($this->getReference('engrapadora'));
        $this->addReference('product-38', $product);
        $manager->persist($product);
        
        $product = new Product();
        $product->setName('Grapas para engrapadora');
        $product->setDescription('Grapas para engrapadora');
        $product->setCategory($this->getReference('grapa'));
        $this->addReference('product-39', $product);
        $manager->persist($product);
        
        
        
        $product = new Product();
        $product->setName('Rollo de papel higiénico');
        $product->setDescription('Papel higiénico');
        $product->setCategory($this->getReference('accesorio-limpieza'));
        $this->addReference('product-40', $product);
        $manager->persist($product);
        
        $product = new Product();
        $product->setName('Crema de limpieza para muebles');
        $product->setDescription('Crema silicona de limpieza para muebles');
        $product->setCategory($this->getReference('accesorio-limpieza'));
        $this->addReference('product-41', $product);
        $manager->persist($product);
        
        $product = new Product();
        $product->setName('Gel sanitizante para manos');
        $product->setDescription('Gel sanitizante para manos');
        $product->setCategory($this->getReference('accesorio-limpieza'));
        $this->addReference('product-42', $product);
        $manager->persist($product);
        
        $product = new Product();
        $product->setName('Jabón líquido para manos');
        $product->setDescription('Jabón líquido para manos');
        $product->setCategory($this->getReference('accesorio-limpieza'));
        $this->addReference('product-43', $product);
        $manager->persist($product);
        
        $product = new Product();
        $product->setName('limpia vidrios/cristal');
        $product->setDescription('limpia vidrios/cristal');
        $product->setCategory($this->getReference('accesorio-limpieza'));
        $this->addReference('product-44', $product);
        $manager->persist($product);
        
        $product = new Product();
        $product->setName('Cloro');
        $product->setDescription('Cloro');
        $product->setCategory($this->getReference('accesorio-limpieza'));
        $this->addReference('product-45', $product);
        $manager->persist($product);      
        
        $product = new Product();
        $product->setName('Desinfectante para pisos');
        $product->setDescription('Desinfectante');
        $product->setCategory($this->getReference('accesorio-limpieza'));
        $this->addReference('product-46', $product);
        $manager->persist($product);
        
        $product = new Product();
        $product->setName('Ambientador');
        $product->setDescription('Ambientador');
        $product->setCategory($this->getReference('accesorio-limpieza'));
        $this->addReference('product-47', $product);
        $manager->persist($product); 
        
        $product = new Product();
        $product->setName('Detergente para limpieza');
        $product->setDescription('Detergente para limpieza');
        $product->setCategory($this->getReference('accesorio-limpieza'));
        $this->addReference('product-48', $product);
        $manager->persist($product);
        
        $product = new Product();
        $product->setName('Funda o bolsa plástica para basura');
        $product->setDescription('Funda o bolsa plástica para basura');
        $product->setCategory($this->getReference('accesorio-limpieza'));
        $this->addReference('product-49', $product);
        $manager->persist($product);
        
        $product = new Product();
        $product->setName('Guante de limpieza');
        $product->setDescription('Guante de limpieza');
        $product->setCategory($this->getReference('accesorio-limpieza'));
        $this->addReference('product-50', $product);
        $manager->persist($product);
        
        $product = new Product();
        $product->setName('Paño absorbente de limpieza');
        $product->setDescription('Paño absorbente de limpieza');
        $product->setCategory($this->getReference('accesorio-limpieza'));
        $this->addReference('product-51', $product);
        $manager->persist($product);
        

        $manager->flush();
    }
}
