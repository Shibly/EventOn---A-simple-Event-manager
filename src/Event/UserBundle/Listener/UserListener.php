<?php
/**
 * Created by PhpStorm.
 * User: shibly
 * Date: 11/9/13
 * Time: 5:52 PM
 */

namespace Event\UserBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Event\UserBundle\Entity\User;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;


class UserListener
{
    private $encoderFactory;

    public function __Construct(EncoderFactory $encoderFactory)
    {
        $this->encoderFactory = $encoderFactory;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if ($entity instanceof User) {
            $this->handleEvent($entity);
        }
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if ($entity instanceof User) {
            if ($this->handleEvent($entity)) {
                $em = $args->getEntityManager();
                $classMetaData = $em->getClassMetadata(get_class($entity));
                $em->getUnitOfWork()->recomputeSingleEntityChangeSet($classMetaData, $entity);
            }
        }
    }

    private function handleEvent(User $user)
    {
        if (!$user->getPlainPassword()) {
            return false;
        }
        $encoder = $this->encoderFactory->getEncoder($user);
        $password = $encoder->encodePassword($user->getPlainPassword(), $user->getSalt());
        $user->setPassword($password);
        return true;

    }

} 