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
			$message = $this->getMessage($e);
			return $message;
		}
		catch (\Stripe\Error\RateLimit $e)
		{
			$message = $this->getMessage($e);
			return $message;
		}
		catch (\Stripe\Error\InvalidRequest $e)
		{
			$message = $this->getMessage($e);
			return $message;
		}
		catch (\Stripe\Error\Authentication $e)
		{
			$message = $this->getMessage($e);
			return $message;
		}
		catch (\Stripe\Error\ApiConnection $e)
		{
			$message = $this->getMessage($e);
			return $message;
		}
		catch (\Stripe\Error\Base $e)
		{
			$message = $this->getMessage($e);
			return $message;
		}
		catch (Exception $e)
		{
			$message = $this->getMessage($e);
			return $message;
		}
	}

	private function getMessage($error)
	{
		$body = $error->getJsonBody();
		$err  = $body['error'];
		$message = $err['message'];

		return $message;
	}
}