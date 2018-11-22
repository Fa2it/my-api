<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $supplier_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $category_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     */
    private $unit_price;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $creation_date;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $last_modified_date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $group_list;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $discount;

    /**
     * @ORM\Column(type="float" )
     */
    private $discount_price;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSupplierId(): ?int
    {
        return $this->supplier_id;
    }

    public function setSupplierId(int $supplier_id): self
    {
        $this->supplier_id = $supplier_id;

        return $this;
    }

    public function getCategoryId(): ?int
    {
        return $this->category_id;
    }

    public function setCategoryId(int $category_id): self
    {
        $this->category_id = $category_id;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getUnitPrice(): ?float
    {
        return $this->unit_price;
    }

    public function setUnitPrice(float $unit_price): self
    {
        $this->unit_price = $unit_price;

        return $this;
    }

    public function getCreationDate(): ?string
    {
        return $this->creation_date;
    }

    public function setCreationDate(string $creation_date): self
    {
        $this->creation_date = $creation_date;

        return $this;
    }

    public function getLastModifiedDate(): ?string
    {
        return $this->last_modified_date;
    }

    public function setLastModifiedDate(?string $last_modified_date): self
    {
        $this->last_modified_date = $last_modified_date;

        return $this;
    }

    public function getGroupList(): ?string
    {
        return $this->group_list;
    }

    public function setGroupList(?string $group_list): self
    {
        $this->group_list = $group_list;

        return $this;
    }
    public function getDiscount(): ?string
    {
        return $this->$discount;
    }

    public function setDiscount(?string $discount): self
    {
        $this->discount = $discount;

        return $this;
    }
    public function getDiscountPrice(): ?string
    {
        return $this->discount_price;
    }

    public function setDiscountPrice(?float $unit_price, string $discount ): self
    {
        if( strpos( $discount, '%' ) ){
            $discount = str_replace("%","",$discount );
            $disp = floatval( $discount );
            $this->discount_price = ( (100 - $disp ) / 100 ) * $unit_price ;
        } else {
            $this->discount_price =  $unit_price + floatval( $discount );
        }

        return $this;
    }



}
