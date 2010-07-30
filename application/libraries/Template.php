<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Template Class
 *
 * @package Lenka
 * @subpackage Libraries
 * @author Luke Mundy
 */
class Template
{
	private $ci = NULL;
	
	private $conf = array();
	
	private $data = array();
	
	private $title = '';
	
	/**
	 * Class Constructor
	 *
	 * Pass an array of configuration options to override defaults.
	 * @param array $options
	 * @return void
	 */
	public function __construct($options = array())
	{
		$this->ci =& get_instance();
		
		$this->initialise($options);
		
		log_message('debug', 'Template Class initialised.');
		
		$this->module = $this->ci->router->fetch_module();
		$this->controller = $this->ci->router->fetch_class();
		$this->method = $this->ci->router->fetch_method();
	}
	
	/**
	 * Initialise Configuration
	 * @param array $options
	 * @return void
	 */
	private function initialise($options = array())
	{
		$defaults = array(
			'theme' => 'default',
			'use_parser' => FALSE
		);
		
		$this->conf = array_merge($defaults, $options);
	}
	
	/**
	 * Renders the document
	 * @param string $view
	 * @param array $data
	 * @param bool $return_as_string
	 * @return string
	 */
	public function render($view, $data = array(), $return_as_string = FALSE)
	{
		// Add supplied data to any existing data
		$this->data = array_merge($this->data, $data);
		
		$this->data['page_title'] = $this->title ? $this->title : "{$this->method} | {$this->controller} | {$this->module}";
		
		/*
			Before we parse the view we need to see if there is an override in
			the current theme:			
			
				theme/<theme_name>/overrides/<module>/<view_name>
			
			If not we just load the default view from the module's view dir
			
				modules/<module>/views/<view_name>
		*/
		
		$override = "theme/{$this->conf['theme']}/overrides/{$this->module}/{$view}.php";
		
		if (file_exists(APPPATH.$override))
		{
			$view = "../$override";
		}
		
		// Get page body
		$this->data['page_body'] = $this->ci->load->view($view, $this->data, TRUE);
		
		/*
			Now we need to load the main template. If we are using a custom
			theme, check that theme's directory for it. If not found, use the
			default one
		*/
		
		if ($this->conf['theme'] != 'default')
		{
			$theme_file = "theme/{$this->conf['theme']}/index.php";
			
			if (file_exists(APPPATH.$theme_file)) $theme_file = "../$theme_file";
		}
		elseif (file_exists(APPPATH.'theme/default/index.php'))
		{
			$theme_file = "../theme/default/index.php";
		}
		else
		{
			show_error('Could not load default theme template.');
		}
		
		// Parse the page
		$page = $this->ci->load->view($theme_file, $this->data, TRUE);
		
		if ( ! $return_as_string) $this->ci->output->set_output($page);
		
		return $page;
	}
	
	/**
	 * Set the page title
	 * @param string $title
	 * @return void
	 */
	public function set_title($title)
	{
		$this->title = htmlentities($title);
	}
}

// END - class Template