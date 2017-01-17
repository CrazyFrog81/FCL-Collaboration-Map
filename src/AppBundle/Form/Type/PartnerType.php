<?php
// src/AppBundle/Form/Type/PartnerType.php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Partner;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PartnerType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add('name')
            ->add('collaborated_before');
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => Partner::class,
    ));
  }
}
 ?>
