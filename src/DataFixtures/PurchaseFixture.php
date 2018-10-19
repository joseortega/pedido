<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Purchase;
use App\Entity\PurchaseItem;
use App\DataFixtures\CategoryFixture;
use App\DataFixtures\ProductFixture;
use App\DataFixtures\UserFixture;
use App\DataFixtures\OfficeFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PurchaseFixture extends Fixture implements DependentFixtureInterface
{
    public function getDependencies(): array {
        return array(CategoryFixture::class,
                     ProductFixture::class,
                     UserFixture::class,
                     OfficeFixture::class
               );
    }
    
    public function load(ObjectManager $manager)
    {
        foreach (range(0, 29) as $i) {
            $purchase = new Purchase();
            $purchase->setCreatedAt(new \DateTime("now +$i seconds"));
            $purchase->setUpdatedAt(new \DateTime("now +$i seconds"));
            $purchase->setUser($this->getReference('user-'.($i % 22)));
            $purchase->setOffice($this->getReference('office-'.($i % 7)));

            $this->addReference('purchase-'.$i, $purchase);
            $manager->persist($purchase);
            $manager->flush();

            $numItemsPurchased = rand(1, 5);
            foreach (range(1, $numItemsPurchased) as $j) {
                $item = new PurchaseItem();
                $item->setRequestQuantity(rand(1, 5));
                $item->setProduct($this->getRandomProduct());
                $item->setPurchase($this->getReference('purchase-'.$i));

                $manager->persist($item);
            }
        }

        $manager->flush();
    }

    private function getRandomProduct()
    {
        $productId = rand(0, 2);

        return $this->getReference('product-'.$productId);
    }

}
