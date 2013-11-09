<?php
/**
 * Created by PhpStorm.
 * User: shibly
 * Date: 10/31/13
 * Time: 12:37 AM
 */

namespace Event\UserBundle\Controller;

use Event\EventBundle\Controller\Controller as BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AdminController extends BaseController
{
    /**
     * Let's list all users
     * @Template()
     * @Route("/admin", name="admin")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('UserBundle:User')->findAll();
        return array('users' => $users);
    }

} 