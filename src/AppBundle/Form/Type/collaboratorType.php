<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Doctrine\ORM\EntityRepository;
use AppBundle\Form\Type\ChoiceOtherCollabType;

class CollaboratorType extends AbstractType
{

  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add('id', ChoiceOtherCollabType::class, array(
      'label'=> false,
    ))
           ->add('collaborated_before', ChoiceType::class, array(
             'choices' => array(
               'Yes' => 'Yes',
               'No' => 'No',
             ),
             'label' => 'Have you collaborated with this person before this project?',
             'multiple' => false,
             'expanded' => true,
           ));
   }

}
