<?php

namespace App\Controller;


use App\Entity\NodeVisitor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Property;
use GraphAware\Neo4j\OGM\EntityManagerInterface;


class IndexController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(EntityManagerInterface $emg)
    {


        //return new JsonResponse([]);

        $entityManager = $this->getDoctrine()->getManager();
        $latest_properties = $entityManager->getRepository(Property::class)
            ->findLatestProperty();

        return $this->render('pages/index.html.twig', [
            'latest_properties' => $latest_properties
        ]);
    }
}
