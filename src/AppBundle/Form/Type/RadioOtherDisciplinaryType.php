<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\CallbackTransformer;

class RadioOtherDisciplinaryType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add('RadioChoices', ChoiceType::class, array(
      'multiple' => true,
      'expanded' => true,
      'required' => true,
      'empty_data' => null,
      'choices' => array(
        'Architecture' => 'Architecture',
        'Art' => 'Art',
        'Biology' => 'Biology',
        'Chemistry' => 'Chemistry',
        'Computer science' => 'Computer science',
        'Ecology' => 'Ecology',
        'Economics' => 'Economics',
        'Engineering' => 'Engineering',
        'Graphic design' => 'Graphic design',
        'History' => 'History',
        'Landscape architecture' => 'Landscape architecture',
        'Law' => 'Law',
        'Literature' => 'Literature',
        'Policy' => 'Policy',
        'Psychology' => 'Psychology',
        'Sociology' => 'Sociology',
        'Urban design and planning' => 'Urban design and planning',
        'Other' => 'Other',
      )
  ))
   ->add('Others', TextType::class, array(
      'required' => true,
      'label' => false,
      'attr' => array(
        'style' => 'width:50%',
      ),
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
