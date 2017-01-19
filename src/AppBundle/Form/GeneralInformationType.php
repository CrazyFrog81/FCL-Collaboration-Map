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
use AppBundle\Form\Type\ResearchGroupType;
use Doctrine\ORM\EntityRepository;

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
        ->add('research_group', ResearchGroupType::class, array(
          'label' => 'Your research group',
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
