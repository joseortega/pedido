<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category{
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
     * The category parent.
     *
     * @var Category
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=true)
     **/
    protected $parent;
    
    /**
     * @var Products[]
     * @ORM\OneToMany(targetEntity="Product", mappedBy="category")
     * @Serializer\Exclude()
     */
    protected $products;
    
    public function __construct(){
        $this->products = new ArrayCollection();
    }

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function setName(string $name){
        $this->name = $name;
    }
    
    public function getParent(){
        return $this->parent;
    }
    
    public function setParent(Category $parent){
        $this->parent = $parent;
    }
    
    public function getProducts(){
        return $this->products;
    }
    
    public function addProduct(Product $product){
        $this->products->add($product);
    }
    
    public function __toString() {
        return $this->name;
    }
}
