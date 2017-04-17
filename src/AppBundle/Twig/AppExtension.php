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
      new \Twig_SimpleFilter('project_label', array($this, 'projectLabelFilter')),
    );
  }

  /*
  * $data received is 'id' attribute
  * hence access database to get the name of the collaborator to show at 'Confirmation' page
  */
  public function nameFilter($data)
  {
    if(!is_numeric($data['id'])){
      $name = $data['id'];
      $name = str_replace(" ","_", $name);
    } else{
      $user = $this->doctrine->getRepository('AppBundle:User')->find($data['id']);

      $name = $user->getUserName();
    }

    $count = 0;

    foreach($data as $i){
      if($count/2  == 0)
      {
        print_r('<td>'. $name . '</td>');
      }
      if($count/2 != 0)
      {
        print_r('<td>'. $i .'</td>');
        print_r('</tr>');
      }
      $count++;
    }
  }

  /* Turning an array of data into string on 'Confirmation' page */
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

  /* Changing 'Project 1' to project name submitted by the User at the 'Collaboration Information' page */
  public function projectListFilter($data)
  {
    $index = str_replace(' ','_', $data);
    print_r('<li style="font-size:12px;font-family:lato;font-weight:bold;"><a href="#'. $index .'">'. $data .'</a></li>');
  }

  /*
  * Naming project 'id' according to project name submitted by the user at the 'Collaboration Information' page
  * Used in javascript
  */
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

  /* Translate encoded language at 'Confirmation' page*/
  public function motherTongueFilter($data)
  {
      $languages = Intl::getLanguageBundle()->getLanguageNames('en');
      return($languages[$data]);
  }

  /* Increment the numbers of the projects at 'Confirmation' page */
  /* Project #1, Project #2 */
  public function projectLabelFilter($data)
  {
    return ('Project #' . $data);
  }

  public function getName()
  {
    return 'app_extension';
  }
}
