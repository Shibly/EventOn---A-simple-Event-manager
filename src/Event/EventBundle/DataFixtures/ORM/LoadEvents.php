<?php


namespace Event\EventBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Event\EventBundle\Entity\Event;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadEvents extends AbstractFixture implements ContainerAwareInterface, OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param \Doctrine\Common\DataFixtures\Doctrine\Common\Persistence\ObjectManager|\Doctrine\Common\Persistence\ObjectManager $manager
     */
    private $container;

    function load(ObjectManager $manager)
    {
        $user = $this->getReference('user-user');
        $event1 = new Event();
        $event1->setName("My's birthday event")
            ->setLocation('Dhaka')
            ->setTime(new \DateTime('tomorrow noon'))
            ->setDetails('I love surprises !');
        $event1->setOwner($user);
        $manager->persist($event1);


        $event2 = new Event();
        $event2->setName("AngularJS meetup !")
            ->setLocation('Dhaka')
            ->setTime(new \DateTime('Thursday noon'))
            ->setDetails("The super heroic javaScript framework at it's glory !");
        $event2->setOwner($user);
        $manager->persist($event2);


        $event3 = new Event();
        $event3->setName("jQuery meetup !")
            ->setLocation('Dhaka')
            ->setTime(new \DateTime('Saturday noon'))
            ->setDetails("jQuery FTW !");
        $event3->setOwner($user);
        $manager->persist($event3);

        $event4 = new Event();
        $event4->setName("phpXperts")
            ->setLocation('Dhaka')
            ->setTime(new \DateTime('Tuesday noon'))
            ->setDetails("The annual PHP meetup");
        $event4->setOwner($user);
        $manager->persist($event4);

        $event5 = new Event();
        $event5->setName("node.js up and running")
            ->setLocation('Dhaka')
            ->setTime(new \DateTime('Thursday noon'))
            ->setDetails("Rule the web with node.js");
        $event5->setOwner($user);
        $manager->persist($event5);

        $event6 = new Event();
        $event6->setName("Everything about ExpressJS")
            ->setLocation('Dhaka')
            ->setTime(new \DateTime('Thursday noon'))
            ->setDetails("node.js MVC, delivered");
        $event6->setOwner($user);
        $manager->persist($event6);

        $event7 = new Event();
        $event7->setName("Dive into mongodb")
            ->setLocation('Dhaka')
            ->setTime(new \DateTime('Thursday noon'))
            ->setDetails("Dominate big data with nosql !");
        $event7->setOwner($user);
        $manager->persist($event7);


        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 20;
    }

    /**
     * Sets the Container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     *
     * @api
     */
    public function setContainer(ContainerInterface $container = null)
    {
        // TODO: Implement setContainer() method.
    }
}