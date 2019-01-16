<?php

namespace App\Controller;

use App\Entity\Property;
use App\Form\CreatePropertyFormType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{
    /**
     * @Route("/property", name="property")
     */
    public function index()
    {
        return $this->render('property/index.html.twig', [
            'controller_name' => 'PropertyController',
        ]);
    }
    /**
     * @Route("/property/create", name="create_property")
     */
    public function createProperty(Request $request): Response
    {
        $property = new Property();
        $form = $this->createForm(CreatePropertyFormType::class, $property);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            var_dump($property);
        }

        return $this->render('property/create.html.twig', [
            'createPropertyForm' => $form->createView(),
        ]);
    }
}
