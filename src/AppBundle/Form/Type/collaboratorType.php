<?php
// src/AppBundle/Form/Type/collaboratorType.php

namespace AppBundle\Form\Type;

use AppBundle\Entity\collaborator;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class collaboratorType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('name', EntityType::class, array(
        'class' => 'AppBundle:collaborator',
        'choice_label' => 'name',
        'choice_value' => 'name',
        'label' => 'Who are you collaborating with?',
        'placeholder' => '--Select--',
        'query_builder' => function (EntityRepository $er) {
        return $er->createQueryBuilder('u')
            ->orderBy('u.name', 'ASC');
    },
      ))
      ->add('collaborated_before',ChoiceType::class, array(
        'choices' => array(
          'Yes' => 'yes',
          'No' => 'no',
        ),
        'expanded' => true,
        'multiple' => false,
        'label' => 'Have you collaborated with this person before FCL?'
      ));
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => collaborator::class,
    ));
  }
}
 ?>
