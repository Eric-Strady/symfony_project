<?php

namespace Louvre\BookingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\NotBlank(message="Votre prénom ne doit pas être vide !")
     * @Assert\Type(type="string", message="'{{ value }}' n'est pas une chaîne de caractères.")
     * @Assert\Length(max=255, maxMessage="Votre prénom ne doit pas dépasser {{ limit }} caractères.")
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255)
     * @Assert\NotBlank(message="Votre nom ne doit pas être vide !")
     * @Assert\Type(type="string", message="'{{ value }}' n'est pas une chaîne de caractères.")
     * @Assert\Length(max=255, maxMessage="Votre nom ne doit pas dépasser {{ limit }} caractères.")
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255)
     * @Assert\NotBlank(message="{{ value }} ne doit pas être vide !")
     * @Assert\Country(message="{{ value }} ne n'est pas un pays valide.")
     */
    private $country;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthdate", type="date")
     * @Assert\NotBlank(message="Votre date d'anniversaire ne doit pas être vide !")
     * @Assert\Date(message="La date '{{ value }}' n'est pas une date valide.")
     */
    private $birthdate;

    /**
     * @ORM\ManyToOne(targetEntity="Louvre\BookingBundle\Entity\Buyer", inversedBy="bookings")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="{{ value }} ne doit pas être vide !")
     * @Assert\Type(type="object", message="'{{ value }}' n'est pas objet.")
     * @Assert\Valid()
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
