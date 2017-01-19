<?php
// src/AppBundle/Form/Type/ResearchGroupType.php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Work;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class ResearchGroupType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('research_group', EntityType::class,array(
        'class' => 'AppBundle:Work',
        'choice_label' => 'research_group',
        'choice_value' => 'research_group',
        'label' => false,
        'placeholder' => '--Select--',
        'query_builder' => function (EntityRepository $er) {
        return $er->createQueryBuilder('u')
            ->orderBy('u.research_group', 'ASC');
    },
      ));
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => Work::class,
    ));
  }
}
 ?>
