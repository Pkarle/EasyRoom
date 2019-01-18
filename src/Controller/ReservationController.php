<?php

namespace App\Controller;

use App\Form\CreateReservationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ReservationController extends AbstractController
{
    /**
     * @Route("/reservation", name="reservation")
     */
    public function index()
    {
        return $this->render('reservation/index.html.twig', [
            'controller_name' => 'ReservationController',
        ]);
    }

    /**
     * @Route("/reservation/create", name="create_eservation")
     * @param Request $request
     * @return Response
     */
    public function createReservation(Request $request): Response
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
