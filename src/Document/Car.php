<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;
use JMS\Serializer\Annotation\Type;
/**
 * @MongoDB\Document
 */
class Car
{
    /**
     * @MongoDB\Id
     */
    protected $id;

       /**
        *  @Type("string")
     * @MongoDB\Field(type="string")
     */
    protected $brand;

    /**
     *  @Type("string")
     * @MongoDB\Field(type="string")
     */
    protected $model;
     /**
     * @Type("int")
     * @MongoDB\Field(type="int",nullable=true)
     */
    protected $value;

    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set brand
     *
     * @param string $brand
     * @return $this
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
        return $this;
    }

    /**
     * Get brand
     *
     * @return string $brand
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set model
     *
     * @param int $model
     * @return $this
     */
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    /**
     * Get model
     *
     * @return int $model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set value
     *
     * @param int $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Get value
     *
     * @return int $value
     */
    public function getValue()
    {
        return $this->value;
    }
}
