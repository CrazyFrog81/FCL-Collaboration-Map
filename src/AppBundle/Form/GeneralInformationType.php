<?php

// src/AppBundle/Form/GeneralInformationType.php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Individual;
use AppBundle\Entity\Work;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GeneralInformationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $builder
        ->add('name', TextType::class)
        ->add('research_group', EntityType::class,array(
          'class' => 'AppBundle:Work',
          'choice_label' => 'research_group',
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
