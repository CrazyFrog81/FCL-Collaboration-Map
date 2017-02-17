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
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use AppBundle\Form\Type\RadioOtherProjectType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use AppBundle\Form\Type\CollaboratorType;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Form\Type\ChoiceOtherProType;


class ProjectType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
    ->add('name',ChoiceOtherProType::class, array(
      'label' => false,
    ))
      ->add('start_date', DateType::class, array(
        'days' => array(1),
        'years' => range(2015,2020),
        'label' => 'Starting date',
      ))
      ->add('completion_date', DateType::class, array(
        'label' => 'Completion date',
        'years' => range(2015,2020),
        'days' => array(1),
        'empty_data' => array('year' => '----', 'months' => '----', 'day' => false),
      ))
      ->add('working_time', RangeType::class, array(
        'label' => 'Over the past six month, how much time on average you spent on this project?
        Answer percentage of your working time',
        'attr' => array(
          'min' => 0,
          'max' => 100,
        )
      ));

    $builder->add('project_outcomes', RadioOtherProjectType::class, array(
      'label' => 'What are the expected outcomes from this presentation?',
    ));

    $builder->add('collaborators', CollectionType::class, array(
              'entry_type' => CollaboratorType::class,
              'entry_options' => array(
                'label' => 'Collaborator',
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
          }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => Project::class,
    ));
  }
}
 ?>
