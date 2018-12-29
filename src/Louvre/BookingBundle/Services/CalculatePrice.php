<?php

namespace Louvre\BookingBundle\Services;

use Louvre\BookingBundle\Entity\Booking;

class CalculatePrice
{
	const NORMAL_PRICE = 16;
	const CHILD_PRICE = 8;
	const SENIOR_PRICE = 12;
	const REDUCED_PRICE = 10;
	const BABY_PRICE = 0;

	const BABY_AGE = 4;
	const CHILD_AGE = 12;
	const SENIOR_AGE = 60;

	public function definePrice(Booking $booking, \DateTime $currentDate)
	{
		$diffYear = $currentDate->diff($booking->getBirthDate())->y;

		if ($booking->getReducedPrice() && $diffYear > self::CHILD_AGE)
		{
			$booking->setPrice(self::REDUCED_PRICE);
		}
		else
		{
			$booking->setPrice($this->calculatePrice($diffYear));
		}
	}

	private function calculatePrice($diffYear)
	{
		if ($diffYear < self::BABY_AGE)
		{
			return self::BABY_PRICE;
		}
		elseif ($diffYear < self::CHILD_AGE)
		{
			return self::CHILD_PRICE;
		}
		elseif ($diffYear >= self::SENIOR_AGE)
		{
			return self::SENIOR_PRICE;
		}
		else
		{
			return self::NORMAL_PRICE;
		}
	}
}