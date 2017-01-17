<?php
// src/AppBundle/Form/Type/ProjectType.php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Project;
use AppBundle\Form\Type\ProjectOutcomeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ProjectType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add('name')
            ->add('completion_date')
            ->add('working_time')
            ->add('project_outcomes', CollectionType::class, array(
                'entry_type' => ProjectOutcomeType::class,
                'entry_options' => array('label' => false),
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
