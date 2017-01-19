<?php

// src/AppBundle/Form/BackgroundInformationType.php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use AppBundle\Entity\Disciplinary;
use AppBundle\Entity\Work;
use AppBundle\Entity\Individual;
use AppBundle\Form\Type\DisciplinaryType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\LanguageType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

class BackgroundInformationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $builder
        ->add('disciplinary_backgrounds', CollectionType::class, array(
            'entry_type' => DisciplinaryType::class,
            'by_reference' => false,
            'allow_add' => true,
            'label' => 'What is (are) your disciplinary background(s)?',
            'entry_options' => array('label' => false),
        ))
        ->add('location', ChoiceType::class, array(
          'label' => 'Where do you work?',
          'placeholder' => '--Select--',
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
        ->add('work_duration_in_fcl', ChoiceType::class, array(
          'label' => 'How long have you been working as a researcher* before joining FCL?',
          'choices' => array(
            'Less than 1 year' => '<1',
            '1-2 years' => '1-2',
            '2-5 years' => '2-5',
            '5-10 years' => '5-10',
            'More than 10 years' => '>10',
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
        ->add('mother_tongue', LanguageType::class, array(
        'label' => 'Mother tongue',
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
         ->add('nationality', ChoiceType::class, array(
           'choices' => array(
             'Australian' => 'Australian',
             'Chinese' => 'Chinese',
             'Colombian' => 'Colombian',
             'Dutch' => 'Dutch',
             'English' => 'English',
             'French' => 'French',
             'German' => 'German',
             'Indian' => 'Indian',
             'Indonesian' => 'Indonesian',
             'Iranian' => 'Iranian',
             'Italian' => 'Italian',
             'Japanese' => 'Japanese',
             'Mexican' => 'Mexican',
             'New Zealander' => 'New Zealander',
             'Russian' => 'Russian',
             'Serbian' => 'Serbian',
             'Singaporean' => 'Singaporean',
             'Spanish' => 'Spanish',
             'Swiss' => 'Swiss',
             'Taiwanese' => 'Taiwanese',
             'Others' => 'Others',
           )
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
