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
use Symfony\Component\Form\CallbackTransformer;

class RadioOtherDisciplinaryType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add('RadioChoices', ChoiceType::class, array(
      'multiple' => true,
      'expanded' => true,
      'choices' => array(
        'Architecture' => 'Architecture',
        'Biology' => 'Biology',
        'Chemistry' => 'Chemistry',
        'Computer Science' => 'Computer Science',
        'Ecology' => 'Ecology',
        'Economics' => 'Economics',
        'Engineering' => 'Engineering',
        'Graphic designer' => 'Graphic designer',
        'Landscape architecture' => 'Landscape architecture',
        'Law' => 'Law',
        'Literature' => 'Literature',
        'Policy' => 'Policy',
        'Psychology' => 'Psychology',
        'Sociology' => 'Sociology',
        'Urban design and planning' => 'Urban design and planning',
        'Others' => null,
      )
  ));
    $builder->add('Others', TextType::class, array(
      'empty_data' => null,
      'required' => false,
      'label' => false,
    ));

    $builder->get('RadioChoices')->addModelTransformer(new CallbackTransformer(
      function($radioChoicesAsString) {
        return explode(',', $radioChoicesAsString);
      },
      function($radioChoicesAsArray) {
        return implode(',', $radioChoicesAsArray);
      }
    ));
  }
}
