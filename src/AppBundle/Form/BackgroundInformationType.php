<?php

// src/AppBundle/Form/BackgroundInformationType.php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use AppBundle\Entity\Disciplinary;
use AppBundle\Entity\Work;
use AppBundle\Entity\Individual;
use AppBundle\Entity\NationalityClass;
use AppBundle\Form\Type\DisciplinaryType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\LanguageType;

class BackgroundInformationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $builder
        ->add('disciplinary_backgrounds', CollectionType::class, array(
            'entry_type' => DisciplinaryType::class,
            'entry_options' => array('label' => false),
        ))
        ->add('location', EntityType::class, array(
          'class' => 'AppBundle:Work',
          'choice_label' => 'location',
        ))
        ->add('start_date', TextType::class)
        ->add('work_duration_in_fcl', TextType::class)
        ->add('academic_background', TextType::class)
//        ->add('mother_tongue', LanguageType::class)
        ->add('gender', TextType::class)
        ->add('age', TextType::class);
//        ->add('nationality', EntityType::class, array(
//           'class' => 'AppBundle:NationalityClass',
//           'choice_label' => 'nationality',
//        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
      $resolver->setDefaults(array(
        'data_class' => 'AppBundle\Entity\Individual'
      ));
    }
}

 ?>
