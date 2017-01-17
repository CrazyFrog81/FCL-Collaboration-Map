<?php

// src/AppBundle/Form/CollaborationInformationType.php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use AppBundle\Entity\Individual;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use AppBundle\Form\Type\PartnerType;
use AppBundle\Form\Type\ProjectType;

class CollaborationInformationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $builder
        ->add('partners', CollectionType::class, array(
          'entry_type' => PartnerType::class,
          'entry_options' => array('label' => false),
        ))
        ->add('projects', CollectionType::class, array(
          'entry_type' => ProjectType::class,
          'entry_options' => array('label' => false),
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
