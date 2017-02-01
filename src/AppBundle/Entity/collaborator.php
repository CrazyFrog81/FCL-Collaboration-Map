<?php

namespace AppBundle\Entity;

use JMS\Serializer\Annotation\Type;
use AppBundle\Entity\Individual;

class Collaborator{

  /**
  * @Type("array")
  */
  protected $id;

  /**
  * @Type("string")
  */
  protected $collaborated_before;

  public function getId(){
    $this->id;
  }

  public function setId($id)
  {
    $this->id = $id;
  }

  public function getCollaboratedBefore()
  {
    $this->collaborated_before;
  }

  public function setCollaboratedBefore($collaborated_before)
  {
    $this->collaborated_before = $collaborated_before;
  }
}



 ?>
