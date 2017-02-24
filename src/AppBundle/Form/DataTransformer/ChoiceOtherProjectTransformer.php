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

    public function reverseTransform($data)
    {
          if('Other' == $data['name']){
            return $data['Others'];
          } else {
            return $data['name'];
          }
    }

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


 ?>
