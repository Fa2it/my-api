<?php
/**
 * @author Felix Ashu Aba
 * @author-url https://www.fa2.it/about/
 */

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
        return $this->discount;
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

    public function serializeProduct(): array
    {
       return [
          'id'=>$this->getId(),
          'name'=>$this->getName(),
          'supplier_id'=>$this->getSupplierId(),
          'category_id'=>$this->getCategoryId(),
          'description'=>$this->getDescription(),
          'unit_price'=>$this->getUnitPrice(),
          'creation_date'=>$this->getCreationDate(),
          'last_modified_date'=>$this->getLastModifiedDate(),
          'group_list'=>$this->getGroupList(),
          'discount' =>$this->getDiscount(),
          'discount_price' =>$this->getDiscountPrice()
       ];

    }

    public function setProduct( array $data ): self
    {
            if( isset( $data['name'] ) ){
              $this->setName( @$data['name'] );
            }
            if( isset( $data['supplier_id'] ) ){
              $this->setSupplierId( @$data['supplier_id'] );
            }

            if( isset( $data['category_id'] ) ){
              $this->setCategoryId( @$data['category_id'] );
            }
            if( isset( $data['description'] ) ){
              $this->setDescription( @$data['description'] );
            }
            if( isset( $data['unit_price'] ) ){
              $this->setUnitPrice( @$data['unit_price'] );
            }

            if( isset( $data['creation_date'] ) ){
              $this->setCreationDate( @$data['creation_date'] );
            }
            if( isset( $data['last_modified_date'] ) ){
              $this->setLastModifiedDate( @$data['last_modified_date']);
            }
            if( isset( $data['group_list'] ) ){
              // TODO if id, make sure elemets of group list are found in
              // otherwise throw and error product
              $this->setGroupList( @$data['group_list'] );
            }
            if( isset( $data['discount'] ) ){
              $this->setDiscount( @$data['discount'] );
            }
            if( isset( $data['unit_price'],  $data['discount'] ) ){
              $this->setDiscountPrice( $data['unit_price'],  $data['discount'] );
            }
            return $this;
    }

}
