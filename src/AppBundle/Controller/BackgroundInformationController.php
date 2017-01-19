<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Disciplinary;
use AppBundle\Entity\Work;
use AppBundle\Entity\Individual;
use AppBundle\Entity\Nationality;
use AppBundle\Form\Type\DisciplinaryType;
use AppBundle\Form\BackgroundInformationType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Collection\ArrayCollection;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class BackgroundInformationController extends Controller
{
  /**
  * @Route("/form/background", name="background")
  */
  public function newAction(Request $request)
  {
    $individual = new Individual();

    $disciplinary = new Disciplinary();
    $individual->addDisciplinaryBackground($disciplinary);

    $form = $this->createForm(BackgroundInformationType::class, $individual)
    ->add('save', SubmitType::class, array('label' => 'Submit'));

    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()) {
      $individual = $form->getData();

      $em = $this->getDoctrine()->getManager();
      $em->persist($individual);
      $em->flush();

      return $this->redirectToRoute('background');
    }

    return $this->render('background.html.twig', array(
      'form' => $form->createView(),
    ));
  }
}

?>
