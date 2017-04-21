<?php

// Read http://symfony.com/doc/current/form/data_transformers.html for more information about data transformer

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

    // convert 'Project' object into 'name' string
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

    // reconvert 'name' string into 'Project' object
    public function reverseTransform($data)
    {
          if('Other' == $data['name']){
            return $data['Others'];
          } else {
            return $data['name'];
          }
    }
}
