<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="project_outcome")
*/
class ProjectOutcome
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
  protected $expected_outcome;

  /**
  * @ORM\ManyToOne(targetEntity="Project", inversedBy="project_outcomes")
  * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
  */
  protected $project;

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
     * Set expectedOutcome
     *
     * @param string $expectedOutcome
     *
     * @return ProjectOutcome
     */
    public function setExpectedOutcome($expectedOutcome)
    {
        $this->expected_outcome = $expectedOutcome;

        return $this;
    }

    /**
     * Get expectedOutcome
     *
     * @return string
     */
    public function getExpectedOutcome()
    {
        return $this->expected_outcome;
    }

    /**
     * Set project
     *
     * @param \AppBundle\Entity\Project $project
     *
     * @return ProjectOutcome
     */
    public function setProject(\AppBundle\Entity\Project $project = null)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \AppBundle\Entity\Project
     */
    public function getProject()
    {
        return $this->project;
    }
}
