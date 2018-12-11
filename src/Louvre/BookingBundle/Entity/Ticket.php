<?php

namespace Louvre\BookingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ticket
 *
 * @ORM\Table(name="ticket")
 * @ORM\Entity(repositoryClass="Louvre\BookingBundle\Repository\TicketRepository")
 */
class Ticket
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
     * @var \DateTime
     *
     * @ORM\Column(name="opening_hour", type="time", unique=true)
     */
    private $openingHour;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Ticket
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set openingHour
     *
     * @param \DateTime $openingHour
     *
     * @return Ticket
     */
    public function setOpeningHour($openingHour)
    {
        $this->openingHour = $openingHour;

        return $this;
    }

    /**
     * Get openingHour
     *
     * @return \DateTime
     */
    public function getOpeningHour()
    {
        return $this->openingHour;
    }
}

