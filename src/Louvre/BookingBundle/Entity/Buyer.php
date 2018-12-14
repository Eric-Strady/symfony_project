<?php

namespace Louvre\BookingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Buyer
 *
 * @ORM\Table(name="buyer")
 * @ORM\Entity(repositoryClass="Louvre\BookingBundle\Repository\BuyerRepository")
 */
class Buyer
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * @var int
     *
     * @ORM\Column(name="total_price", type="integer")
     */
    private $totalPrice;

    /**
     * @var string
     *
     * @ORM\Column(name="booking_number", type="string", length=255, unique=true)
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $bookingNumber;

    /**
     * @ORM\OneToMany(targetEntity="Louvre\BookingBundle\Entity\Booking", mappedBy="buyer")
     */
    private $bookings;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->bookings = new ArrayCollection();
    }

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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Buyer
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Buyer
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return Buyer
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set totalPrice
     *
     * @param integer $totalPrice
     *
     * @return Buyer
     */
    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    /**
     * Get totalPrice
     *
     * @return int
     */
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    /**
     * Set bookingNumber
     *
     * @param string $bookingNumber
     *
     * @return Buyer
     */
    public function setBookingNumber($bookingNumber)
    {
        $this->bookingNumber = $bookingNumber;

        return $this;
    }

    /**
     * Get bookingNumber
     *
     * @return string
     */
    public function getBookingNumber()
    {
        return $this->bookingNumber;
    }

    /**
     * Add booking
     *
     * @param \Louvre\BookingBundle\Entity\Booking $booking
     *
     * @return Buyer
     */
    public function addBooking(\Louvre\BookingBundle\Entity\Booking $booking)
    {
        $this->bookings[] = $booking;
        $booking->setBuyer($this);

        return $this;
    }

    /**
     * Remove booking
     *
     * @param \Louvre\BookingBundle\Entity\Booking $booking
     */
    public function removeBooking(\Louvre\BookingBundle\Entity\Booking $booking)
    {
        $this->bookings->removeElement($booking);
    }

    /**
     * Get bookings
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBookings()
    {
        return $this->bookings;
    }
}
