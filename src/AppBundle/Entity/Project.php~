<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
* @ORM\Entity
* @ORM\Table(name="project")
*/
class Project
{
  /**
  * @ORM\Id
  * @ORM\Column(type="integer")
  * @ORM\GeneratedValue(strategy="AUTO")
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
  * @ORM\Column(type="string")
  */
  protected $project_duration;

  /**
  * @ORM\Column(type="string")
  */
  protected $working_time;

  /**
  * @ORM\ManyToOne(targetEntity="Individual", inversedBy="projects")
  * @ORM\JoinColumn(name="individual_id", referencedColumnName="user_id")
  */
  protected $individual;

  /**
  * @ORM\Column(type="json_array")
  *
  */
  protected $project_outcomes;

  /**
  * @ORM\Column(type="json_array")
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
     * Set projectDuration
     *
     * @param string $projectDuration
     *
     * @return Project
     */
    public function setProjectDuration($project_duration)
    {
        $this->project_duration = $project_duration;

        return $this;
    }

    /**
     * Get projectDuration
     *
     * @return string
     */
    public function getProjectDuration()
    {
        return $this->project_duration;
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
     * Get beforeFcl
     *
     * @return string
     */
    public function getBeforeFcl()
    {
        return $this->before_fcl;
    }

    public function setCollaborators($collaborators)
    {
      $this->collaborators = $collaborators;
      return $this;
    }

    public function getCollaborators()
    {
      return $this->collaborators;
    }
}
