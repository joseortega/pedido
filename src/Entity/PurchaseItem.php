<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass="App\Repository\PurchaseItemRepository")
 */
class PurchaseItem
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * The ordered quantity.
     *
     * @var int
     * @ORM\Column(type="smallint")
     * @Assert\NotBlank()
     * @Assert\GreaterThanOrEqual(1)
     */
    private $requestQuantity;
    
    /**
     * @var int
     * @ORM\Column(type="smallint")
     * @Assert\NotBlank()
     * @Assert\GreaterThanOrEqual(0)
     * @Assert\LessThanOrEqual(propertyPath="requestQuantity")
     */
    private $dispatchQuantity = 0;

    /**
     * The ordered product.
     *
     * @var Product
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="purchasedItems")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    protected $product;
    

    /**
     * @ORM\ManyToOne(targetEntity="Purchase", inversedBy="purchasedItems")
     * @ORM\JoinColumn(name="purchase_id", referencedColumnName="id")
     */
    protected $purchase;

    public function getId()
    {
        return $this->id;
    }
    
    public function getProduct(){
        return $this->product;
    }
    
    public function setProduct(Product $product){
        $this->product = $product;
    }
    
    public function getPurchase(){
        return $this->purchase;
    }
    
    public function setPurchase(Purchase $purchase){
        $this->purchase = $purchase;
    }
    
    public function getRequestQuantity(){
        return $this->requestQuantity;
    }
    
    public function setRequestQuantity($requestQuantity){
        $this->requestQuantity = $requestQuantity;
    }
    
    public function getDispatchQuantity(){
        return $this->dispatchQuantity;
    }
    
    public function setDispatchQuantity($dispatchQuantity){
        $this->dispatchQuantity = $dispatchQuantity;
    }
    
    public function __toString() {
        return 'item # '. $this->getId();
    }
}
