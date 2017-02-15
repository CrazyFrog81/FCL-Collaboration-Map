<?php

// src/AppBundle/Form/DataTransformer/IssueToNumberTransformer.php
namespace AppBundle\Form\DataTransformer;

use AppBundle\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class IssueToNumberTransformer implements DataTransformerInterface
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Transforms an object (issue) to a string (number).
     *
     * @param  Issue|null $issue
     * @return string
     */
    public function reverseTransform($issue)
    {
        if (null === $issue) {
            return '';
        }

        return $issue->getId();
    }

    /**
     * Transforms a string (number) to an object (issue).
     *
     * @param  string $issueNumber
     * @return Issue|null
     * @throws TransformationFailedException if object (issue) is not found.
     */
    public function transform($issueNumber)
    {
        // no issue number? It's optional, so that's ok
        if (!$issueNumber) {
            return;
        }

        $issue = $this->manager
            ->getRepository('AppBundle:User')
            // query for the issue with this id
            ->find($issueNumber)
        ;

        if (null === $issue) {
            // causes a validation error
            // this message is not shown to the user
            // see the invalid_message option
            throw new TransformationFailedException(sprintf(
                'A user with number "%s" does not exist!',
                $issueNumber
            ));
        }

        return $issue;
    }
}


 ?>
