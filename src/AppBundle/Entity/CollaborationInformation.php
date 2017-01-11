<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="collaboration_information")
*/

class CollaborationInformation
{
  /**
  * @ORM\Column(type="integer")
  * @ORM\Id
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
  public $research_group;

  /**
  * @ORM\Column(type="string")
  */
  public $disciplinary_background;

  /**
  * @ORM\Column(type="string")
  */
  public $work_location;

  /**
  * @ORM\Column(type="string")
  */
  public $work_start_date;

  /**
  * @ORM\Column(type="string")
  */
  public $working_duration_before_join;

  /**
  * @ORM\Column(type="string")
  */
  public $academic_background;

  /**
  * @ORM\Column(type="string")
  */
  public $mother_tongue;

  /**
  * @ORM\Column(type="string")
  */
  public $gender;

  /**
  * @ORM\Column(type="integer")
  */
  public $age;

  /**
  * @ORM\Column(type="string")
  */
  public $nationality;

  /**
  * @ORM\Column(type="string")
  */
  public $collaboration_with;

  /**
  * @ORM\Column(type="string")
  */
  public $project_name;

  /**
  * @ORM\Column(type="string")
  */
  public $project_completion_date;

  /**
  * @ORM\Column(type="string")
  */
  public $collaborated_before;

  /**
  * @ORM\Column(type="integer")
  */
  public $project_working_time;

  /**
  * @ORM\Column(type="string")
  */
  public $expected_outcome;

    /**
     * Get entryId
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
     * @return CollaborationInformation
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
     * Set researchGroup
     *
     * @param string $researchGroup
     *
     * @return CollaborationInformation
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
     * Set disciplinaryBackground
     *
     * @param array $disciplinaryBackground
     *
     * @return CollaborationInformation
     */
    public function setDisciplinaryBackground($disciplinaryBackground)
    {
        $this->disciplinary_background = $disciplinaryBackground;

        return $this;
    }

    /**
     * Get disciplinaryBackground
     *
     * @return array
     */
    public function getDisciplinaryBackground()
    {
        return $this->disciplinary_background;
    }

    /**
     * Set workLocation
     *
     * @param string $workLocation
     *
     * @return CollaborationInformation
     */
    public function setWorkLocation($workLocation)
    {
        $this->work_location = $workLocation;

        return $this;
    }

    /**
     * Get workLocation
     *
     * @return string
     */
    public function getWorkLocation()
    {
        return $this->work_location;
    }

    /**
     * Set workStartDate
     *
     * @param \DateTime $workStartDate
     *
     * @return CollaborationInformation
     */
    public function setWorkStartDate($workStartDate)
    {
        $this->work_start_date = $workStartDate;

        return $this;
    }

    /**
     * Get workStartDate
     *
     * @return \DateTime
     */
    public function getWorkStartDate()
    {
        return $this->work_start_date;
    }

    /**
     * Set workingDurationBeforeJoin
     *
     * @param string $workingDurationBeforeJoin
     *
     * @return CollaborationInformation
     */
    public function setWorkingDurationBeforeJoin($workingDurationBeforeJoin)
    {
        $this->working_duration_before_join = $workingDurationBeforeJoin;

        return $this;
    }

    /**
     * Get workingDurationBeforeJoin
     *
     * @return string
     */
    public function getWorkingDurationBeforeJoin()
    {
        return $this->working_duration_before_join;
    }

    /**
     * Set academicBackground
     *
     * @param string $academicBackground
     *
     * @return CollaborationInformation
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
     * Set motherTongue
     *
     * @param array $motherTongue
     *
     * @return CollaborationInformation
     */
    public function setMotherTongue($motherTongue)
    {
        $this->mother_tongue = $motherTongue;

        return $this;
    }

    /**
     * Get motherTongue
     *
     * @return array
     */
    public function getMotherTongue()
    {
        return $this->mother_tongue;
    }

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return CollaborationInformation
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
     * @return CollaborationInformation
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
     * Set nationality
     *
     * @param string $nationality
     *
     * @return CollaborationInformation
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
     * Set collaborationWith
     *
     * @param string $collaborationWith
     *
     * @return CollaborationInformation
     */
    public function setCollaborationWith($collaborationWith)
    {
        $this->collaboration_with = $collaborationWith;

        return $this;
    }

    /**
     * Get collaborationWith
     *
     * @return string
     */
    public function getCollaborationWith()
    {
        return $this->collaboration_with;
    }

    /**
     * Set projectName
     *
     * @param string $projectName
     *
     * @return CollaborationInformation
     */
    public function setProjectName($projectName)
    {
        $this->project_name = $projectName;

        return $this;
    }

    /**
     * Get projectName
     *
     * @return string
     */
    public function getProjectName()
    {
        return $this->project_name;
    }

    /**
     * Set projectCompletionDate
     *
     * @param \DateTime $projectCompletionDate
     *
     * @return CollaborationInformation
     */
    public function setProjectCompletionDate($projectCompletionDate)
    {
        $this->project_completion_date = $projectCompletionDate;

        return $this;
    }

    /**
     * Get projectCompletionDate
     *
     * @return \DateTime
     */
    public function getProjectCompletionDate()
    {
        return $this->project_completion_date;
    }

    /**
     * Set collaboratedBefore
     *
     * @param string $collaboratedBefore
     *
     * @return CollaborationInformation
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
     * Set projectWorkingTime
     *
     * @param integer $projectWorkingTime
     *
     * @return CollaborationInformation
     */
    public function setProjectWorkingTime($projectWorkingTime)
    {
        $this->project_working_time = $projectWorkingTime;

        return $this;
    }

    /**
     * Get projectWorkingTime
     *
     * @return integer
     */
    public function getProjectWorkingTime()
    {
        return $this->project_working_time;
    }

    /**
     * Set expectedOutcome
     *
     * @param array $expectedOutcome
     *
     * @return CollaborationInformation
     */
    public function setExpectedOutcome($expectedOutcome)
    {
        $this->expected_outcome = $expectedOutcome;

        return $this;
    }

    /**
     * Get expectedOutcome
     *
     * @return array
     */
    public function getExpectedOutcome()
    {
        return $this->expected_outcome;
    }
}
