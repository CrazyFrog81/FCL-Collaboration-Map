<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Individual;
use AppBundle\Entity\Work;
use AppBundle\Entity\Project;
use AppBundle\Entity\Partner;
use AppBundle\Form\CollaborationInformationType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\Common\Collection\ArrayCollection;

class CollaborationInformationController extends Controller
{
  /**
  * @Route("/form/collaboration", name="collaboration")
  */
  public function newAction(Request $request)
  {
    $individual = new Individual();

    $project = new Project();
    $individual->addProject($project);

    $partner = new Partner();
    $individual->addPartner($partner);

    $form = $this->createForm(CollaborationInformationType::class, $individual)
                ->add('save', SubmitType::class, array('label' => 'Submit'));

    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()) {
      $individual = $form->getData();

      $em = $this->getDoctrine()->getManager();
      $em->persist($individual);
      $em->flush();

      return $this->redirectToRoute('collaboration');
    }

    return $this->render('collaboration.html.twig', array(
      'form' => $form->createView(),
    ));
  }
}

?>
