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

class ChoiceOtherNatType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add('Choices', ChoiceType::class, array(
      'label' => false,
      'placeholder' => '--Select--',
      'attr' => array(
        'style' => 'width:50%',
      ),
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
        'Other' => 'Other',
    )
    ))
    ->add('Others', TextType::class, array(
      'required' => true,
      'label' => false,
      'attr' => array(
        'style' => 'width:50%',
      )
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
