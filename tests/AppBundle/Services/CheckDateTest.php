<?php

namespace Tests\AppBundle\Services;

use Louvre\BookingBundle\Entity\Buyer;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CheckDateTest extends KernelTestCase
{
    public function setUp()
    {
        $kernel = self::bootKernel();
        $this->service = $kernel->getContainer()->get('louvre_booking.check_date');
    }

	/**
     * @dataProvider dateProvider
     */
    public function testIsDateNotValid($dateVisit, $currentDate)
    {
    	$buyer = new Buyer();
        $buyer->setDate($dateVisit);
    	$currentDate = $currentDate;

        // Define dates where 1000 bookings and more were made
        $daysOff = array(
            array(
                "date" => new \DateTime('01-02-2019')
            ));

    	$isDateValid = $this->service->isDateValid($buyer, $daysOff, $currentDate);

    	$this->assertFalse($isDateValid);
    }

    public function dateProvider()
    {
        return [
            // Test fixed Holidays
	        [new \DateTime('01-05-2019'), new \DateTime('01-05-2019')],
	        [new \DateTime('01-11-2019'), new \DateTime('01-11-2019')],
            [new \DateTime('25-12-2019'), new \DateTime('25-12-2019')],

            // Test tuesday
            [new \DateTime('01-01-2019'), new \DateTime('01-05-2019')],

            // Test sunday
            [new \DateTime('06-01-2019'), new \DateTime('01-05-2019')],

            // Test past date
            [new \DateTime('01-01-1900'), new \DateTime('01-05-2019')],

            // Test more than one year date
            [new \DateTime('01-01-2100'), new \DateTime('01-05-2019')]
    	];
    }
}
