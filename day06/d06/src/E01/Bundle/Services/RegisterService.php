<?php

namespace E01\Bundle\Services;

// including forms
use Symfony\Component\Form\Forms;
// including form types
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

// import form builder
// use Symfony\Component\Form\FormBuilderInterface;
// import form factory (to use forms in services)
use Symfony\Component\Form\FormFactoryInterface;

class RegisterService
{
    public function __construct(FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
    }
    
    public function createForm()
    {
        $form = $this->formFactory->createBuilder()
            ->add('username', TextType::class, [
                'label' => 'Username'
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Password'
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email'
            ])
        ->getForm();
        return ($form);
    }
}

?>