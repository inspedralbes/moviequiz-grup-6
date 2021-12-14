<?php

class view {
  
  private $diccionari = array (
    'subtitle' => array ('view1' => 'Mostrar dades nom i edat',
                         'view2' => 'Mostrar dades nom i alcada',
                         'view_select' => 'Dades persona',
                         'form_select' => 'Buscar persona',
                         'view_insert' => 'Dades inserides',
                         'form_insert' => 'Inserir persona'),
    'capçalera' => array ('view1' => array('nom','contrasena'),
                         'view2' => array('nom','contrasena'),
                         'view_select' => array('id','nom','contrasena')),
    'form' => array ('form_select' => array('nom'),
                     'form_insert' => array('nom','contrasena')),
    'action' => array('form_select' => 'index.php?action=view_select',
                     'form_insert' => 'index.php?action=view_insert'),
    'butaction' => array('form_select' => 'buscar',
                        'form_insert' => 'inserir'));
  

public function retornar_vista ($vista, $dades=array(), $message="Benvingut a la pagina Web") {
	
	// the main template is read (menu, message and the main body (a form or select result)
	$html = file_get_contents(__DIR__ . '/../site_media/html/persones_template.html');
	
	// subtitle of the page is writen 
	$html = str_replace('{subtitle}', $this->diccionari['subtitle'][$vista], $html);
	
	// message passed by controller is writen 
	$html = str_replace('{message}', $message, $html);
	
	// the HTML table with the select result is built 
	if ($vista=='view1' || $vista=='view2' || ($vista=='view_select' && count($dades)>0)) {
		
		// the view template is read and its contents is included in the main template
		$view = file_get_contents(__DIR__ . '/../site_media/html/view_template.html');
		$html = str_replace ('{main}', $view, $html);
		
		// the table header is built and writen on the template
		$capçalera = $this->buildHeader ($vista);
		$html = str_replace('{capçalera}', $capçalera,$html);
		
		// the table contents is built and writen on the template
		$contingut = $this->buildContents ($dades);
		$html = str_replace('{contingut}', $contingut, $html);
	}
	
	 
	if ( ($vista=='view_select' && count($dades)==0) || $vista=='view_insert')
		$vista='form_select';

	if ($vista=='form_select' || $vista=='form_insert') {
		

		$form = file_get_contents(__DIR__ . '/../site_media/html/form_template.html');
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
	foreach ($this->diccionari['form'][$vista] as $value) {
	
		$str .= "<div> $value </div>";
		$str .= "<div><input type='text' name='$value' id='$value'></div>";	
	}	
	return $str;
	}

}
?>