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

class RegisterController extends Controller
{
    /**
     * @Route("/register", name="user_register")
     * @Template()
     */
    public function registerAction(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('username', 'text')
            ->add('email', 'email')
            ->add('password', 'repeated', array('type' => 'password'))
            ->getForm();
        if ($request->getMethod('POST')) {
            $form->submit($request);
            if ($form->isValid()) {
                $data = $form->getData();
                $user = new User();
                $user->setUsername($data['username']);
                $user->setEmail($data['email']);
                $user->setPassword($this->encodePassword($user, $data['password']));
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                // We'll redirect the user next

                $url = $this->generateUrl('event');
                return $this->redirect($url);
            }
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
}