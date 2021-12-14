<?php

require_once 'model.php';
require_once 'view.php';

class controller {
  
  //rutes o esdeveniments
  //view1: nom i edat
  //view2: nom i alçada
  private $peticions = array('view1', 'view2', 'view_select', 'form_select',
                             'view_insert', 'form_insert');
  
  public function handler () {
    
    $uri = $_SERVER['REQUEST_URI'];
    echo $uri;
    $event = 'inici';
    foreach ($this->peticions as $peticio)
      if (strpos($uri,$peticio) == true)
        $event = $peticio;
          
    $per = new usuari();
    
    $view = new view();
    
    switch ($event) {
        
        
        case 'view1':
          $dades = $per->selectAll(array("nom","edat"));
          $view->retornar_vista($event, $dades);
          break;
        
        case 'view2':
          $dades = $per->selectAll(array("nom","alcada"));
          $view->retornar_vista($event, $dades);
          break;
        
        case 'view_select':
          $user_data = $this->read_user_data();
          $dades = $per->select($user_data["nom"]);
          $view->retornar_vista($event, $dades, $per->message);
          break;

        case 'form_select':
          $view->retornar_vista($event,array());
          break;
        
        case 'view_insert':
          $user_data = $this->read_user_data();
          $dades = $per->insert($user_data);
          $view->retornar_vista($event, array(), $per->message);
          break;

        case 'form_insert':
          $view->retornar_vista($event,array());
          break;

      case 'inici':
        $view->retornar_vista($event, array());
        
              
        }
      
  }
  //verifica les dades del $_POST
  private function read_user_data () {
    $user_data = array();
    
    if($_POST) {
      
      if(array_key_exists("id",$_POST))
        $user_data['id'] = $_POST['id'];
     
      if(array_key_exists("nom",$_POST))
        $user_data['nom'] = $_POST['nom'];
        
      if(array_key_exists("contrasena",$_POST))
        $user_data['contrasena'] = $_POST['contrasena'];
    }
    
    return $user_data;
  }
  
}





?>