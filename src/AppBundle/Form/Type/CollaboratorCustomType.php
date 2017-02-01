<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Doctrine\ORM\EntityRepository;

class CollaboratorCustomType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add('collaborator', EntityType::class, array(
      'class' => 'AppBundle:Individual',
      'choice_label' => 'name',
      'query_builder' => function(EntityRepository $er) {
        return $er->createQueryBuilder('u')
                  ->orderBy('u.name', 'ASC');
        }
    ))
           ->add('collaborated_before', ChoiceType::class, array(
             'choices' => array(
               'Yes' => 'Yes',
               'No' => 'No',
             ),
             'multiple' => false,
             'expanded' => true,
           ));

      // $builder->get('name')->addModelTransformer(new CallbackTransformer(
      //   function($nameAsId) {
      //     echo $nameAsId[0];
      //     return $nameAsId[0];
      //   },
      //   function($nameAsArray) {
      //     return $nameAsArray;
      //   }
      // ));
  }
}

 ?>
