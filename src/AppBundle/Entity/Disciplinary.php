<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Individual;

/**
* @ORM\Entity
* @ORM\Table(name="disciplinary")
*/
class Disciplinary
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
  protected $disciplinary_background;

  /**
  * @ORM\ManyToOne(targetEntity="Individual", inversedBy="disciplinary_backgrounds")
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
     * Set disciplinaryBackground
     *
     * @param string $disciplinaryBackground
     *
     * @return Disciplinary
     */
    public function setDisciplinaryBackground($disciplinaryBackground)
    {
        $this->disciplinary_background = $disciplinaryBackground;

        return $this;
    }

    /**
     * Get disciplinaryBackground
     *
     * @return string
     */
    public function getDisciplinaryBackground()
    {
        return $this->disciplinary_background;
    }

    /**
     * Set individual
     *
     * @param \AppBundle\Entity\Individual $individual
     *
     * @return Disciplinary
     */
    public function setIndividual(Individual $individual)
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

    public function __toString(){
      return $this->getDisciplinaryBackground();
    }
}
