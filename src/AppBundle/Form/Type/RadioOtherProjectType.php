<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
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
        'Other' => 'Other',
      ),
      'expanded' => true,
      'multiple' => true,
      'label' => false,
    ))
    ->add('Others', TextType::class, array(
      'required' => false,
      'label' => false,
    ))
    ->addModelTransformer(new CallbackTransformer(
      function($data)
      {
        if (is_array($data[0])){
          return (array('RadioChoices' => $data[0], 'Others' => $data[1]));
        } else {
        return array('RadioChoices' => $data, 'Others' => null);}
      },
      function ($data)
      {
        if (in_array('Other', $data['RadioChoices'], true)) {
          return array($data['RadioChoices'], ($data['Others']));
        }
        else{
          return $data['RadioChoices'];
        }
      }
    ));
  }
}


 ?>
