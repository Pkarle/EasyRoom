<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Property;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $latest_properties = $entityManager->getRepository(Property::class)
            ->findLatestProperty();

        return $this->render('pages/index.html.twig', [
            'latest_properties' => $latest_properties
        ]);
    }
}
