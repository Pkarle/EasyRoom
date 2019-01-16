<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProposalController extends AbstractController
{
    /**
     * @Route("/proposal", name="proposal")
     */
    public function index()
    {
        return $this->render('proposal/index.html.twig', [
            'controller_name' => 'ProposalController',
        ]);
    }
}
