<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="nationality")
*/
class NationalityClass
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
    protected $nationality;

    /**
    * @ORM\Column(type="string")
    */
    protected $mother_tongue;

    /**
    * @ORM\OneToOne(targetEntity="Individual", inversedBy="nationality")
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
     * Set nationality
     *
     * @param string $nationality
     *
     * @return NationalityClass
     */
    public function setNationality($nationality)
    {
        $this->nationality = $nationality;

        return $this;
    }

    /**
     * Get nationality
     *
     * @return string
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * Set motherTongue
     *
     * @param string $motherTongue
     *
     * @return NationalityClass
     */
    public function setMotherTongue($motherTongue)
    {
        $this->mother_tongue = $motherTongue;

        return $this;
    }

    /**
     * Get motherTongue
     *
     * @return string
     */
    public function getMotherTongue()
    {
        return $this->mother_tongue;
    }

    /**
     * Set individual
     *
     * @param \AppBundle\Entity\Individual $individual
     *
     * @return NationalityClass
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
