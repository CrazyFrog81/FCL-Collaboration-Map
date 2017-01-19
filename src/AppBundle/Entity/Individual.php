<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="individual")
 */
class Individual
{
  /**
  * @ORM\Id
  * @ORM\Column(type="integer")
  * @ORM\GeneratedValue(strategy="AUTO")
  */
  //One individual has many partners
  //ORM\OneToMany(targetEntity="individual", mappedBy="partners_id")
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
  protected $work_duration_in_fcl;

  /**
  * @ORM\Column(type="string")
  */
  protected $academic_background;

  /**
  * @ORM\Column(type="string")
  */
  protected $gender;

  /**
  * @ORM\Column(type="string")
  */
  protected $age;

  /**
  * @ORM\OneToMany(targetEntity="Disciplinary", mappedBy="individual", cascade={"persist"})
  */
  private $disciplinary_backgrounds;

  /**
  * @ORM\Column(type="string")
  */
  protected $nationality;

  /**
  * @ORM\Column(type="string", length=200)
  */
  protected $mother_tongue;

  /**
  * @ORM\OneToOne(targetEntity="Work", mappedBy="individual", cascade={"persist", "merge"})
  */
  protected $research_group;

  /**
  * @ORM\Column(type="string")
  */
  protected $location;

  /**
  * @ORM\OneToMany(targetEntity="Partner", mappedBy="individual", cascade={"persist"})
  */
  protected $partners;

  /**
  * @ORM\OneToMany(targetEntity="Project", mappedBy="individual", cascade={"persist"})
  */
  protected $projects;

  // /**
  // * many partners to one individual
  // * @ORM\ManyToOne(targetEntity="individual", inversedBy="id")
  // * @ORM\JoinColumn(name="partners_id", referencedColumnName="id")
  // */
  // protected $partners_id;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->disciplinary_backgrounds = new \Doctrine\Common\Collections\ArrayCollection();
        $this->partners = new \Doctrine\Common\Collections\ArrayCollection();
        $this->projects = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Individual
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
     * Set startDate
     *
     * @param string $startDate
     *
     * @return Individual
     */
    public function setStartDate($startDate)
    {
        $this->start_date = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return string
     */
    public function getStartDate()
    {
        return $this->start_date;
    }

    /**
     * Set workDurationInFcl
     *
     * @param string $workDurationInFcl
     *
     * @return Individual
     */
    public function setWorkDurationInFcl($workDurationInFcl)
    {
        $this->work_duration_in_fcl = $workDurationInFcl;

        return $this;
    }

    /**
     * Get workDurationInFcl
     *
     * @return string
     */
    public function getWorkDurationInFcl()
    {
        return $this->work_duration_in_fcl;
    }

    /**
     * Set academicBackground
     *
     * @param string $academicBackground
     *
     * @return Individual
     */
    public function setAcademicBackground($academicBackground)
    {
        $this->academic_background = $academicBackground;

        return $this;
    }

    /**
     * Get academicBackground
     *
     * @return string
     */
    public function getAcademicBackground()
    {
        return $this->academic_background;
    }

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return Individual
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set age
     *
     * @param string $age
     *
     * @return Individual
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return string
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Get disciplinaryBackgrounds
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDisciplinaryBackgrounds()
    {
        return $this->disciplinary_backgrounds;
    }

    /**
     * Set researchGroup
     *
     * @param \AppBundle\Entity\Work $researchGroup
     *
     * @return Individual
     */
    public function setResearchGroup(\AppBundle\Entity\Work $researchGroup = null)
    {
        $this->research_group = $researchGroup;

        $researchGroup->setIndividual($this);

        return $this;
    }

    /**
     * Get researchGroup
     *
     * @return \AppBundle\Entity\Work
     */
    public function getResearchGroup()
    {
        return $this->research_group;
    }

    // /**
    //  * Set location
    //  *
    //  * @param \AppBundle\Entity\Work $location
    //  *
    //  * @return Individual
    //  */
    // public function setLocation(\AppBundle\Entity\Work $location = null)
    // {
    //     $this->location = $location;
    //
    //     return $this;
    // }
    //
    // /**
    //  * Get location
    //  *
    //  * @return \AppBundle\Entity\Work
    //  */
    // public function getLocation()
    // {
    //     return $this->location;
    // }

    /**
     * Add partner
     *
     * @param \AppBundle\Entity\Partner $partner
     *
     * @return Individual
     */
    public function addPartner(Partner $partner)
    {
        $partner->setIndividual($this);
        $this->partners->add($partner);
    }

    /**
     * Remove partner
     *
     * @param \AppBundle\Entity\Partner $partner
     */
    public function removePartner(\AppBundle\Entity\Partner $partner)
    {
        $this->partners->removeElement($partner);
    }

    /**
     * Get partners
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPartners()
    {
        return $this->partners;
    }

    /**
     * Add project
     *
     * @param \AppBundle\Entity\Project $project
     *
     * @return Individual
     */
    public function addProject(\AppBundle\Entity\Project $project)
    {
      $this->projects->add($project);

      $project->setIndividual($this);
    }

    /**
     * Remove project
     *
     * @param \AppBundle\Entity\Project $project
     */
    public function removeProject(\AppBundle\Entity\Project $project)
    {
        $this->projects->removeElement($project);
    }

    /**
     * Get projects
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProjects()
    {
        return $this->projects;
    }

    // /**
    //  * Set partnersId
    //  *
    //  * @param \AppBundle\Entity\individual $partnersId
    //  *
    //  * @return Individual
    //  */
    // public function setPartnersId(\AppBundle\Entity\individual $partnersId = null)
    // {
    //     $this->partners_id = $partnersId;
    //
    //     return $this;
    // }
    //
    // /**
    //  * Get partnersId
    //  *
    //  * @return \AppBundle\Entity\individual
    //  */
    // public function getPartnersId()
    // {
    //     return $this->partners_id;
    // }

    public function __toString()
    {
      return $this->getName();
    }

    /**
     * Set nationality
     *
     * @param string $nationality
     *
     * @return Individual
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
     * @return Individual
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
     * Add disciplinaryBackground
     *
     * @param \AppBundle\Entity\Disciplinary $disciplinaryBackground
     *
     * @return Individual
     */
    public function addDisciplinaryBackground(Disciplinary $disciplinaryBackground)
    {
        $this->disciplinary_backgrounds->add($disciplinaryBackground);
        $disciplinaryBackground->setIndividual($this);
    }

    /**
     * Remove disciplinaryBackground
     *
     * @param \AppBundle\Entity\Disciplinary $disciplinaryBackground
     */
    public function removeDisciplinaryBackground(\AppBundle\Entity\Disciplinary $disciplinaryBackground)
    {
        $this->disciplinary_backgrounds->removeElement($disciplinaryBackground);
    }

    /**
     * Set location
     *
     * @param string $location
     *
     * @return Individual
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
}
