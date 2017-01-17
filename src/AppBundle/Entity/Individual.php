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
  * One individual has many partners
  * @ORM\OneToMany(targetEntity="individual", mappedBy="partners_id")
  */
  protected $id;

  /**
  * @ORM\Column(type="string")
  */
  protected $name;

  /**
  * @ORM\Column(type="string")
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
  * @ORM\Column(type="integer")
  */
  protected $age;

  /**
  * @ORM\OneToMany(targetEntity="Disciplinary", mappedBy="individual")
  */
  private $disciplinary_backgrounds;

  /**
  * @ORM\OneToOne(targetEntity="NationalityClass", mappedBy="individual")
  */
  protected $nationality;

  /**
  * @ORM\OneToOne(targetEntity="NationalityClass", mappedBy="individual")
  */
  protected $mother_tongue;

  /**
  * @ORM\OneToOne(targetEntity="Work", mappedBy="individual")
  */
  protected $research_group;

  /**
  * @ORM\OneToOne(targetEntity="Work", mappedBy="individual")
  */
  protected $location;

  /**
  * @ORM\OneToMany(targetEntity="Partner", mappedBy="individual")
  */
  protected $partners;

  /**
  * @ORM\OneToMany(targetEntity="Project", mappedBy="individual")
  */
  protected $projects;

  /**
  * many partners to one individual
  * @ORM\ManyToOne(targetEntity="individual", inversedBy="id")
  * @ORM\JoinColumn(name="partners_id", referencedColumnName="id")
  */
  protected $partners_id;
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
     * @param integer $age
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
     * @return integer
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Add disciplinary
     *
     * @param \AppBundle\Entity\Disciplinary $disciplinary
     *
     * @return Individual
     */
    public function addDisciplinary(\AppBundle\Entity\Disciplinary $disciplinary)
    {
        $this->disciplinary_backgrounds[] = $disciplinary;

        return $this;
    }

    /**
     * Remove disciplinary
     *
     * @param \AppBundle\Entity\Disciplinary $disciplinary
     */
    public function removeDisciplinary(\AppBundle\Entity\Disciplinary $disciplinary)
    {
        $this->disciplinary_backgrounds->removeElement($disciplinary);
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
     * Set nationality
     *
     * @param \AppBundle\Entity\NationalityClass $nationality
     *
     * @return Individual
     */
    public function setNationality(\AppBundle\Entity\NationalityClass $nationality = null)
    {
        $this->nationality = $nationality;

        return $this;
    }

    /**
     * Get nationality
     *
     * @return \AppBundle\Entity\NationalityClass
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * Set motherTongue
     *
     * @param \AppBundle\Entity\NationalityClass $mother_tongue
     *
     * @return Individual
     */
    public function setMotherTongue(\AppBundle\Entity\NationalityClass $mother_tongue = null)
    {
        $this->mother_tongue = $mother_tongue;

        return $this;
    }

    /**
     * Get motherTongue
     *
     * @return \AppBundle\Entity\NationalityClass
     */
    public function getMotherTongue()
    {
        return $this->mother_tongue;
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

    /**
     * Set location
     *
     * @param \AppBundle\Entity\Work $location
     *
     * @return Individual
     */
    public function setLocation(\AppBundle\Entity\Work $location = null)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return \AppBundle\Entity\Work
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Add partner
     *
     * @param \AppBundle\Entity\Partner $partner
     *
     * @return Individual
     */
    public function addPartner(\AppBundle\Entity\Partner $partner)
    {
        $this->partners[] = $partner;

        return $this;
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
        $this->projects[] = $project;

        return $this;
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

    /**
     * Set partnersId
     *
     * @param \AppBundle\Entity\individual $partnersId
     *
     * @return Individual
     */
    public function setPartnersId(\AppBundle\Entity\individual $partnersId = null)
    {
        $this->partners_id = $partnersId;

        return $this;
    }

    /**
     * Get partnersId
     *
     * @return \AppBundle\Entity\individual
     */
    public function getPartnersId()
    {
        return $this->partners_id;
    }
}
