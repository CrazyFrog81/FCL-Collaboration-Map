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

class RadioOtherProjectType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add('RadioChoices', ChoiceType::class, array(
      'choices' => array(
        'Data sharing' => 'Data sharing',
        'Expert analysis' => 'Expert analysis',
        'Granted research proposal' => 'Granted research proposal',
        'Joint publication' => 'Joint publication',
        'Joint prototype' => 'Joint prototype',
        'Research modelling' => 'Research modelling',
        'Others' => null,
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


 ?>
