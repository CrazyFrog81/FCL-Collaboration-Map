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

class ChoiceOtherNatType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add('Choices', ChoiceType::class, array(
      'label' => false,
      'choices' => array(
        'Australian' => 'Australian',
        'Chinese' => 'Chinese',
        'Colombian' => 'Colombian',
        'Dutch' => 'Dutch',
        'English' => 'English',
        'French' => 'French',
        'German' => 'German',
        'Indian' => 'Indian',
        'Indonesian' => 'Indonesian',
        'Iranian' => 'Iranian',
        'Italian' => 'Italian',
        'Japanese' => 'Japanese',
        'Mexican' => 'Mexican',
        'New Zealander' => 'New Zealander',
        'Russian' => 'Russian',
        'Serbian' => 'Serbian',
        'Singaporean' => 'Singaporean',
        'Spanish' => 'Spanish',
        'Swiss' => 'Swiss',
        'Taiwanese' => 'Taiwanese',
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
