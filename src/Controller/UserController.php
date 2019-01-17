<?php

namespace App\Controller;

use App\Entity\Property;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class UserController extends AbstractController
{

    /**
     * Fetch all the properties for actual user log within the database and send them to the view to be showed the the user
     * @return Response
     * @Route("/user/properties", name="app_user_properties")
     */
    public function userProperties(UserInterface $user) : Response
    {

        $properties = $this->getDoctrine()
            ->getRepository(Property::class)
            ->findByUserId($user->getId());


        if (!$properties) {
            throw $this->createNotFoundException(
                'No property has been found'
            );
        }

        return $this->render('property/properties.html.twig', [
            'properties' => $properties
        ]);
    }
}