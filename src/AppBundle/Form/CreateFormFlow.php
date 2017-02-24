<?php

// AppBundle/Form/CreateFormFlow.php

namespace AppBundle\Form;

use Craue\FormFlowBundle\Form\FormFlow;
use Craue\FormFlowBundle\Form\FormFlowInterface;

class CreateFormFlow extends FormFlow {

  protected $allowDynamicStepNavigation = true;

    protected function loadStepsConfig() {
        return array(
            array(
                'label' => 'Initial Information',
                'form_type' => 'AppBundle\Form\GeneralInformationType',
            ),
            array(
                'label' => 'Collaboration',
                'form_type' => 'AppBundle\Form\CollaborationInformationType',
            ),
            array(
                'label' => 'Background',
                'form_type' => 'AppBundle\Form\BackgroundInformationType',
            ),
            array(
                'label' => 'Confirmation',
            ),
        );
    }

}

 ?>
