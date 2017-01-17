<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
  * @ORM\Column(type="string")
  */
  protected $completion_date;

  /**
  * @ORM\Column(type="string")
  */
  protected $working_time;

  /**
  * @ORM\ManyToOne(targetEntity="Individual", inversedBy="projects")
  * @ORM\JoinColumn(name="individual_id", referencedColumnName="id")
  */
  protected $individual;

  /**
  * @ORM\OneToMany(targetEntity="ProjectOutcome", mappedBy="project")
  */
  protected $project_outcomes;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->project_outcomes = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * @param string $workingTime
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
     * @return string
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
     * Get individual
     *
     * @return \AppBundle\Entity\Individual
     */
    public function getIndividual()
    {
        return $this->individual;
    }

    /**
     * Add projectOutcome
     *
     * @param \AppBundle\Entity\ProjectOutcome $projectOutcome
     *
     * @return Project
     */
    public function addProjectOutcome(\AppBundle\Entity\ProjectOutcome $projectOutcome)
    {
        $this->project_outcomes[] = $projectOutcome;

        return $this;
    }

    /**
     * Remove projectOutcome
     *
     * @param \AppBundle\Entity\ProjectOutcome $projectOutcome
     */
    public function removeProjectOutcome(\AppBundle\Entity\ProjectOutcome $projectOutcome)
    {
        $this->project_outcomes->removeElement($projectOutcome);
    }

    /**
     * Get projectOutcomes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProjectOutcomes()
    {
        return $this->project_outcomes;
    }
}
