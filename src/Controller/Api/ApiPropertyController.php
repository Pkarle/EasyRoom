<?php

namespace App\Controller\Api;

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

        $json_data = [];

        foreach ($properties as $key => $property) {

            $data = [
                'id' => $property->getId(),
                'name' => $property->getName(),
                'description' => $property->getDescription(),
                'maxNumberPerson' => $property->getMaxNumberPersons(),
                'postalCode' => $property->getPostalCode(),
                'region' => $property->getRegion(),
                'country' => $property->getCountry(),
                'typeProperty' => $property->getTypeProperty(),
                'whole' => $property->getWhole(),
                'pictures' => $property->getPictures(),
                'surface' => $property->getSurface()
            ];

            $json_data[] = $data;
        }

        if (count($json_data) == 0) {
            throw $this->createNotFoundException('Empty properties found');
        }

        return new JsonResponse($json_data);
    }

    /**
     * Ajax request allowing to get a single property using the property id
     * @Route("/api/properties/{id}", name="api_property")
     */
     public function api_property(int $id, Request $request)
     {
        if (!$request->isXmlHttpRequest()) {
            return $this->redirectToRoute('home');
        }

        $property = $this->getDoctrine()
            ->getRepository(Property::class)
            ->find($id);

        $data = [
            'id' => $property->getId(),
            'name' => $property->getName(),
            'description' => $property->getDescription(),
            'maxNumberPerson' => $property->getMaxNumberPersons(),
            'postalCode' => $property->getPostalCode(),
            'region' => $property->getRegion(),
            'country' => $property->getCountry(),
            'typeProperty' => $property->getTypeProperty(),
            'whole' => $property->getWhole(),
            'pictures' => $property->getPictures(),
            'surface' => $property->getSurface()
        ];

        if (!$property) {
            throw $this->createNotFoundException('Empty properties found');
        }

         return new JsonResponse($data);
    }
}
