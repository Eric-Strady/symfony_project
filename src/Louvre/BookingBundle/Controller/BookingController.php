<?php

namespace Louvre\BookingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Louvre\BookingBundle\Entity\Buyer;
use Louvre\BookingBundle\Entity\Booking;
use Louvre\BookingBundle\Form\BuyerType;
use Louvre\BookingBundle\Form\BookingType;

class BookingController extends Controller
{
    public function indexAction(Request $request)
    {
    	$buyer = new Buyer();

    	$form = $this->createForm(BuyerType::class, $buyer);

    	if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
    	{
			$em = $this->getDoctrine()->getManager();
			$em->persist($buyer);
			$em->flush();

			$request->getSession()->getFlashBag()->add('booked', 'Votre réservation a bien été prise en compte !');

			return $this->redirectToRoute('louvre_booking_homepage');
    	}

        return $this->render('@LouvreBooking/Booking/index.html.twig', array('form' => $form->createView()));
    }
}
