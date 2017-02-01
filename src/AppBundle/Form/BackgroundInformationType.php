<?php

// src/AppBundle/Form/BackgroundInformationType.php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use AppBundle\Entity\Individual;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\LanguageType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use AppBundle\Form\Type\RadioOtherDisciplinaryType;
use AppBundle\Form\Type\ChoiceOtherNatType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class BackgroundInformationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $builder
        ->add('disciplinary_backgrounds', RadioOtherDisciplinaryType::class, array(
            'label' => 'What is (are) your disciplinary background(s)?',
        ))

        ->add('locations', ChoiceType::class, array(
          'label' => 'Where do you work?',
          'placeholder' => '--Select--',
          'multiple' => true,
          'expanded' => true,
          'choices' => array(
            'FCL level 6' => 'FCL level 6',
            'FCL level 15' => 'FCL level 15',
            'Other location in CREATE' => 'Other location in CREATE',
            'ETH Zurich' => 'ETH Zurich',
            'EPFL' => 'EPFL',
            'NUS' => 'NUS',
            'SUTD' => 'SUTD',
            'SMU' => 'SMU',
          ),
        ))
        ->add('start_date', BirthdayType::class, array(
          'label' => 'When did you start working in/with FCL?',
          'days' => array(1),
          'years' => range(1990,2017),
        ))
        ->add('before_fcl', ChoiceType::class, array(
          'label' => 'How long have you been working as a researcher* before joining FCL?',
          'choices' => array(
            'Less than 1 year' => '< 1 year',
            '1-2 years' => '1-2 years',
            '2-5 years' => '2-5 years',
            '5-10 years' => '5-10 years',
            'More than 10 years' => '>10 years',
          ),
          'expanded' => true,
          'multiple' => false,
        ))
        ->add('academic_background', ChoiceType::class, array(
          'choices' => array(
            'Bachelor Degree' => 'bachelor',
            'Master Degree' => 'master',
            'PhD Degree' => 'phD',
          ),
          'expanded' => true,
          'multiple' => false,
          'label' => 'What is your highest degree?',
        ))
        ->add('mother_tongues', LanguageType::class, array(
              'attr' => array(
                'class' => 'mother_tongues',
              ),
              'label' => 'Mother tongue(s)',
              'multiple' => 'multiple',
              'expanded' => false,
              'preferred_choices' => array('ar','zh','nl','en','fr','de','hi','id','it','ja','ru','es','ms'),
            ))
        ->add('gender', ChoiceType::class, array(
          'choices' => array(
            'Female' => 'female',
            'Male' => 'male',
          ),
          'expanded' => true,
          'multiple' => false,
        ))
        ->add('age', ChoiceType::class, array(
          'choices' => array(
            '20-30 y.o' => '20-30',
            '31-40 y.o' => '31-40',
            '41-50 y.o' => '41-50',
            '51 y.o and beyond' => '>=51',
          ),
          'expanded' => true,
          'multiple' => false,
        ))
         ->add('nationality', ChoiceOtherNatType::class,array(
           'label' => 'Nationality',
         ));

         $builder->get('nationality')->addModelTransformer(new CallbackTransformer(
           function($nationalityAsString) {
             return explode(' ', $nationalityAsString);
           },
           function($nationalityAsArray) {
             return implode(' ', $nationalityAsArray);
           }
         ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
      $resolver->setDefaults(array(
        'data_class' => 'AppBundle\Entity\Individual'
      ));
    }
}

 ?>
