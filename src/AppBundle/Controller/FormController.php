<?php

// in AppBundle/Controller/VehicleController.php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Individual;
use AppBundle\Entity\Project;
use AppBundle\Entity\Partner;
use Doctrine\Common\Collections\ArrayCollection;

class FormController extends Controller
{
  /**
  * @Route("/form", name="form")
  */
public function createFormAction() {
    $formData = new Individual(); // Your form data class. Has to be an object, won't work properly with an array.

    $project = new Project();
    $formData->addProject($project);

    $partner = new Partner();
    $formData->addPartner($partner);

    $flow = $this->get('form.flow.createForm'); // must match the flow's service id
    $flow->bind($formData);

    // form of the current step
    $form = $flow->createForm();
    if ($flow->isValid($form)) {
        $flow->saveCurrentStepData($form);

        if ($flow->nextStep()) {
            // form for the next step
            $form = $flow->createForm();
        } else {
            // flow finished
            $em = $this->getDoctrine()->getManager();
            $em->persist($formData);
            $em->flush();

            $flow->reset(); // remove step data from the session

            return $this->redirect($this->generateUrl('form')); // redirect when done
        }
    }

    return $this->render('createForm.html.twig', array(
        'form' => $form->createView(),
        'flow' => $flow,
    ));
}

public function editAction($id, Request $request)
{
    $em = $this->getDoctrine()->getManager();
    $individual = $em->getRepository('AppBundle:Individual')->find($id);

    if (!$individual) {
        throw $this->createNotFoundException('No individual found for id '.$id);
    }

    $originalPartners = new ArrayCollection();

    // Create an ArrayCollection of the current Partner objects in the database
    foreach ($individual->getPartners() as $partner) {
        $originalPartners->add($partner);
    }

    $editForm = $this->createForm(CollaborationInformationType::class, $individual);

    $editForm->handleRequest($request);

    if ($editForm->isValid()) {

        // remove the relationship between the partner and the individual
        foreach ($originalPartners as $partner) {
            if (false === $individual->getPartners()->contains($partner)) {
                // remove the Individual from the Partner
//                $partner->getIndividual()->removeElement($individual);

                // if it was a many-to-one relationship, remove the relationship like this
                $partner->setIndividual(null);

                $em->persist($partner);

                // if you wanted to delete the Partner entirely, you can also do that
                $em->remove($partner);
            }
        }

        $em->persist($individual);
        $em->flush();

    }

}
}

 ?>
