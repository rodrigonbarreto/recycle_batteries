<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * BatteryPack
 *
 * @ORM\Table(name="battery_pack")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BatteryPackRepository")
 */
class BatteryPack
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
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     * @Assert\NotBlank()
     * @Assert\Length(max = 255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(max = 255)
     */
    private $type;

    /**
     * @var int
     *
     * @ORM\Column(name="count", type="integer", length=255)
     */
    private $count;


    /**
     * Get id
     *
     * @return int
     */
    public function getId() : ?int
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return BatteryPack
     */
    public function setName(string $name) : BatteryPack
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() :?string
    {
        return $this->name;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return BatteryPack
     */
    public function setType(string $type) : BatteryPack
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType() :?string
    {
        return $this->type;
    }

    /**
     * Set count
     *
     * @param int $count
     *
     * @return BatteryPack
     */
    public function setCount(int $count) :BatteryPack
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Get count
     *
     * @return int
     */
    public function getCount() :?int
    {
        return $this->count;
    }
}
