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
        $event1->setName("Toma's birthday event")
            ->setLocation('Dhaka')
            ->setTime(new \DateTime('tomorrow noon'))
            ->setDetails('Toma loves surprise !');
        $event1->setOwner($user);
        $manager->persist($event1);


        $event2 = new Event();
        $event2->setName("Rebellion Fundraiser Bake Sale!")
            ->setLocation('Endor')
            ->setTime(new \DateTime('Thursday noon'))
            ->setDetails('Ewok pies! Support the rebellion!');
        $event2->setOwner($user);
        $manager->persist($event2);

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