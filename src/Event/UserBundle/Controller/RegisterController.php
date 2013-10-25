<?php
/**
 * Created by PhpStorm.
 * User: shibly
 * Date: 10/24/13
 * Time: 6:33 PM
 */

namespace Event\UserBundle\Controller;


use Event\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Event\UserBundle\Form\RegisterFormType;

class RegisterController extends Controller
{
    /**
     * @Route("/register", name="user_register")
     * @Template()
     */
    public function registerAction(Request $request)
    {
        $user = new User();
        $form = $this->createRegisterForm($user);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $user = $form->getData();
            $user->setPassword($this->encodePassword($user, $user->getPlainPassword()));
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $request->getSession()->getFlashBag()
                ->add('success', 'Registration went super smooth !');

            // We'll redirect the user next

            $url = $this->generateUrl('event');
            return $this->redirect($url);
        }

        return array('form' => $form->createView());
    }

    /**
     * let's encode our password.
     * @param $user
     * @param $plainPassword
     * @return mixed
     */
    private function encodePassword($user, $plainPassword)
    {
        $encoder = $this->container->get('security.encoder_factory')
            ->getEncoder($user);

        return $encoder->encodePassword($plainPassword, $user->getSalt());
    }


    private function createRegisterForm(User $user)
    {
        $form = $this->createForm(new RegisterFormType(), $user,
            array(
                'action' => $this->generateUrl('event'),
                'method' => 'POST'
            ));
        return $form;

    }
}