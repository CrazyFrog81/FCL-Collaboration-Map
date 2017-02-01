<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\Collaborator;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation as JMS;

/**
* @ORM\Entity
* @ORM\Table(name="project")
* @ExclusionPolicy("all")
*/
class Project
{
  /**
  * @ORM\Id
  * @ORM\Column(type="integer")
  * @ORM\GeneratedValue(strategy="AUTO")
  * @Expose
  */
  protected $id;

  /**
  * @ORM\Column(type="string")
  */
  protected $name;

  /**
  * @ORM\Column(type="date")
  */
  protected $start_date;

  /**
  * @ORM\Column(type="date")
  */
  protected $completion_date;

  /**
  * @ORM\Column(type="integer")
  */
  protected $working_time;

  /**
  * @ORM\ManyToOne(targetEntity="Individual", inversedBy="projects")
  * @ORM\JoinColumn(name="individual_id", referencedColumnName="id")
  */
  protected $individual;

  /**
  * @ORM\Column(type="simple_array")
  *
  */
  protected $project_outcomes;

  /**
  * @ORM\Column(type="json_array")
  * @JMS\Type("ArrayCollection<AppBundle\Entity\Collaborator>")
  */
  protected $collaborators;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Project
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set completionDate
     *
     * @param string $completionDate
     *
     * @return Project
     */
    public function setCompletionDate($completionDate)
    {
        $this->completion_date = $completionDate;

        return $this;
    }

    /**
     * Get completionDate
     *
     * @return string
     */
    public function getCompletionDate()
    {
        return $this->completion_date;
    }

    /**
     * Set workingTime
     *
     * @param integer $workingTime
     *
     * @return Project
     */
    public function setWorkingTime($workingTime)
    {
        $this->working_time = $workingTime;

        return $this;
    }

    /**
     * Get workingTime
     *
     * @return integer
     */
    public function getWorkingTime()
    {
        return $this->working_time;
    }

    /**
     * Set individual
     *
     * @param \AppBundle\Entity\Individual $individual
     *
     * @return Project
     */
    public function setIndividual(\AppBundle\Entity\Individual $individual = null)
    {
        $this->individual = $individual;

        return $this;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->collaborators = new \Doctrine\Common\Collections\ArrayCollection();

    }

    /**
     * Get individual
     *
     * @return \AppBundle\Entity\Individual
     */
    public function getIndividual()
    {
        return $this->individual;
    }

    /**
     * Set projectOutcomes
     *
     * @param array $projectOutcomes
     *
     * @return Project
     */
    public function setProjectOutcomes($projectOutcomes)
    {
        $this->project_outcomes = $projectOutcomes;

        return $this;
    }

    /**
     * Get projectOutcomes
     *
     * @return array
     */
    public function getProjectOutcomes()
    {
        return $this->project_outcomes;
    }

    public function __toString()
    {
      return $this->name;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     *
     * @return Project
     */
    public function setStartDate($startDate)
    {
        $this->start_date = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->start_date;
    }

    /**
     * Set collaborators
     *
     * @param array $collaborators
     *
     * @return Project
     */
    public function setCollaborators($collaborators)
    {
        $serializer = SerializerBuilder::create()->build();

        $jsonCollaborator = $serializer->serialize($collaborators, 'json');

        // var_dump($jsonCollaborator);

        // $deserialization = $serializer->deserialize($jsonCollaborator, 'ArrayCollection<AppBundle\Entity\Collaborator>', 'json');
        // var_dump($deserialization);

        $this->collaborators= $jsonCollaborator;

        return $this->collaborators;
    }

    /**
     * Get collaborators
     *
     * @return array
     */
    public function getCollaborators()
    {
      if(count(json_decode($this->collaborators)) == 0) {
        // var_dump(count(json_decode($this->collaborators)));
        return $this->collaborators;
      }
      //var_dump(count(json_decode($this->collaborators)));
      else {
        $serializer = SerializerBuilder::create()->build();

        $object = $serializer->deserialize($this->collaborators, 'ArrayCollection<AppBundle\Entity\Collaborator>', 'json');

        return $object;
      }
      //return $this->collaborators;
    }
}
