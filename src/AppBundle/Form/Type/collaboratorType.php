<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Form\DataTransformer\IssueToNumberTransformer;

class CollaboratorType extends AbstractType
{
  private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add('id', EntityType::class, array(
      'label' => 'Name',
      'class' => 'AppBundle:User',
      'choice_label' => 'username',
      'query_builder' => function(EntityRepository $er) {
        return $er->createQueryBuilder('u')
                  ->orderBy('u.username', 'ASC');
        }
    ))
           ->add('collaborated_before', ChoiceType::class, array(
             'choices' => array(
               'Yes' => 'Yes',
               'No' => 'No',
             ),
             'multiple' => false,
             'expanded' => true,
           ));


   $builder->get('id')
          ->addModelTransformer(new IssueToNumberTransformer($this->manager));
   }
}

 ?>
