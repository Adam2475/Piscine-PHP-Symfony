<?php

namespace ex03\Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('name')
            ->add('email')
            ->add('enable', 'checkbox', ['required' => false])
            ->add('birthdate', 'datetime')
            ->add('address', 'textarea')
            ->add('save', 'submit');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'ex03\Bundle\Entity\User',
        ]);
    }

    public function getName()
    {
        return 'user';
    }
}





?>