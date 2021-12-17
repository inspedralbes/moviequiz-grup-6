<?php

class view {
  
  private $diccionari = array (
    'subtitle' => array ('inici' => 'Buscar persona',
                         'view1' => 'Mostrar dades nom i edat',
                         'view2' => 'Mostrar dades nom i alcada',
                         'view_login' => 'Dades logeadas',
                         'form_login' => 'Logear persona',
                         'view_register' => 'Dades inserides',
                         'form_register' => 'Inserir persona'),
    'capçalera' => array ('view1' => array('nom','contrasenya'),
                         'view2' => array('nom','contrasenya'),
                         'view_login' => array('id','nom','contrasenya')),
    'form' => array ('form_login' => array('nom', 'contrasenya'),
                     'form_register' => array('nom','contrasenya', 'email')),
    'action' => array('form_login' => 'index.php?action=view_login',
                     'form_register' => 'index.php?action=view_register'),
    'butaction' => array('form_login' => 'logearse',
                        'form_register' => 'inserir'));
  

public function retornar_vista ($vista, $dades=array(), $message="Benvingut a la pagina Web") {
	
	// the main template is read (menu, message and the main body (a form or select result)
	$html = file_get_contents(__DIR__ . '/../site_media/html/index.html');
	
	// subtitle of the page is writen 
	$html = str_replace('{subtitle}', $this->diccionari['subtitle'][$vista], $html);
	
	// message passed by controller is writen 
	$html = str_replace('{message}', $message, $html);
	
	// the HTML table with the select result is built 
	
	
	 
	if ($vista=='inici' || ($vista=='view_login' && count($dades)==0) || $vista=='view_register')
		$vista='form_login';

	if ($vista=='form_login' || $vista=='form_register') {
		

		$form = file_get_contents(__DIR__ . '/../site_media/html/index.html');
		$html = str_replace('{main}', $form, $html);
		

		$action = $this->diccionari['action'][$vista];
		$html = str_replace('{action}', $action, $html);
		

		$formbody = $this->buildForm($vista);
		$html = str_replace('{formbody}', $formbody, $html);
		$html = str_replace('{butaction}',$this->diccionari['butaction'][$vista], $html);
	}
	

	print $html;
} 


private function buildHeader ($vista) {
	$str = "";
	foreach ($this->diccionari['capçalera'][$vista] as $value) 
		$str .= "<th>" . $value . "</th>";
	return $str;
} 


private function buildContents ($dades) {
	$str = "";
	for ($i=0; $i<count($dades); $i++) {
		$str .= "<tr>";
		foreach ($dades[$i] as $value) 
			$str .= "<td>$value</td>";
		$str .= "</tr>";
	}
	return $str;
}


private function buildForm ($vista) {
	$str = "";
	$i=0;
	foreach ($this->diccionari['form'][$vista] as $value) {
		$str .= "<div class=$i> $value </div>";
		if($i==1){
			$str .= "<div><input type='password' name='$value' id='$value'></div>";	
		}else{
			$str .= "<div><input type='text' name='$value' id='$value'></div>";	
		}
		$i++;
	}	
	return $str;
	}

}
?>