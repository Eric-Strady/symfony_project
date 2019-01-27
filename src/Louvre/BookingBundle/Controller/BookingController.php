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
            $dateValid = $this->get('louvre_booking.check_date')->isDateValid($buyer, $daysOff, $currentDate);
            if ($dateValid === false)
            {
                $request->getSession()->getFlashBag()->add('wrongData', 'Il est impossible de réserver à la date que vous avez choisie.');
                return $this->render('@LouvreBooking/layout.html.twig', array('form' => $form->createView(), 'daysOff' => $daysOff));
            }

            if ($buyer->getTypeTicket() !== 'BJ')
            {
                if ($buyer->getTypeTicket() !== 'BDJ') {
                    $request->getSession()->getFlashBag()->add('wrongData', 'Ce type de billet n\'existe pas.');
                    return $this->render('@LouvreBooking/layout.html.twig', array('form' => $form->createView(), 'daysOff' => $daysOff));
                }
            }

            $totalPrice = 0;
            $count = 0;
            foreach ($buyer->getBookings() as $booking)
            {
                $booking->setBuyer($buyer);
                $setPricePerTicket = $this->get('louvre_booking.calculate_price')->definePrice($booking, $currentDate);
                $totalPrice += $setPricePerTicket;
                $em->persist($booking);
                $count++;
            }

            if ($buyer->getQuantity() !== $count)
            {
                $request->getSession()->getFlashBag()->add('wrongData', 'Vous devez remplir autant de formulaires individuels que de nombre de visiteurs renseigné !');
                return $this->render('@LouvreBooking/layout.html.twig', array('form' => $form->createView(), 'daysOff' => $daysOff));
            }

            $dateVisit = $buyer->getDate()->format('d/m');
            $today = $currentDate->format('d/m');

            if ($dateVisit == $today && $buyer->getTypeTicket() === 'BJ')
            {
                $request->getSession()->getFlashBag()->add('wrongData', 'Vous passez commande après 14h00 ! Seul le billet demi-journée est valide.');
                return $this->render('@LouvreBooking/layout.html.twig', array('form' => $form->createView(), 'daysOff' => $daysOff));
            }

            $isBookingNumberExist = true;
            $setBookingNumber = '';
            while ($isBookingNumberExist !== null) {
                $setBookingNumber = $this->get('louvre_booking.booking_number')->defineBookingNumber($buyer, $currentDate);
                $isBookingNumberExist = $buyerRepository->findOneByBookingNumber($setBookingNumber);
            }

            $buyer->setTotalPrice($totalPrice);
            $request->getSession()->set('buyer', $buyer);

			return $this->render('@LouvreBooking/checkout.html.twig', array('buyer' => $buyer));
    	}

        return $this->render('@LouvreBooking/layout.html.twig', array('form' => $form->createView(), 'daysOff' => $daysOff));
    }

    public function paymentAction(Request $request)
    {
        if ($request->isMethod('POST'))
        {
            $buyer = $request->getSession()->get('buyer');
            $validPayment = $this->get('louvre_booking.stripe')->payment($buyer);
            if ($validPayment === true)
            {
                $sendEmail = $this->get('louvre_booking.mailer')->sendOrderSummary($buyer);

                $em = $this->getDoctrine()->getManager();
                $em->persist($buyer);
                $em->flush();

                $request->getSession()->getFlashBag()->add('booked', 'Votre réservation a bien été prise en compte !');
                return $this->redirectToRoute('louvre_booking_homepage');
            }
            else
            {
                $message = $validPayment;
                $request->getSession()->getFlashBag()->add('stripeError', $message);
                return $this->render('@LouvreBooking/checkout.html.twig', array('buyer' => $buyer));
            }
        }

        return $this->redirectToRoute('louvre_booking_homepage');
    }
}
