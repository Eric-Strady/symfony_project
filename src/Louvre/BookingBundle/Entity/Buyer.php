<?php

namespace Louvre\BookingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
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
     * @Assert\NotBlank(message="{{ value }} ne doit pas être vide !")
     * @Assert\Date(message="La date '{{ value }}' n'est pas une date valide.")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     * @Assert\NotBlank(message="{{ value }} ne doit pas être vide !")
     * @Assert\Length(max=255, maxMessage="{{ value }} ne doit pas dépasser {{ limit }} caractères.")
     * @Assert\Email(message="L'email '{{ value }}' n'est pas un email valide.")
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="type_ticket", type="string", length=3)
     * @Assert\NotBlank(message="{{ value }} ne doit pas être vide !")
     * @Assert\Type(type="string", message="'{{ value }}' n'est pas une chaîne de caractères.")
     * @Assert\Length(max=3, maxMessage="Vous devez sélectionner soit la billet journée, soit le billet demi-journée.")
     */
    private $typeTicket;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer")
     * @Assert\NotBlank(message="{{ value }} ne doit pas être vide !")
     * @Assert\Type(type="integer", message="'{{ value }}' n'est pas un nombre.")
     * @Assert\Range(min=1, max=10, minMessage="'{{ value }}' ne doit pas être inférieur à {{ limit }}", maxMessage="{{ value }}' ne doit pas être supérieur à {{ limit }}")
     */
    private $quantity;

    /**
     * @var int
     *
     * @ORM\Column(name="total_price", type="integer")
     * @Assert\NotBlank(message="{{ value }} ne doit pas être vide !")
     * @Assert\Type(type="integer", message="'{{ value }}' n'est pas un nombre.")
     * @Assert\GreaterThan(value=0, message="'{{ value }}' doit obligatoirement être supérieur à {{ compared_value }} €.")
     */
    private $totalPrice;

    /**
     * @var string
     *
     * @ORM\Column(name="booking_number", type="string", length=255, unique=true)
     * @Assert\NotBlank(message="{{ value }} ne doit pas être vide !")
     * @Assert\Type(type="string", message="'{{ value }}' n'est pas une chaîne de caractères.")
     * @Assert\Length(max=255, maxMessage="Le numéro de réservation ne doit pas dépasser {{ limit }} caractères.")
     */
    private $bookingNumber;

    /**
     * @ORM\OneToMany(targetEntity="Louvre\BookingBundle\Entity\Booking", mappedBy="buyer", cascade={"persist"})
     * @Assert\NotBlank(message="{{ value }} ne doit pas être vide !")
     * @Assert\Type(type="object", message="'{{ value }}' n'est pas objet.")
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
     * Set typeTicket
     *
     * @param string $typeTicket
     *
     * @return Buyer
     */
    public function setTypeTicket($typeTicket)
    {
        $this->typeTicket = $typeTicket;

        return $this;
    }

    /**
     * Get typeTicket
     *
     * @return string
     */
    public function getTypeTicket()
    {
        return $this->typeTicket;
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
