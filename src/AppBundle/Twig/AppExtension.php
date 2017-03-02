<?php

// scr/AppBundle/Twig/AppExtension.php

namespace AppBundle\Twig;

use Symfony\Bridge\Doctrine\RegistryInterface;
use AppBundle\Entity\User;
use Symfony\Component\Intl\Intl;

class AppExtension extends \Twig_Extension
{
  protected $doctrine;

  public function __construct(RegistryInterface $doctrine)
  {
    $this->doctrine = $doctrine;
  }

  public function getFilters()
  {
    return array(
      new \Twig_SimpleFilter('collaborators', array($this, 'nameFilter')),
      new \Twig_SimpleFilter('toString', array($this, 'toStringFilter')),
      new \Twig_SimpleFilter('projectList', array($this, 'projectListFilter')),
      new \Twig_SimpleFilter('section', array($this,'sectionFilter')),
      new \Twig_SimpleFilter('mother_tongue', array($this, 'motherTongueFilter')),
      new \Twig_SimpleFilter('collaborator_label', array($this, 'collaboratorLabelFilter')),
      new \Twig_SimpleFilter('project_label', array($this, 'projectLabelFilter')),
    );
  }

  public function nameFilter($data)
  {
    if(!is_numeric($data['id'])){
      $name = $data['id'];
      $name = str_replace(" ","_", $name);
    } else{
      $user = $this->doctrine->getRepository('AppBundle:User')->find($data['id']);

      $name = $user->getUserName();
    }

    $nameArray = explode(" ", $name);
    $choiceArray = explode(" ", $data['collaborated_before']);

    foreach($nameArray as $i){
      print_r('</br>');
      $i = str_replace("_", " ", $i);
      print_r("Name : " . "<br /><span style='font: bold 14px lato;'>". $i ."</span>");
      print_r('</br>');
      foreach($choiceArray as $j){
        print_r("<div style='margin-top:5px'>Collaborated Before : " . "<br /><span style='font: bold 14px lato;'>". $j ."</span></div>");
        print_r('<p></p>');
      }
    }
  }

  public function toStringFilter($data)
  {
    $string = json_encode($data);
    $other = (strpos($string, 'Other'));
    if ($other == null)
    {
      $replace = str_replace(array('[', ']', 'Other'), ' ', $string);
    }
    else {
      $replace = str_replace(array('[', '"', ']', 'Other'), ' ', $string);

    }
    $array = explode(",", $replace);
    return join(",", $array);
  }

  public function projectListFilter($data)
  {
    $index = str_replace(' ','_', $data);
    print_r('<li style="font-size:12px;font-family:lato;font-weight:bold;"><a href="#'. $index .'">'. $data .'</a></li>');
  }

  public function sectionFilter($data)
  {
    if(null === $data)
    {
      return '<section>';
    }
    else {
      $data = str_replace(' ','_', $data);
      print_r( '<section id="'. $data .'">');
    }
  }

  public function motherTongueFilter($data)
  {
      $languages = Intl::getLanguageBundle()->getLanguageNames('en');
      return($languages[$data]);
  }

  public function collaboratorLabelFilter($data)
  {
    return ('Collaborator #' . $data);
  }

  public function projectLabelFilter($data)
  {
    return ('Project #' . $data);
  }

  public function getName()
  {
    return 'app_extension';
  }
}
