<?php

namespace Louvre\BookingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Booking
 *
 * @ORM\Table(name="booking")
 * @ORM\Entity(repositoryClass="Louvre\BookingBundle\Repository\BookingRepository")
 */
class Booking
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
     * @ORM\Column(name="first_name", type="string", length=255)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255)
     */
    private $country;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthdate", type="date")
     */
    private $birthdate;

    /**
     *@ORM\ManyToOne(targetEntity="Louvre\BookingBundle\Entity\Ticket")
     *@ORM\JoinColumn(nullable=false)
     */
    private $ticket;

    /**
     *@ORM\ManyToOne(targetEntity="Louvre\BookingBundle\Entity\Price")
     *@ORM\JoinColumn(nullable=false)
     */
    private $price;

    /**
     *@ORM\ManyToOne(targetEntity="Louvre\BookingBundle\Entity\Buyer", inversedBy="bookings")
     *@ORM\JoinColumn(nullable=false)
     */
    private $buyer;


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
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Booking
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Booking
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Booking
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set birthdate
     *
     * @param \DateTime $birthdate
     *
     * @return Booking
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * Get birthdate
     *
     * @return \DateTime
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Set ticket
     *
     * @param \Louvre\BookingBundle\Entity\Ticket $ticket
     *
     * @return Booking
     */
    public function setTicket(\Louvre\BookingBundle\Entity\Ticket $ticket)
    {
        $this->ticket = $ticket;

        return $this;
    }

    /**
     * Get ticket
     *
     * @return \Louvre\BookingBundle\Entity\Ticket
     */
    public function getTicket()
    {
        return $this->ticket;
    }

    /**
     * Set price
     *
     * @param \Louvre\BookingBundle\Entity\Price $price
     *
     * @return Booking
     */
    public function setPrice(\Louvre\BookingBundle\Entity\Price $price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return \Louvre\BookingBundle\Entity\Price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set buyer
     *
     * @param \Louvre\BookingBundle\Entity\Buyer $buyer
     *
     * @return Booking
     */
    public function setBuyer(\Louvre\BookingBundle\Entity\Buyer $buyer)
    {
        $this->buyer = $buyer;

        return $this;
    }

    /**
     * Get buyer
     *
     * @return \Louvre\BookingBundle\Entity\Buyer
     */
    public function getBuyer()
    {
        return $this->buyer;
    }
}
