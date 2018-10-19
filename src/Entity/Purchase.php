<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;
use App\Entity\Office;
use App\Entity\PurchaseStatus;
use JMS\Serializer\Annotation as Serializer;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use DateTime;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PurchaseRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Purchase
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;
    
        /**
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;
    
    /**
     * @ORM\Column(name="request_date", type="datetime", nullable=true)
     */
    private $requestDate;
    
     /**
     * @ORM\Column(name="canceled_date", type="datetime", nullable=true)
     */
    private $canceledDate; 
    
    /**
     * @ORM\Column(name="dispatch_date", type="datetime", nullable=true)
     */
    private $dispatchDate;

    /**
     * @ORM\Column(name="status", type="string", length=255, nullable=true)
     */
    private $status = PurchaseStatus::EDITION_STATUS;
          
    /**
     * Items that have been purchased.
     *
     * @var PurchaseItem[]
     * @ORM\OneToMany(targetEntity="PurchaseItem", mappedBy="purchase", cascade={"remove"})
     * @Serializer\Exclude()
     */
    private $purchasedItems;
    
    /**
     * The user who made the purchase.
     *
     * @var office
     * @ORM\ManyToOne(targetEntity="Office", inversedBy="purchases")
     */
    private $office;
    
    /**
     * The user who made the purchase.
     *
     * @var User
     * @ORM\ManyToOne(targetEntity="User", inversedBy="purchases")
     */
    private $user;
    
    /**
     * The user who made the dispatch/annulled
     *
     * @var User
     * @ORM\ManyToOne(targetEntity="User", inversedBy="purchasesResponse")
     */
    private $userResponse;
    
    public function __construct() {
        $this->purchasedItems = new ArrayCollection();
    }

    public function getId(){
        return $this->id;
    }

    public function getCreatedAt(): \DateTime{
        return $this->createdAt;
    }
    
    public function setCreatedAt(\DateTime $createdAt){
        $this->createdAt = $createdAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt){
        $this->updatedAt = $updatedAt;
    }
    
    public function getUpdatedAt(): \DateTime{
        return $this->updatedAt;
    }

    public function setRequestDate(\DateTime $requestDate){
        $this->requestDate = $requestDate;
    }
    
    public function getRequestDate(): \DateTime{
        return $this->requestDate;
    }
    
    public function setCanceledDate(\DateTime $canceledDate){
        $this->canceledDate = $canceledDate;
    }
    
    public function getCanceledAt(): \DateTime{
        return $this->canceledDate->format('Y-m-d H:i:s');
    }
    
    public function getDispatchDate(): \DateTime{
        return $this->dispatchDate;
    }
   
    public function setDispatchDate(\DateTime $dispatchDate){
        $this->dispatchDate = $dispatchDate;
    }

    public function getOffice(): Office{
        return $this->office;
    }

    public function setOffice(Office $office){
        $this->office = $office;
    }
    
    public function getUser(){
        return $this->user;
    }
    
    public function setUser(User $user){
        $this->user = $user;
    }
    
    public function getUserResponse(){
        return $this->userResponse;
    }
    
    public function setUserResponse(User $user){
        $this->userResponse = $user;
    }
    
    public function getPurchaseItems(){
        return $this->purchasedItems;
    }
    
    public function getStatus(){
        return $this->status;
    }
    
    public function setStatus($status){
        $this->status = $status;
    }
    
    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {
        $dateTimeNow = new DateTime('now');
        $this->setUpdatedAt($dateTimeNow);
        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt($dateTimeNow);
        }
    }
}
