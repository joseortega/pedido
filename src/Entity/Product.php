<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $description;
    
    /**
     * @var Category
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="products")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;
    
    /**
     * @var PurchaseItem[]
     * @ORM\OneToMany(targetEntity="PurchaseItem", mappedBy="product", cascade={"remove"})
     * @Serializer\Exclude()
     */
    private $purchasedItems;
    
    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getId(){
        return $this->id;
    }

    public function getName(): string{
        return $this->name;
    }

    public function setName(string $name){
        $this->name = $name;
    }

    public function getDescription(): string{
        return $this->description;
    }

    public function setDescription(string $description){
        $this->description = $description;
    }
    
    public function getCategory(){
        return $this->category;
    }
    
    public function setCategory(Category $category){
        $this->category = $category;
    }
}
