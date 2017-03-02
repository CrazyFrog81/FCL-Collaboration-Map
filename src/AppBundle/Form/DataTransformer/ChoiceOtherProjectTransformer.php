<?php

// src/AppBundle/Form/DataTransformer/IssueToNumberTransformer.php
namespace AppBundle\Form\DataTransformer;

use AppBundle\Entity\Project;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class ChoiceOtherProjectTransformer implements DataTransformerInterface
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    // Data is in term of Object
    // Hence if in 'name' is 'Other' return data to 'Others' textbox
    // If not the return to 'name'
    public function reverseTransform($data)
    {
          if('Other' == $data['name']){
            return $data['Others'];
          } else {
            return $data['name'];
          }
    }

    // Data received is in term of string
    // Hence find the project object by name
    // If there is no such project return to 'Others'
    // If there is then return to 'name'
    public function transform($data)
    {
        if (!$data) {
            return;
          }

        $projects = $this->manager
            ->getRepository('AppBundle:Project')
            ->findByName($data);

        if($projects == null)
        {
          return array('name' => 'Other', 'Others' => $data);
        }else {
          return array('name' => $data, 'Others' => null);
        }
    }
}
