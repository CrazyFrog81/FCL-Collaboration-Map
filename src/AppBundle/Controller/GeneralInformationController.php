<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Individual;
use AppBundle\Entity\Work;
use AppBundle\Form\GeneralInformationType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\Common\Collection\ArrayCollection;

class GeneralInformationController extends Controller
{
  /**
  * @Route("/form/general", name="general")
  */
  public function newAction(Request $request)
  {
    $individual = new Individual();

    $form = $this->createForm(GeneralInformationType::class, $individual)
                ->add('save', SubmitType::class, array('label' => 'Submit'));

    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()) {
      $individual = $form->getData();

      $em = $this->getDoctrine()->getManager();
      $em->persist($individual);
      $em->flush();

      return $this->redirectToRoute('general');
    }

    return $this->render('general.html.twig', array(
      'form' => $form->createView(),
    ));
  }
}

?>
