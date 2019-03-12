<?php

namespace App\Entity;

use App\Entity\NodeProperty;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use GraphAware\Neo4j\OGM\Annotations as OGM;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @OGM\Node(label="Visitor")
 */
class NodeVisitor
{
    /** @OGM\GraphId() */
    protected $id;

    /** @OGM\Property(type="string") */
    protected $name;

    /**
     * @var Property[]|Collection
     *
     * @OGM\Relationship(relationshipEntity="App\Entity\NodePropertyConsultation", type="CONSULT", direction="OUTGOING", collection=true, mappedBy="visitor")
     */
    protected $consultations;

    /**
     * @return Property[]|Collection
     */
    public function getConsultations(): ?Collection
    {
        return $this->consultations;
    }

    /**
     * NodeVisitor constructor.
     * @param Property[]|Collection $consultations
     */
    public function __construct()
    {
        $this->consultations = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }


}