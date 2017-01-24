<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class RadioOtherProjectType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add('RadioChoices', ChoiceType::class, array(
      'choices' => array(
        'Data sharing' => 'data sharing',
        'Expert analysis' => 'expert analysis',
        'Granted research proposal' => 'granted research proposal',
        'Joint publication' => 'joint publication',
        'Joint prototype' => 'joint prototype',
        'Research modelling' => 'research modelling',
      ),
      'expanded' => true,
      'multiple' => true,
      'label' => false,
    ));
    $builder->add('Others', TextType::class, array(
      'empty_data' => null,
      'required' => false,
      'label' => false,
    ));
  }
}


 ?>
