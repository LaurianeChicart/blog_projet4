<?php

class View
{

	private $_template;

	public function __construct($template)
	{
		$this->_template = $template;
	}

	public function getViewFront($params1 = array(), $params2 = array(), $params3 = array(), $params4 = array())
	{
		extract($params1); //récupération des paramètres
		extract($params2);
		extract($params3);
		extract($params4);
		
		$template = $this->_template;

		ob_start();
		include('view/frontend/' . $template . '.php');
		$contentPage = ob_get_clean();
		include_once('view/frontend/_gabarit.php');
	}

	public function getViewBack($params1 = array(), $params2 = array(), $params3 = array())
	{
		extract($params1); 
		extract($params2);
		extract($params3);

		$template = $this->_template;

		ob_start();
		include('view/backend/' . $template . '.php');
		$contentPage = ob_get_clean();
		include_once('view/backend/_gabarit.php');
	}
}

