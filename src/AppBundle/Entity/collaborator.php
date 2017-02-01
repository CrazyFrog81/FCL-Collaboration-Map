<?php

namespace AppBundle\Entity;

class Collaborator{

  protected $id;
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
