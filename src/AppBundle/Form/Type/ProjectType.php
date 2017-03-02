<?php
// src/AppBundle/Form/Type/ProjectType.php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use AppBundle\Form\Type\RadioOtherProjectType;
use AppBundle\Form\Type\CollaboratorType;
use AppBundle\Form\Type\ChoiceOtherProType;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Form\DataTransformer\ChoiceOtherProjectTransformer;

class ProjectType extends AbstractType
{
  private $manager;

   public function __construct(ObjectManager $manager)
   {
       $this->manager = $manager;
   }

  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
    ->add('name',ChoiceOtherProType::class, array(
      'label' => false,
    ))
      ->add('start_date', DateType::class, array(
        'placeholder' => array(
          'year' => '--Year--', 'month' => '--Month--',
        ),
        'days' => array(1),
        'years' => range(2015,2020),
        'label' => 'Starting date',
      ))
      ->add('project_duration', ChoiceType::class, array(
        'choices' => array(
          'Less than 6 months' => '< 6 months',
          '6 - 12 months' => '6 - 12 months',
          '12 months - 2 years' => '12 months - 2 years',
          'More than 2 years' => '> 2 years',
        ),
        'expanded' => true,
        'multiple' => false,
        'label' => 'Completion date',
      ))
      ->add('working_time', RangeType::class, array(
        'label' => 'Over the past six month, how much time on average you spent on this project?
        Answer percentage of your working time',
        'attr' => array(
          'min' => 0,
          'max' => 100,
          'style' => 'width:50%;',
          'class' => 'range_widget',
        )
      ));

    $builder->add('project_outcomes', RadioOtherProjectType::class, array(
      'label' => 'What are the expected outcomes from this presentation?',
    ));

    $builder->add('collaborators', CollectionType::class, array(
              'entry_type' => CollaboratorType::class,
              'entry_options' => array(
                'label' => 'Collaborator',
                'label_attr' => array(
                  'style' => 'font-size:14px; font-weight:bold;',
                  'class' => 'each_collab_label',
                ),
              ),
              'allow_delete' => true,
              'allow_add' => true,
              'by_reference' => false,
              'label' => false,
              'prototype' => true,
              'prototype_name' => '__collaborator__',
              'attr' => array(
                'class' => 'my-selector',
              )
            ));

    $builder->get('name')->addModelTransformer(new ChoiceOtherProjectTransformer($this->manager));

          }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => Project::class,
    ));
  }
}
