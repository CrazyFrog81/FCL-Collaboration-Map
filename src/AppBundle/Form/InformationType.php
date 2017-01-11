<?php
// src/AppBundle/Form/InformationType.php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\CollaborationInformation;
use Symfony\Component\OptionResolver\OptionsResolver;

class InformationType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
    ->add('name', TextType::class)
    ->add('research_group', TextType::class)
    ->add('disciplinary_background', TextType::class)
    ->add('work_location', TextType::class)
    ->add('work_start_date', TextType::class)
    ->add('working_duration_before_join', TextType::class)
    ->add('academic_background', TextType::class)
    ->add('mother_tongue', LanguageType::class)
    ->add('gender', ChoiceType::class, array(
      'choices' => array(
        'Male' => 'Male',
        'Female' => 'Female'
      ),
      'required' => true,
      'placeholder' => 'Choose your gender',
      'empty_data' => null
    ))
    ->add('age', TextType::class)
    ->add('nationality', TextType::class)
    ->add('collaboration_with', TextType::class)
    ->add('project_name', TextType::class)
    ->add('project_completion_date', TextType::class)
    ->add('collaborated_before', ChoiceType::class, array(
      'choices' => array(
        'Yes' => 'Yes',
        'No' => 'No'
      ),
      'placeholder' => ' ',
      'empty_data' => null
    ))
    ->add('project_working_time', NumberType::class)
    ->add('expected_outcome', TextType::class)
    ->add('save', SubmitType::class, array('label' => 'Submit Survery'))
    ;
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'AppBundle\Entity\CollaborationInformation',
    ));
  }
}

 ?>
