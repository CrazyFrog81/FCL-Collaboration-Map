<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\ChoiceList\View\ChoiceView;
use Doctrine\ORM\EntityRepository;

class ChoiceOtherProType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
    ->add('name', EntityType::class, array(
      'class' => 'AppBundle:Project',
      'placeholder' => '--Select--',
      'attr' => array(
        'style' => 'width:50%',
      ),
      'choice_label' => 'name',
      'choice_value' => 'name',
      'label' => 'Project title',
      'query_builder' => function (EntityRepository $er) {
      return $er->createQueryBuilder('u')
          ->orderBy('u.name', 'ASC');
  },
    ))
    ->add('Others', TextType::class, array(
      'required' => true,
      'label' => false,
      'attr' => array(
        'placeholder' => 'If others, please specify here',
        'style' => 'width:50%;',
      )
    ));

    $builder->get('name')->resetViewTransformers();
  }

  public function setDefaultOptions(OptionsResolverInterface $resolver)
  {
    $resolver->setRequired(array('choices'));
    $resolver->setAllowedTypes(array('choices' => 'array'));
  }

  public function finishView(FormView $view, FormInterface $form, array $options)
  {
    $new_choice = new ChoiceView(array(), 'Other', 'Other');
    $view->children['name']->vars['choices'][] = $new_choice;
  }

  public function getParent()
  {
    return FormType::class;
  }
}
