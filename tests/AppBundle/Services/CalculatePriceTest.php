<?php

namespace Tests\AppBundle\Services;

use Louvre\BookingBundle\Entity\Booking;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CalculatePriceTest extends KernelTestCase
{
    public function setUp()
    {
        $kernel = self::bootKernel();
        $this->service = $kernel->getContainer()->get('louvre_booking.calculate_price');
    }

	/**
     * @dataProvider PriceBookingProvider
     */
    public function testPriceIsCorrect($birthdate, $reducedPrice, $testPrice)
    {
    	$booking = new Booking();
    	$date = new \DateTime('01/01/2019');

    	$booking->setBirthdate($birthdate);
    	$booking->setReducedPrice($reducedPrice);
    	$price = $this->service->definePrice($booking, $date);

    	$this->assertEquals($testPrice, $price);
    }

    public function PriceBookingProvider()
    {
        return [
	        [new \DateTime('01/01/2016'), false, 0],
	        [new \DateTime('01/01/2014'), false, 8],
	        [new \DateTime('01/01/1995'), true, 10],
	        [new \DateTime('01/01/1940'), false, 12],
	        [new \DateTime('01/01/1995'), false, 16]
    	];
    }
}
