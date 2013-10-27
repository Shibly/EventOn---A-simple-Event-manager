<?php
/**
 * Created by PhpStorm.
 * User: shibly
 * Date: 10/24/13
 * Time: 6:33 PM
 */

namespace Event\UserBundle\Controller;


use Event\UserBundle\Entity\User;
//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Event\UserBundle\Form\RegisterFormType;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\User\UserInterface;
use Event\EventBundle\Controller\Controller;

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

            /**
             * Now we'll authenticate the user and alg then in the system and in the same time
             * we'll redirect them to the home page
             */
            $this->authenticateUser($user);
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

    /**
     * @param User $user
     * @return \Symfony\Component\Form\Form
     */
    private function createRegisterForm(User $user)
    {
        $form = $this->createForm(new RegisterFormType(), $user,
            array(
                'action' => $this->generateUrl('event'),
                'method' => 'POST'
            ));
        return $form;

    }

    // Create an authentication package, called a token and pass it off to Symfony’s security system. Now
    // we are going to call this method after registration to automatically log the user in

    private function authenticateUser(UserInterface $user)
    {
        $provider_key = 'secured_area'; // Firewall name
        $token = new UsernamePasswordToken($user, null, $provider_key, $user->getRoles());
        $this->getSecurityContext()->setToken($token);
    }
}