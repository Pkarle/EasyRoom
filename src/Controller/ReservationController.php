<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\CreateReservationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/reservation", name="reservation")
 */
class ReservationController extends AbstractController
{
    /**
     * @Route("/", name="reservationIndex")
     */
    public function index()
    {
        return $this->render('reservation/index.html.twig', [
            'controller_name' => 'ReservationController',
        ]);
    }

    /**
     * @Route("/create", name="create_eservation")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createReservation(Request $request)
    {
        $reservation = new Reservation();
        $form = $this->createForm(CreateReservationFormType::class, $reservation );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reservation);
            $entityManager->flush();
        }
        return $this->render('property/create.reservation.html.twig', [
            'reservation'=>$reservation,
            'createReservationForm' => $form->createView(),
            ]);
    }
}
