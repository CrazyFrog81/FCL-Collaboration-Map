<?php

// in AppBundle/Controller/VehicleController.php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Individual;
use AppBundle\Entity\Project;
use AppBundle\Entity\Partner;
use AppBundle\Entity\ProjectOutcome;
use AppBundle\Entity\Disciplinary;

class FormController extends Controller
{
  /**
  * @Route("/form", name="form")
  */
public function createFormAction() {
    $formData = new Individual(); // Your form data class. Has to be an object, won't work properly with an array.

    $project = new Project();
    $formData->getProjects()->add($project);

    $partner = new Partner();
    $formData->getPartners()->add($partner);

    $project_outcome = new ProjectOutcome();
    $project->getProjectOutcomes()->add($project_outcome);

    $disciplinary = new Disciplinary();
    $formData->getDisciplinaryBackgrounds()->add($disciplinary);

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

            return $this->redirect($this->generateUrl('general')); // redirect when done
        }
    }

    return $this->render('createForm.html.twig', array(
        'form' => $form->createView(),
        'flow' => $flow,
    ));
}
}

 ?>
