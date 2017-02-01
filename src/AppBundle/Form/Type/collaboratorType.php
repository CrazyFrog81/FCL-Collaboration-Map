<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Doctrine\ORM\EntityRepository;

class CollaboratorType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add('id', EntityType::class, array(
      'class' => 'AppBundle:Individual',
      'choice_label' => 'name',
      'query_builder' => function(EntityRepository $er) {
        return $er->createQueryBuilder('u')
                  ->orderBy('u.name', 'ASC');
        }
    ))
    // $builder->add('id', TextType::class)
           ->add('collaborated_before', ChoiceType::class, array(
             'choices' => array(
               'Yes' => 'Yes',
               'No' => 'No',
             ),
             'multiple' => false,
             'expanded' => true,
           ));
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'AppBundle\Entity\Collaborator'
    ));
  }
}

 ?>
