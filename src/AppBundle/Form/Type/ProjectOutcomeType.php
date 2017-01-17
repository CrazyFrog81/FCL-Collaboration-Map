<?php
// src/AppBundle/Form/Type/ProjectOutcomeType.php

namespace AppBundle\Form\Type;

use AppBundle\Entity\ProjectOutcome;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectOutcomeType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add('expected_outcome');
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => ProjectOutcome::class,
    ));
  }
}
 ?>
