<?php
/**
 * Created by PhpStorm.
 * User: shibly
 * Date: 10/24/13
 * Time: 7:59 PM
 */

namespace Event\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegisterFormType extends AbstractType
{

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'user_register';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', 'text', array(
                'pattern' => '[a-zA-Z0-9]' // The username will only accept letter or integer number
            ))
            ->add('email', 'email')
            ->add('plainPassword', 'repeated', array(
                    'type' => 'password'
                )
            );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Event\UserBundle\Entity\User'
        ));
    }
}