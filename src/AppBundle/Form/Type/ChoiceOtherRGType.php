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

class ChoiceOtherRGType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add('Choices', ChoiceType::class, array(
      'data' => ' ',
      'label' => false,
      'choices'=>array(
      'Scenario 1.1' => 'Scenario 1.1',
      'Scenario 1.2' => 'Scenario 1.2',
      'Scenario 1.3' => 'Scenario 1.3',
      'Scenario 1.4' => 'Scenario 1.4',
      'Scenario 2.1' => 'Scenario 2.1',
      'Scenario 2.2' => 'Scenario 2.2',
      'Scenario 2.3' => 'Scenario 2.3',
      'Scenario 2.4' => 'Scenario 2.4',
      'Scenario 3.1' => 'Scenario 3.1',
      'Scenario 3.2' => 'Scenario 3.2',
      'Scenario 3.3' => 'Scenario 3.3',
      'Scenario 3.4' => 'Scenario 3.4',
      'Cooler Singapore' => 'Cooler Singapore',
      '3 for 2' => '3 for 2',
      'Robotic tiling' => 'Robotic tiling',
      'CIVAL' => 'CIVAL',
      'Others' => ' ',
    )
    ));
    $builder->add('Others', TextType::class, array(
      'empty_data' => null,
      'required' => false,
      'label' => false,
    ));
  }
}


 ?>
