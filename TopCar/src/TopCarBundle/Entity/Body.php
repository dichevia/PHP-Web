<?php

namespace TopCarBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Body
 *
 * @ORM\Table(name="bodies")
 * @ORM\Entity(repositoryClass="TopCarBundle\Repository\Cars\BodyRepository")
 */
class Body
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, unique=true)
     */
    private $type;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="TopCarBundle\Entity\Car", mappedBy="body")
     */
    private $cars;

    public function __construct()
    {
        $this->cars = new ArrayCollection();
    }


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name.
     *
     * @param string $type
     *
     * @return Body
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return ArrayCollection
     */
    public function getCars(): ArrayCollection
    {
        return $this->cars;
    }

    /**
     * @param ArrayCollection $cars
     */
    public function setCars(ArrayCollection $cars): void
    {
        $this->cars = $cars;
    }
}
