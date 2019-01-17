<?php

namespace App\Controller\Property;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Property;
use Symfony\Component\HttpFoundation\Request;

class ApiPropertyController extends AbstractController
{

    /**
     * Ajax request allowing to get a bunch of json data containing all the properties
     * @Route("/api/properties", name="api_properties")
     */
    public function api_properties(Request $request)
    {
        if (!$request->isXmlHttpRequest()) {
            return $this->redirectToRoute('home');
        }

        $properties = $this->getDoctrine()
            ->getRepository(Property::class)
            ->findAll();

        return new JsonResponse($properties);
    }

    /**
     * Ajax request allowing to get a single property using the property id
     * @Route("/api/properties/{id}", name="api_property")
     */
     public function api_property(int $id) : ?JsonResponse
     {
        if (!$request->isXmlHttpRequest()) {
            return $this->redirectToRoute('home');
        }

         $properties = $this->getDoctrine()
             ->getRepository(Property::class)
             ->find($id);

         return new JsonResponse($properties);
    }
}
