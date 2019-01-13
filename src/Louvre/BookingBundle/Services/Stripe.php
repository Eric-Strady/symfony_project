<?php

namespace Louvre\BookingBundle\Services;

use Louvre\BookingBundle\Entity\Buyer;

class Stripe
{
	public function payment(Buyer $buyer)
	{
		\Stripe\Stripe::setApiKey("sk_test_U7Dow6nqjUiYNLUGdEwV8W0O");

		$amount = $buyer->getTotalPrice();
		$quantity = $buyer->getQuantity();
		$token = $_POST['stripeToken'];

		$charge = \Stripe\Charge::create([
		    'amount' => $amount * 100,
		    'currency' => 'eur',
		    'description' => 'Réservation pour ' . $quantity . ' personnes',
		    'source' => $token,
		]);
	}
}