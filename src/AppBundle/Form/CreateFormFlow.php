<?php

// AppBundle/Form/CreateFormFlow.php

namespace AppBundle\Form;

use Craue\FormFlowBundle\Form\FormFlow;
use Craue\FormFlowBundle\Form\FormFlowInterface;

class CreateFormFlow extends FormFlow {

    protected function loadStepsConfig() {
        return array(
            array(
                'label' => 'Rationale of the project',
            ),
            array(
                'label' => 'General Information',
                'form_type' => 'AppBundle\Form\GeneralInformationType',
            ),
            array(
                'label' => 'Collaboration Information',
                'form_type' => 'AppBundle\Form\CollaborationInformationType',
            ),
            array(
                'label' => 'Background Information and Confirmation',
                'form_type' => 'AppBundle\Form\BackgroundInformationType',
            ),
        );
    }

}

 ?>
