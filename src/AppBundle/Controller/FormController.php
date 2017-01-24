<?php

// in AppBundle/Controller/VehicleController.php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Individual;
use AppBundle\Entity\Project;
use AppBundle\Entity\collaborator;
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

    $collaborator = new collaborator();
    $formData->addcollaborator($collaborator);

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
        'formData' => $formData,
    ));
}

public function editAction($id, Request $request)
{
    $em = $this->getDoctrine()->getManager();
    $individual = $em->getRepository('AppBundle:Individual')->find($id);

    if (!$individual) {
        throw $this->createNotFoundException('No individual found for id '.$id);
    }

    $originalcollaborators = new ArrayCollection();

    // Create an ArrayCollection of the current collaborator objects in the database
    foreach ($individual->getcollaborators() as $collaborator) {
        $originalcollaborators->add($collaborator);
    }

    $editForm = $this->createForm(CollaborationInformationType::class, $individual);

    $editForm->handleRequest($request);

    if ($editForm->isValid()) {

        // remove the relationship between the collaborator and the individual
        foreach ($originalcollaborators as $collaborator) {
            if (false === $individual->getcollaborators()->contains($collaborator)) {
                // remove the Individual from the collaborator
//                $collaborator->getIndividual()->removeElement($individual);

                // if it was a many-to-one relationship, remove the relationship like this
                $collaborator->setIndividual(null);

                $em->persist($collaborator);

                // if you wanted to delete the collaborator entirely, you can also do that
                $em->remove($collaborator);
            }
        }

        $em->persist($individual);
        $em->flush();

    }

}
}

 ?>
