<?php

namespace Louvre\BookingBundle\Services;

use Louvre\BookingBundle\Entity\Buyer;

class Mailer
{
	private $mailer;
	private $twig;

	public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig)
	{
		$this->mailer = $mailer;
		$this->twig = $twig;
	}

	public function sendOrderSummary(Buyer $buyer)
	{
		$email = $buyer->getEmail();

		$message = (new \Swift_Message('Récapitulatif commande'))
	        ->setFrom('order@louvre.com' => 'Louvre Paris')
	        ->setTo($email)
	        ->setBody(
	            $this->twig->render('@LouvreBooking/orderSummary.html.twig', array('buyer' => $buyer)),
	            'text/html'
        	);

	    $this->mailer->send($message);
	}
}