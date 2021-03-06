<?php

namespace Glavweb\UserBundle\Form\Type;

use FOS\UserBundle\Form\Type\RegistrationFormType as BaseRegistrationFormType;
use Symfony\Component\Form\FormBuilderInterface;
use Glavweb\UserBundle\Entity\User;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints;

/**
 * Class RegistrationFormType
 * @package Glavweb\UserBundle\Form\Type
 */
class RegistrationFormType extends BaseRegistrationFormType
{
    /**
     * Build form
     *
     * @param FormBuilderInterface $formBuilder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $formBuilder, array $options)
    {
        $formBuilder
            ->add('username', null, array(
                'label' => false,
                'attr' => array(
                    'placeholder' => 'form.placeholder.username'
                )
            ))
            ->add('email', 'email', array(
                'label' => false,
                'attr' => array(
                    'placeholder' => 'form.placeholder.email'
                )
            ))
            ->add('plainPassword', 'repeated', array(
                'type'            => 'password',
                'options'         => array('translation_domain' => 'FOSUserBundle'),
                'first_options'   => array(
                    'label' => false,
                    'attr' => array(
                        'placeholder' => 'form.placeholder.password'
                    )
                ),
                'second_options'  => array(
                    'label' => false,
                    'attr' => array(
                        'placeholder' => 'form.placeholder.password_confirmation'
                    )
                ),
                'invalid_message' => 'fos_user.password.mismatch',
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver->setDefaults(array(
            'translation_domain' => 'FOSUserBundle'
        ));
    }

    /**
     * Returns form name
     *
     * @return string
     */
    public function getName()
    {
        return 'glavweb_user_registration';
    }
}