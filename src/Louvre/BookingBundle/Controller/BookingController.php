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
        $currentDate = new \DateTime();
    	$buyer = new Buyer();
    	$em = $this->getDoctrine()->getManager();

        $form = $this->createForm(BuyerType::class, $buyer);
        $buyerRepository = $em->getRepository('LouvreBookingBundle:Buyer');
        $daysOff = $buyerRepository->totalBooking();

    	if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
    	{
            $setBookingNumber = $this->get('louvre_booking.booking_number')->defineBookingNumber($buyer, $currentDate);

            $totalPrice = 0;
            foreach ($buyer->getBookings() as $booking)
            {
                $booking->setBuyer($buyer);
                $setPricePerTicket = $this->get('louvre_booking.calculate_price')->definePrice($booking, $currentDate);
                $totalPrice += $setPricePerTicket;
                $em->persist($booking);
            }

            $buyer->setTotalPrice($totalPrice);
            $em->persist($buyer);
            $em->flush();

            $request->getSession()->getFlashBag()->add('booked', 'Votre réservation a bien été prise en compte !');

			return $this->render('@LouvreBooking/checkout.html.twig', array('buyer' => $buyer));
    	}

        return $this->render('@LouvreBooking/layout.html.twig', array('form' => $form->createView(), 'daysOff' => $daysOff));
    }
}
