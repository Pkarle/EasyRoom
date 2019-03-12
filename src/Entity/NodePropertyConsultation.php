<?php

namespace App\Entity;

use GraphAware\Neo4j\OGM\Annotations as OGM;

/**
 * @OGM\RelationshipEntity(type="CONSULT")
 */
class NodePropertyConsultation
{
    /**
     * @OGM\GraphId()
     */
    private $id;

    /**
     * @OGM\StartNode(targetEntity="NodeVisitor")
     */
    private $visitor;


    /**
     * @OGM\EndNode(targetEntity="NodeProperty")
     */
    private $property;

    /**
     * @OGM\Property(type="int")
     */
    private $qte;

    public function __construct($visitor, $property)
    {
        $this->property = $property;
        $this->visitor = $visitor;
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
    public function getVisitor()
    {
        return $this->visitor;
    }

    /**
     * @param mixed $visitor
     */
    public function setVisitor($visitor): void
    {
        $this->visitor = $visitor;
    }

    /**
     * @return mixed
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * @param mixed $property
     */
    public function setProperty($property): void
    {
        $this->property = $property;
    }

    /**
     * @return mixed
     */
    public function getQte()
    {
        return $this->qte;
    }

    /**
     * @param mixed $qte
     */
    public function setQte($qte): void
    {
        $this->qte = $qte;
    }


}