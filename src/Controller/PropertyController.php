<?php

namespace App\Controller;

use App\Entity\NodeProperty;
use App\Entity\NodePropertyConsultation;
use App\Entity\NodeVisitor;
use GraphAware\Neo4j\OGM\EntityManager;
use App\Entity\Property;
use App\Form\CreatePropertyFormType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use phpDocumentor\Reflection\Types\Void_;
use Symfony\Component\Security\Core\User\UserInterface;
use GraphAware\Neo4j\OGM\EntityManagerInterface;

class PropertyController extends AbstractController
{
    /**
     * Fetch all the properties within the database and send them to the view to be showed the the user
     * @return Response
     * @Route("/properties", name="app_properties")
     */
    public function properties(): Response
    {

        $properties = $this->getDoctrine()
            ->getRepository(Property::class)
            ->findAll();


        if (!$properties) {
            throw $this->createNotFoundException(
                'No property has been found'
            );
        }

        return $this->render('property/properties.html.twig', [
            'properties' => $properties
        ]);
    }

    /**
     * Fetch the right property using the property id
     * @return Response
     * @Route("/properties/{id}", name="app_properties_entry")
     */
    public function property(int $id, EntityManagerInterface $emg)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $property = $entityManager->getRepository(Property::class)
            ->find($id);

        if (!$property) {
            throw $this->createNotFoundException('The given id is wrong');
        }

        //$visitorRepo = $emg->getRepository(NodeVisitor::class);
        //$consultationRepo = $emg->getRepository(NodePropertyConsultation::class);

        //$NodeProperty = $visitorRepo->findOneBy(['name' => 'Grande maison avec piscine']);

        //$NodeVisitor->getProperties()->add($NodeProperty);
        //$NodeProperty->getVisitors()->add($NodeVisitor);


        $visitorG = $emg->getRepository(NodeVisitor::class)->find(24);
        $propertyG = $emg->getRepository(NodeProperty::class)->find(88);

        //$propertyRepo = $emg->getRepository(NodeProperty::class);
        //$NodeProperty = $propertyRepo->findOneBy(['name' => 'Grand appartement']);

        if ($visitorG instanceof NodeVisitor && $propertyG instanceof NodeProperty) {
            $nodeConsultation = new NodePropertyConsultation($visitorG, $propertyG);

            $visitorG->getConsultations()->add($nodeConsultation);
            $propertyG->getConsultations()->add($nodeConsultation);
            //$visitorG->getConsultations().add($nodeConsultation);
            $emg->persist($nodeConsultation);
            $emg->persist($visitorG);
            $emg->persist($propertyG);
            $emg->flush();
        }


        return $this->render('property/property.html.twig', ['property' => $property]);
    }

    /**
     * @Route("/property/create", name="create_property")
     */
    public function createProperty(Request $request, UserInterface $user, EntityManagerInterface $emg): Response
    {
        $property = new Property();
        $form = $this->createForm(CreatePropertyFormType::class, $property);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $files = $property->getPictures();
            $newNames = [];

            foreach ($files as $key => $file) {
                $fileName = $this->generateUniqueFileName() . '.' . $file->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $file->move(
                        $this->getParameter('property_pictures_directory'),
                        $fileName
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                array_push($newNames, $fileName);
            }

            $property->setPictures($newNames);
            $property->setUser($user);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($property);

            if (!in_array('ROLE_HOTE', $user->getRoles())) {
                $user->setRoles(['ROLE_HOTE']);
                $entityManager->persist($user);
            }

            $bart = new NodeProperty();
            $bart->setName($property->getName());
            $emg->persist($bart);
            $emg->flush($bart);

            $entityManager->flush();

            return $this->redirectToRoute('app_properties');

        }

        return $this->render('property/create.html.twig', [
            'createPropertyForm' => $form->createView(),
        ]);
    }

    /**
     * Generate a uniqGrue file name
     * @return string
     */
    private function generateUniqueFileName(): string
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }
}
