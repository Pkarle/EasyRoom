<?php

namespace App\Entity;
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