<?php

namespace Event\EventBundle\Controller;

//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Event\EventBundle\Controller\Controller;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('EventBundle:Default:index.html.twig', array('name' => $name));
    }
}
