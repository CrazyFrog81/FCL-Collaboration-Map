<?php

// src/AppBundle/Form/GeneralInformationType.php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Individual;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use AppBundle\Form\Type\ChoiceOtherRGType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

class GeneralInformationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $builder->add('name', TextType::class, array(
        'required' => true,
        'attr' => array(
        'placeholder' => 'Full name',
      )
      ))
              ->add('research_group', ChoiceOtherRGType::class);
    }


    public function configureOptions(OptionsResolver $resolver)
    {
      $resolver->setDefaults(array(
        'data_class' => 'AppBundle\Entity\Individual'
      ));
    }

    public function getName(){
      return null;
    }
}

 ?>
