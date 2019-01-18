<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Property;
use App\Form\SearchFormType;

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

        //Le formulaire de recherche
        $form = $this->createForm(
            SearchFormType::class,
            null,
            [
                'action' => $this->generateUrl('search_property'),
                'method' => 'GET'
            ]
        );

        return $this->render('pages/index.html.twig', [
            'latest_properties' => $latest_properties,
            'form' => $form->createView()
        ]);
    }
}
