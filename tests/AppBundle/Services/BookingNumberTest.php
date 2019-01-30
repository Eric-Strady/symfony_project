<?php

namespace Tests\AppBundle\Services;

use Louvre\BookingBundle\Entity\Buyer;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class BookingNumberTest extends KernelTestCase
{
    public function setUp()
    {
        $kernel = self::bootKernel();
        $this->service = $kernel->getContainer()->get('louvre_booking.booking_number');
    }

    /**
     * @dataProvider typeTicketProvider
     */
    public function testBookingNumberValidSyntax($typeTicket)
    {
    	$buyer = new Buyer();
        $buyer->setDate(new \DateTime());
        $buyer->setTypeTicket($typeTicket);
    	$currentDate = new \DateTime();

    	$bookingNumber = $this->service->defineBookingNumber($buyer, $currentDate);

    	$this->assertRegExp('#^\d{2}\/\d{2}\/\d{4}_[a-zA-Z]{5}\*BJ|BDJ\*[a-zA-Z]{5}_\d{2}\/\d{2}\/\d{4}$#', $bookingNumber);
    }

    public function typeTicketProvider()
    {
        return [
            ['BJ'],
            ['BDJ']
        ];
    }
}
