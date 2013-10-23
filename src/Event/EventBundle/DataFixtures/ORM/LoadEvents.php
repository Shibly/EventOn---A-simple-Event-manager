<?php


namespace Event\EventBundle\DataFixtures\ORM;
use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Event\EventBundle\Entity\Event;

class LoadEvents implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param \Doctrine\Common\DataFixtures\Doctrine\Common\Persistence\ObjectManager|\Doctrine\Common\Persistence\ObjectManager $manager
     */

    function load(ObjectManager $manager)
    {
        $event1 = new Event();
        $event1->setName("Toma's birthday event")
            ->setLocation('Dhaka')
            ->setTime(new \DateTime('tomorrow noon'))
            ->setDetails('Toma loves surprise !');
        $manager->persist($event1);


        $event2 = new Event();
        $event2->setName("Rebellion Fundraiser Bake Sale!")
            ->setLocation('Endor')
            ->setTime(new \DateTime('Thursday noon'))
            ->setDetails('Ewok pies! Support the rebellion!');
        $manager->persist($event2);

        $manager->flush();
    }
}