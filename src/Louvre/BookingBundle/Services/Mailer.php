<?php

namespace Louvre\BookingBundle\Services;

use Louvre\BookingBundle\Entity\Buyer;

class Mailer
{
	public function sendOrderSummary(Buyer $buyer, \Swift_Mailer $mailer)
	{
		$email = $buyer->getEmail();

		$message = (new \Swift_Message('Récapitulatif commande'))
	        ->setFrom('send@example.com')
	        ->setTo($email)
	        ->setBody(
	            $this->renderView('@LouvreBooking/orderSummary.html.twig', array('buyer' => $buyer)),
	            'text/html'
        	);

	    $mailer->send($message);
	}
}