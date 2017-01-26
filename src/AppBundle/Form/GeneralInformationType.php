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
use AppBundle\Form\Type\ChoiceOtherRGType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\CallbackTransformer;

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
        ->add('research_group', ChoiceOtherRGType::class);

        $builder->get('research_group')->addModelTransformer(new CallbackTransformer(
          function($researchGroupAsString) {
            return explode(' ', $researchGroupAsString);
          },
          function($researchGroupAsArray) {
            return implode(' ', $researchGroupAsArray);
          }
        ));

        // $builder->get('research_group')->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) {
        //   $data = $event->getData();
        //
        //   $changeData = implode("", ($data));
        //   $event->setData($changeData);
        //
        // });
    }


    public function configureOptions(OptionsResolver $resolver)
    {
      $resolver->setDefaults(array(
        'data_class' => 'AppBundle\Entity\Individual'
      ));
    }
}

 ?>
