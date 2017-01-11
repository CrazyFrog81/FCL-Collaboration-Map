<?php

namespace AppBundle\Controller;

use AppBundle\Entity\CollaborationInformation;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\LanguageType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CollaborationInformationController extends Controller
{
  /**
  * @Route("/form", name="form")
  */
  public function formAction(Request $request)
  {
    $individual_information = new CollaborationInformation();

    $form = $this->createFormBuilder($individual_information)
          ->add('name', EntityType::class, array(
            'class' => 'AppBundle:CollaborationInformation',
            'choice_label' => 'name'
            
          ))
          ->add('research_group', EntityType::class, array(
            'class' => 'AppBundle:CollaborationInformation',
            'choice_label' => 'research_group'
          ))
          ->add('disciplinary_background', EntityType::class, array(
            'class' => 'AppBundle:CollaborationInformation',
            'choice_label' => 'disciplinary_background'
          ))
          ->add('work_location', EntityType::class, array(
            'class' => 'AppBundle:CollaborationInformation',
            'choice_label' => 'work_location'
          ))
          ->add('work_start_date', TextType::class)
          ->add('working_duration_before_join', TextType::class)
          ->add('academic_background', EntityType::class, array(
            'class' => 'AppBundle:CollaborationInformation',
            'choice_label' => 'academic_background'
          ))
          ->add('mother_tongue', LanguageType::class)
          ->add('gender', ChoiceType::class, array(
            'choices' => array(
              'Male' => 'Male',
              'Female' => 'Female'
            ),
            'required' => true,
            'placeholder' => 'Choose your gender',
            'empty_data' => null
          ))
          ->add('age', TextType::class)
          ->add('nationality', EntityType::class, array(
            'class' => 'AppBundle:CollaborationInformation',
            'choice_label' => 'nationality'
          ))
          ->add('collaboration_with', EntityType::class, array(
            'class' => 'AppBundle:CollaborationInformation',
            'choice_label' => 'name'
          ))
          ->add('project_name', EntityType::class, array(
            'class' => 'AppBundle:CollaborationInformation',
            'choice_label' => 'project_name'
          ))
          ->add('project_completion_date', TextType::class)
          ->add('collaborated_before', ChoiceType::class, array(
            'choices' => array(
              'Yes' => 'Yes',
              'No' => 'No'
            ),
            'placeholder' => ' ',
            'empty_data' => null
          ))
          ->add('project_working_time', NumberType::class)
          ->add('expected_outcome', TextType::class)
          ->add('save', SubmitType::class, array('label' => 'Submit Survey'))
          ->getForm();

    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()) {
      $individual_information = $form->getData();

      $em = $this->getDoctrine()->getManager();
      $em->persist($individual_information);
      $em->flush();

      return $this->redirectToRoute('list');
    }

    return $this->render('form.html.twig', array(
      'form' => $form->createView(),
    ));
  }


  /**
   * @Route("/list", name="list")
   */
  public function listAction()
  {
    $posts = $this->getDoctrine()->getRepository('AppBundle:CollaborationInformation')->findAll();

    dump($posts);

    return $this->render('index.html.twig', array('posts' => $posts,)
    );
  }
}

 ?>
