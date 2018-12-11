<?php

namespace Louvre\BookingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Louvre\BookingBundle\Entity\Booking;
use Louvre\BookingBundle\Form\BookingType;

class BookingController extends Controller
{
    public function indexAction(Request $request)
    {
    	$booking = new Booking();

    	$form = $this->createForm(BookingType::class, $booking);

    	if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
    	{
			$em = $this->getDoctrine()->getManager();
			$em->persist($booking);
			$em->flush();

			$request->getSession()->getFlashBag()->add('booked', 'Votre réservation a bien été prise en compte !');

			return $this->redirectToRoute('louvre_booking_homepage');
    	}

        return $this->render('@LouvreBooking/Booking/index.html.twig', array('form' => $form->createView()));
    }
}
