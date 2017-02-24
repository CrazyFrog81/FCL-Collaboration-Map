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

class ChoiceOtherRGType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add('Choices', ChoiceType::class, array(
      'label' => false,
      'placeholder' => '-- Select --',
      'by_reference' => false,
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
      'Robotic Tiling' => 'Robotic Tiling',
      'CIVAL' => 'CIVAL',
      'Other' => 'Other',
    )
    ))
    ->add('Others', TextType::class, array(
      'required' => true,
      'label' => false,
    ))
    ->addModelTransformer(new CallbackTransformer(
      function($data)
      {
        if($data == null)
        {
          return array('Choices' => null, 'Others' => null);
        }
        if (in_array($data,
        array(
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
        )
        , true)){
          return array('Choices' => $data, 'Others' => null);
        } else {
        return array('Choices' => 'Other', 'Others' => $data);}
      },
      function ($data)
      {
        if ('Other' === $data['Choices']) {
          return $data['Others'];
        }

        return $data['Choices'];
      }
    ));
  }

  public function setDefaultOptions(OptionsResolverInterface $resolver)
  {
    $resolver->setRequired(array('choices'));
    $resolver->setAllowedTypes(array('choices' => 'array'));
  }

  public function getParent()
  {
    return FormType::class;
  }
}



 ?>
