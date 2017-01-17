<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="work")
*/
class Work
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
  protected $research_group;

  /**
   * @ORM\Column(type="string")
   */
  protected $location;

  /**
  * @ORM\OneToOne(targetEntity="Individual", inversedBy="research_group")
  * @ORM\JoinColumn(name="individual_id", referencedColumnName="id")
  */
  protected $individual;

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
     * Set researchGroup
     *
     * @param string $researchGroup
     *
     * @return Work
     */
    public function setResearchGroup($researchGroup)
    {
        $this->research_group = $researchGroup;

        return $this;
    }

    /**
     * Get researchGroup
     *
     * @return string
     */
    public function getResearchGroup()
    {
        return $this->research_group;
    }

    /**
     * Set location
     *
     * @param string $location
     *
     * @return Work
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set individual
     *
     * @param \AppBundle\Entity\Individual $individual
     *
     * @return Work
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
}
