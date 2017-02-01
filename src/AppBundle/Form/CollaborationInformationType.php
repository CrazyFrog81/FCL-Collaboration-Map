<?php

// src/AppBundle/Form/CollaborationInformationType.php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use AppBundle\Entity\Individual;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use AppBundle\Form\Type\ProjectType;
use AppBundle\Form\Type\CollaboratorCustomType;
use AppBundle\Form\Type\CollaboratorType;

class CollaborationInformationType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $builder
        ->add('projects', CollectionType::class, array(
          'entry_type' => ProjectType::class,
          'label' => false,
          'by_reference' => false,
          'allow_add' => true,
          'entry_options' => array('label' => false),
        ))
        ->add('collaborators', CollectionType::class, array(
          'entry_type' => CollaboratorType::class,
          'allow_delete' => true,
          'allow_add' => true,
          'by_reference' => false,
          'label' => false,
        ));
      }


    public function configureOptions(OptionsResolver $resolver)
    {
      $resolver->setDefaults(array(
        'data_class' => 'AppBundle\Entity\Individual'
      ));
    }
}

 ?>
