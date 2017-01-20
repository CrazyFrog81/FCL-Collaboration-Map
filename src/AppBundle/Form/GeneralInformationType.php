<?php

// src/AppBundle/Form/GeneralInformationType.php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Individual;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Form\Type\ResearchGroupType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class GeneralInformationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $builder
        ->add('name', EntityType::class, array(
          'class' => 'AppBundle:Individual',
          'choice_label' => 'name',
          'label' => 'Your name',
          'placeholder' => '--Select--',
          'choice_value' => 'name',
          'expanded' =>false,
          'multiple' => false,
          'query_builder' => function (EntityRepository $er) {
        return $er->createQueryBuilder('u')
            ->orderBy('u.name', 'ASC');
    },
        ))
        ->add('research_group', ChoiceType::class, array(
          'label' => 'Your research group',
          'placeholder' => '--Select--',
          'choices' => array(
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
            'Others' => 'Others',
          )
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
