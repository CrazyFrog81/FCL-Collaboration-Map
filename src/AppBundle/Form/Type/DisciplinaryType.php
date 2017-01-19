<?php
// src/AppBundle/Form/Type/DisciplinaryType.php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Disciplinary;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class DisciplinaryType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add('disciplinary_background', EntityType::class, array(
      'class' => 'AppBundle:Disciplinary',
      'choice_label' => 'disciplinary_background',
      'choice_value' => 'disciplinary_background',
      'placeholder' => '--Select--',
      'label' => false,
      'query_builder' => function (EntityRepository $er) {
        return $er->createQueryBuilder('u')
            ->orderBy('u.disciplinary_background', 'ASC');
    },
    ));
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => Disciplinary::class,
    ));
  }
}
 ?>
