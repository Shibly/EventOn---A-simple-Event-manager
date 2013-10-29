<?php
/**
 * Created by PhpStorm.
 * User: shibly
 * Date: 10/29/13
 * Time: 3:57 PM
 */

namespace Event\EventBundle\Reporting;

use Doctrine\ORM\EntityManager;

class EventReportManager
{
    private $em;

    private $logger;

    public function setLogger($logger)
    {
        $this->logger = $logger;
    }

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getRecentlyUpdatedReport()
    {
        $events = $this->$em
            ->getRepository('EventBundle:Event')
            ->getRecentlyUpdatedEvents();

        $rows = array();
        foreach ($events as $event) {
            $data = array($event->getId(), $event->getName(), $event->getTime()->format('Y-m-d H:i:s'));

            $rows[] = implode(',', $data);
        }

        return implode("\n", $rows);

    }

    private function logInfo($message)
    {
        if ($this->logger) {
            $this->logger->info($message);
        }
    }
} 