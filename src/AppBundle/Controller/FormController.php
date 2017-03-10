<?php

// in AppBundle/Controller/VehicleController.php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Individual;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Entity\UserManager;
use Symfony\Component\HttpFoundation\Response;

class FormController extends Controller
{
  /**
  * @Route("/", name="form")
  */
public function createFormAction() {
    $userId = $this->getUser()->getId();

    $individual = $this->getDoctrine()->getRepository('AppBundle:Individual')->find($userId);

    if($individual){
      return $this->redirect($this->generateUrl('edit'));
    }

    $formData = new Individual(); // Your form data class. Has to be an object, won't work properly with an array.
    $formData->setId($this->getUser());

    $formData->setName($this->getUser()->getUsername());

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

            $data = array();
            $projects = $formData->getProjects();
            foreach($projects as $project)
            {
              $collaborators = $project->getCollaborators();
              foreach($collaborators as $collab)
              {
                array_push($data,$collab);
              }
            }

            $formData->setCollaborators($data);

            $em->flush();

            $flow->reset(); // remove step data from the session

            return $this->redirect($this->generateUrl('sucess')); // redirect when done
        }
    }

    return $this->render('createForm.html.twig', array(
        'form' => $form->createView(),
        'flow' => $flow,
        'formData' => $formData,
    ));
}

    /**
    * @Route("/edit", name="edit")
    */
    public function editFormAction(Request $request) {
      $userId = $this->getUser()->getId();

      $individual = $this->getDoctrine()->getRepository('AppBundle:Individual')->find($userId);

      if(!$individual){
        throw $this->createNotFoundException(
          'No product found for id '.$userId
        );
      }

      $flow = $this->get('form.flow.createForm'); // must match the flow's service id
      $flow->bind($individual);

      $form = $flow->createForm();

      if ($flow->isValid($form)) {
          $flow->saveCurrentStepData($form);

          if ($flow->nextStep()) {
              // form for the next step
              $form = $flow->createForm();
          } else {
              // flow finished
              $em = $this->getDoctrine()->getManager();

              // delete the projects record in database
              $oldprojects = $em->getRepository('AppBundle:Project')->findByIndividual($userId);
              foreach($oldprojects as $oldproject){
                $em->remove($oldproject);
              }

              $em->persist($individual);

              $data = array();
              $projects = $individual->getProjects();

              foreach($projects as $project)
              {
                $collaborators = $project->getCollaborators();
                foreach($collaborators as $collab)
                {
                  array_push($data,$collab);
                }
              }
              $individual->setCollaborators($data);

              $em->flush();

              $flow->reset(); // remove step data from the session

              return $this->redirect($this->generateUrl('success')); // redirect when done
          }
      }
      return $this->render('createForm.html.twig', array(
          'form' => $form->createView(),
          'flow' => $flow,
          'formData' => $individual,
      ));

    }

    /**
    * @Route("/success", name="success")
    */
    public function successFormAction()
    {
      $userId = $this->getUser()->getId();

      $individual = $this->getDoctrine()->getRepository('AppBundle:Individual')->find($userId);

      if(!$individual){
        return $this->redirect($this->generateUrl('form'));
      }

      return $this->render('success.html.twig');
    }
}
