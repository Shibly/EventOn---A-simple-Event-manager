<?php
/**
 * Created by PhpStorm.
 * User: shibly
 * Date: 10/27/13
 * Time: 10:31 PM
 */

namespace Event\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * @return \Symfony\Component\Security\Core\SecurityContext
     */
    public function getSecurityContext()
    {
        return $this->container->get('security.context');
    }

    /**
     * @return \Event\UserBundle\Entity\User
     */
    public function getUser()
    {
        return parent::getUser();
    }

} 