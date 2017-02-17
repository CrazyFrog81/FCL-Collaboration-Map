<?php

// scr/AppBundle/Twig/AppExtension.php

namespace AppBundle\Twig;

use Symfony\Bridge\Doctrine\RegistryInterface;
use AppBundle\Entity\User;

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
    );
  }

  public function nameFilter($data)
  {
    $user = $this->doctrine->getRepository('AppBundle:User')->find($data['id']);

    $name = $user->getUserName();

    $nameArray = explode(" ", $name);
    $choiceArray = explode(" ", $data['collaborated_before']);

    foreach($nameArray as $i){
      print_r("Name : " . $i);
      print_r('<br>');
      foreach($choiceArray as $j){
        print_r("Collaborated Before : " . $j);
        print_r('<br>');
      }
    }
  }

  public function toStringFilter($data)
  {
    $string = json_encode($data);
    $replace = str_replace(array('[', '"', ']', 'Other'), ' ', $string);
    $array = explode(",", $replace);
    print_r(implode(",", $array));
  }

  public function getName()
  {
    return 'app_extension';
  }
}

 ?>
