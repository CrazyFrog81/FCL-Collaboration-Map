<?php
// src/AppBundle/Form/Type/DisciplinaryType.php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Disciplinary;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DisciplinaryType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add('disciplinary_background');
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => Disciplinary::class,
    ));
  }
}
 ?>
