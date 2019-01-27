<?php

namespace Louvre\BookingBundle\Services;

use Louvre\BookingBundle\Entity\Buyer;

class CheckDate
{
	public function isDateValid(Buyer $buyer, $daysOff, $currentDate)
	{
		$dateVisit = $buyer->getDate();
		$shortDateVisit = $buyer->getDate()->format('d/m');
		$length = count($daysOff);
		$disabledDays = ['01/05', '01/11', '25/12'];
		$notValidDate = [];

		for ($i=0; $i < $length; $i++) { 
			$notValidDate[$i] = $daysOff[$i]['date']->format('d/m');
		}

		$diffDate = $this->diffDate($dateVisit, $currentDate);
		$isDateValid = true;

		if (in_array($shortDateVisit, $disabledDays) || in_array($shortDateVisit, $notValidDate) || $diffDate > 365 || $diffDate < 0)
		{
			$isDateValid = false;
		}

		return $isDateValid;
	}

	private function diffDate($dateVisit, $currentDate)
	{
		$diff = $dateVisit->diff($currentDate)->days;
		return $diff;
	}
}