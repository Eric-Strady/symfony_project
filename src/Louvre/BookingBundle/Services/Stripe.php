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

		try
		{
			$charge = \Stripe\Charge::create([
			    'amount' => $amount * 100,
			    'currency' => 'eur',
			    'description' => 'Réservation pour ' . $quantity . ' personne(s)',
			    'source' => $token,
			]);
			return true;
		}
		catch(\Stripe\Error\Card $e)
		{
			$message = 'Pour une raison inconnue, votre carte n\'a pas pu être débitée !';
			return $message;
		}
		catch (\Stripe\Error\RateLimit $e)
		{
			$message = 'Impossible d\'effectuer le paiement !';
			return $message;
		}
		catch (\Stripe\Error\InvalidRequest $e)
		{
			$message = 'Impossible d\'effectuer le paiement !';
			return $message;
		}
		catch (\Stripe\Error\Authentication $e)
		{
			$message = 'Impossible d\'effectuer le paiement !';
			return $message;
		}
		catch (\Stripe\Error\ApiConnection $e)
		{
			$message = 'Impossible d\'effectuer le paiement !';
			return $message;
		}
		catch (\Stripe\Error\Base $e)
		{
			$message = 'Impossible d\'effectuer le paiement !';
			return $message;
		}
		catch (Exception $e)
		{
			$message = 'Impossible d\'effectuer le paiement !';
			return $message;
		}
	}
}