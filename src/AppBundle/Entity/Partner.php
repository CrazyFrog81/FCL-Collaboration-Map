<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="partner")
*/
class Partner
{
  /**
  * @ORM\Id
  * @ORM\Column(type="string")
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
  protected $collaborated_before;

  /**
  * @ORM\ManyToOne(targetEntity="Individual", inversedBy="partners")
  * @ORM\JoinColumn(name="individual_id", referencedColumnName="id")
  */
  protected $individual;

    /**
     * Get id
     *
     * @return string
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
     * @return Partner
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
     * Set collaboratedBefore
     *
     * @param string $collaboratedBefore
     *
     * @return Partner
     */
    public function setCollaboratedBefore($collaboratedBefore)
    {
        $this->collaborated_before = $collaboratedBefore;

        return $this;
    }

    /**
     * Get collaboratedBefore
     *
     * @return string
     */
    public function getCollaboratedBefore()
    {
        return $this->collaborated_before;
    }

    /**
     * Set individual
     *
     * @param \AppBundle\Entity\Individual $individual
     *
     * @return Partner
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
