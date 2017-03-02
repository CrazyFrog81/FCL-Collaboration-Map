<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\CallbackTransformer;

class RadioOtherProjectType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add('RadioChoices', ChoiceType::class, array(
      'choices' => array(
        'Data sharing' => 'Data sharing',
        'Expertise contribution' => 'Expertise contribution',
        'Granted research proposal' => 'Granted research proposal',
        'Joint publication' => 'Joint publication',
        'Joint prototype' => 'Joint prototype',
        'Other' => 'Other',
      ),
      'expanded' => true,
      'multiple' => true,
      'label' => false,
    ))
    ->add('Others', TextType::class, array(
      'required' => true,
      'label' => false,
      'attr' => array(
        'placeholder' => 'If others, please specify here',
        'style' => 'width:50%',
      )
    ))
    ->addModelTransformer(new CallbackTransformer(
      function($data)
      {
        if(empty($data) == 1)
        {
          return $data;
        }
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
