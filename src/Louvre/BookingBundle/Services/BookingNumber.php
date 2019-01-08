<?php

namespace Louvre\BookingBundle\Services;

use Louvre\BookingBundle\Entity\Buyer;

class BookingNumber
{
    public function defineBookingNumber(Buyer $buyer, \DateTime $date)
    {
        $datePurchase = $date->format('d/m/Y');
        $d = $buyer->getDate();
        $dateVisit = $d->format('d/m/Y');
        $typeTicket = $buyer->getTypeTicket();
        $firstRandomChars = $this->defineRandomChars();
        $secondRandomChars = $this->defineRandomChars();

        $bookingNumber = $datePurchase. '_' .$firstRandomChars. '*' .$typeTicket. '*' .$secondRandomChars. '_' .$dateVisit;

        $buyer->setBookingNumber($bookingNumber);
    }

    private function defineRandomChars()
    {
        $length = 5;
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charsLength = strlen($chars);
        $randomChars = '';

        for ($i = 0; $i < $length; $i++) {
            $randomChars .= $chars[rand(0, $charsLength - 1)];
        }

        return $randomChars;
    }
}