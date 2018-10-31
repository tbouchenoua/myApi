<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;
use JMS\Serializer\Annotation\Type;


/**
 * @MongoDB\Document
 */
class User
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @Type("int")
     * @MongoDB\Field(type="int")
     * 
     */
    protected $age;

    /**
     * @Type("int")
     * @MongoDB\Field(type="int",nullable=true)
     */
    protected $balance;
     /**
    * @Type("string")
     * @MongoDB\Field(type="string")
     */
    protected $firstname;

    /**
     * @Type("string")
     * @MongoDB\Field(type="string")
     */
    protected $lastname; 
     /**
      * @Type("array")
     * @MongoDB\Field(type="collection")
     */
    protected $cars;

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
     * Set age
     *
     * @param int $age
     * @return $this
     */
    public function setAge($age)
    {
        $this->age = $age;
        return $this;
    }

    /**
     * Get age
     *
     * @return int $age
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set balance
     *
     * @param int $balance
     * @return $this
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;
        return $this;
    }

    /**
     * Get balance
     *
     * @return int $balance
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return $this
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * Get firstname
     *
     * @return string $firstname
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return $this
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * Get lastname
     *
     * @return string $lastname
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set cars
     *
     * @param collection $cars
     * @return $this
     */
    public function setCars($cars)
    {
        $this->cars = $cars;
        return $this;
    }

    /**
     * Get cars
     *
     * @return collection $cars
     */
    public function getCars()
    {
        return $this->cars;
    }
}
