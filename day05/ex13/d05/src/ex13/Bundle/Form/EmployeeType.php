<?php

namespace ex13\Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Doctrine\ORM\EntityRepository;

class EmployeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', 'text')
            ->add('lastname', 'text')
            ->add('email', 'email')
            ->add('birthdate', 'date', [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ])
            ->add('active', 'checkbox', [
                'required' => false,
            ])
            ->add('employedSince', 'date', [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ])
            ->add('employedUntil', 'date', [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'required' => false,
            ])
            ->add('hours', 'choice', [
                'choices' => [
                    '8' => '8 hours',
                    '6' => '6 hours',
                    '4' => '4 hours',
                ],
                'required' => true,
            ])
            ->add('salary', 'integer')
            ->add('position', 'choice', [
                'choices' => [
                    'manager' => 'Manager',
                    'account_manager' => 'Account Manager',
                    'qa_manager' => 'QA Manager',
                    'dev_manager' => 'Dev Manager',
                    'ceo' => 'CEO',
                    'coo' => 'COO',
                    'backend_dev' => 'Backend Developer',
                    'frontend_dev' => 'Frontend Developer',
                    'qa_tester' => 'QA Tester',
                ],
            ])
            ->add('manager', 'entity', [
                'class' => 'ex13Bundle:Employee',
                'choice_label' => 'firstname',
                'required' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('e')
                        ->orderBy('e.firstname', 'ASC');
                },
            ]);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'ex13\Bundle\Entity\Employee',
        ]);
    }

    public function getName()
    {
        return 'ex13bundle_employee';
    }
}

?>