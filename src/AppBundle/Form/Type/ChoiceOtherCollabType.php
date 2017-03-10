<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\ChoiceList\View\ChoiceView;
use Doctrine\ORM\EntityRepository;

class ChoiceOtherCollabType extends AbstractType
{

  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
    ->add('id', EntityType::class, array(
      'label' => 'Name',
      'attr' => array(
        'style' => 'width:35%',
      ),
      'class' => 'AppBundle:User',
      'choice_label' => 'username',
      'query_builder' => function(EntityRepository $er) {
        return $er->createQueryBuilder('u')
                  ->orderBy('u.username', 'ASC');
        }
    ))
    ->add('Others', TextType::class, array(
      'required' => true,
      'label' => false,
      'attr' => array(
        'placeholder' => 'If others, please specify here',
        'style' => 'width:35%',
      )
    ))
    ->addModelTransformer(new CallbackTransformer(
      function($data)
      {
        if($data == null)
        {
          return array('id' => null, 'Others'=> null);
        }
        if (is_numeric($data))
        {
          return array('id' => $data, 'Others' => null);
        } else {
          return array('id' => 'Other', 'Others' => $data);
      }
      },
      function ($data)
      {
        if ('Other' === $data['id']) {
          return $data['Others'];
        }

        return $data['id'];
      }
    ));

    $builder->get('id')->resetViewTransformers();
  }

  public function setDefaultOptions(OptionsResolverInterface $resolver)
  {
    $resolver->setRequired(array('choices'));
    $resolver->setAllowedTypes(array('choices' => 'array'));
  }

  public function finishView(FormView $view, FormInterface $form, array $options)
  {
    $new_choice = new ChoiceView(array(), 'Other', 'Other');
    $view->children['id']->vars['choices'][] = $new_choice;
  }

  public function getParent()
  {
    return FormType::class;
  }
}
