<?php

namespace App\EventSubscriber;

use App\Entity\NodeVisitor;
use GraphAware\Neo4j\OGM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class SessSubscriber implements EventSubscriberInterface
{

    private $emg;

    public function __construct(EntityManagerInterface $emg)
    {
        $this->emg = $emg;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $session = $event->getRequest()->getSession();

        if (!$session->has('visitorId')) {
            $uniqVisitorId = uniqid();
            $session->set('visitorId', $uniqVisitorId);

            $visitorG = $this->emg->getRepository(NodeVisitor::class)->findOneBy(['name' => $uniqVisitorId]);

            if (!$visitorG) {
                $bart = new NodeVisitor();
                $bart->setName($uniqVisitorId);
                $this->emg->persist($bart);
                $this->emg->flush($bart);
            }

        }
    }

    public static function getSubscribedEvents()
    {
        return [
            'kernel.request' => 'onKernelRequest',
        ];
    }
}
