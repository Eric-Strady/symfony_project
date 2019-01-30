<?php

namespace Tests\AppBundle\Services;

use Louvre\BookingBundle\Entity\Buyer;
use PHPUnit\Framework\TestCase;

class BuyerTest extends TestCase
{
    public function testSetDate()
    {
        $buyer = new Buyer();
        $buyer->setDate(new \DateTime());
        $date = $buyer->getDate();
        $this->assertEquals(new \DateTime(), $date);
    }

    public function testSetEmail()
    {
        $buyer = new Buyer();
        $buyer->setEmail('test@gmail.com');
        $email = $buyer->getEmail();
        $this->assertEquals('test@gmail.com', $email);
    }

    public function testSetTypeTicket()
    {
        $buyer = new Buyer();
        $buyer->setTypeTicket('BJ');
        $typeTicket = $buyer->getTypeTicket();
        $this->assertEquals('BJ', $typeTicket);
    }

    public function testSetQuantity()
    {
        $buyer = new Buyer();
        $buyer->setQuantity(5);
        $quantity = $buyer->getQuantity();
        $this->assertEquals(5, $quantity);
    }

    public function testSetTotalPrice()
    {
        $buyer = new Buyer();
        $buyer->setTotalPrice(16);
        $totalPrice = $buyer->getTotalPrice();
        $this->assertEquals(16, $totalPrice);
    }

    public function testSetBookingNumber()
    {
        $buyer = new Buyer();
        $buyer->setBookingNumber('test__string__booking__number');
        $bookingNumber = $buyer->getBookingNumber();
        $this->assertEquals('test__string__booking__number', $bookingNumber);
    }
}
