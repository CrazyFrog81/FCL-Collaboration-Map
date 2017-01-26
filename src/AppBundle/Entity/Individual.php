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
  //One individual has many collaborators
  //ORM\OneToMany(targetEntity="individual", mappedBy="collaborators_id")
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
  protected $before_fcl;

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
  * @ORM\Column(type="simple_array")
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
  * @ORM\Column(type="string")
  */
  protected $research_group;

  /**
  * @ORM\Column(type="simple_array")
  */
  protected $locations;

  /**
  * @ORM\OneToMany(targetEntity="collaborator", mappedBy="individual", cascade={"persist"})
  */
  protected $collaborators;

  /**
  * @ORM\OneToMany(targetEntity="Project", mappedBy="individual", cascade={"persist"})
  */
  protected $projects;

  // /**
  // * many collaborators to one individual
  // * @ORM\ManyToOne(targetEntity="individual", inversedBy="id")
  // * @ORM\JoinColumn(name="collaborators_id", referencedColumnName="id")
  // */
  // protected $collaborators_id;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->collaborators = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return simple_array
     */
    public function getDisciplinaryBackgrounds()
    {
        return $this->disciplinary_backgrounds;
    }

    /**
     * Set disciplinaryBackgrounds
     *
     * @return Individual
     */
    public function setDisciplinaryBackgrounds($disciplinary_backgrounds)
    {
        return $this->disciplinary_backgrounds = $disciplinary_backgrounds;
    }

    /**
     * Set researchGroup
     *
     *
     * @return Individual
     */
    public function setResearchGroup($researchGroup)
    {
        $this->research_group = $researchGroup;
    }

    /**
     * Get researchGroup
     *
     * @return simple_array
     */
    public function getResearchGroup()
    {
        return $this->research_group;
    }

    /**
     * Add collaborator
     *
     * @param \AppBundle\Entity\collaborator $collaborator
     *
     * @return Individual
     */
    public function addcollaborator(collaborator $collaborator)
    {
        $collaborator->setIndividual($this);
        $this->collaborators->add($collaborator);
    }

    /**
     * Remove collaborator
     *
     * @param \AppBundle\Entity\collaborator $collaborator
     */
    public function removecollaborator(\AppBundle\Entity\collaborator $collaborator)
    {
        $this->collaborators->removeElement($collaborator);
    }

    /**
     * Get collaborators
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getcollaborators()
    {
        return $this->collaborators;
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
    //  * Set collaboratorsId
    //  *
    //  * @param \AppBundle\Entity\individual $collaboratorsId
    //  *
    //  * @return Individual
    //  */
    // public function setcollaboratorsId(\AppBundle\Entity\individual $collaboratorsId = null)
    // {
    //     $this->collaborators_id = $collaboratorsId;
    //
    //     return $this;
    // }
    //
    // /**
    //  * Get collaboratorsId
    //  *
    //  * @return \AppBundle\Entity\individual
    //  */
    // public function getcollaboratorsId()
    // {
    //     return $this->collaborators_id;
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
     * Set locations
     *
     * @param simple_array $locations
     *
     * @return Individual
     */
    public function setLocations($locations)
    {
        $this->locations = $locations;

        return $this;
    }

    /**
     * Get location
     *
     * @return simple_array
     */
    public function getLocations()
    {
        return $this->locations;
    }

    /**
     * Set beforeFcl
     *
     * @param string $beforeFcl
     *
     * @return Individual
     */
    public function setBeforeFcl($beforeFcl)
    {
        $this->before_fcl = $beforeFcl;

        return $this;
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
}
