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
    public function getSecurityContext()
    {
        return $this->container->get('security.context');
    }

} 