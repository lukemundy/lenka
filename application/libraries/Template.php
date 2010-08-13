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

	private $wrapper = '';
	private $data = array();

	private $title = '';
	private $head = array();

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
		
		// Provide access to this object in all views
		$this->data['tpl'] =& $this;
	}
	
	/**
	 * Add a Cascading Style Sheet to <head>
	 * @param string $css
	 * @return void
	 */
	public function add_css($css)
	{
		// Are we including an external sheet?
		if (strpos($css, 'http://') === FALSE)
		{
			// Does this file exist in the theme dir?
			$path = "theme/{$this->conf['theme']}/css/$css.css";
			
			if (file_exists(APPPATH.$path))
			{
				$this->head[] = '<link href="'. APP_URI . $path .'" rel="stylesheet" type="text/css" />';
			}
			else
			{
				// Check in module directory then
				$path = "modules/{$this->module}/js/$css.js";
				
				if (file_exists(APPPATH.$path))
				{
					$this->head[] = '<link href="'. APP_URI . $path .'" rel="stylesheet" type="text/css" />';
				}
				else
				{
					$this->head[] = "<!-- Could not locate stylesheet - $css.css -->";
				}
			}
			
		}
		else
		{
			$this->head[] = '<link href="'. $css .'" rel="stylesheet" type="text/css" />';
		}
	}
	
	/**
	 * Add a JavaScript source file to <head>
	 * @param string $script
	 * @return void
	 */
	public function add_script($script)
	{
		// Are we including an external script?
		if (strpos($script, 'http://') === FALSE)
		{
			// Does this file exist in the theme dir?
			$path = "theme/{$this->conf['theme']}/js/$script.js";
			
			if (file_exists(APPPATH.$path))
			{
				$this->head[] = '<script src="'. APP_URI . $path .'" type="text/javascript" ></script>';
			}
			else
			{
				// Check in module directory then
				$path = "modules/{$this->module}/js/$script.js";
				
				if (file_exists(APPPATH.$path))
				{
					$this->head[] = '<script src="'. APP_URI . $path .'" type="text/javascript"></script>';
				}
				else
				{
					$this->head[] = "<!-- Could not locate script - $script.js -->";
				}
			}
			
		}
		else
		{
			$this->head[] = '<script src="'. $script .'" type="text/javascript"></script>';
		}
	}
	
	/**
	 * Return all head data as a string
	 * @return void
	 */
	public function head_data()
	{
		return implode("\n\t", $this->head) ."\n";
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
	 * Find the wrapper view and return it's location
	 * @return string
	 */
	private function load_wrapper()
	{
		$path = NULL;
		
		// Have we been given one?
		if ($this->wrapper != '')
		{
			// Check theme directory for it
			if ($this->conf['theme'] != 'default')
			{
				$path = "theme/{$this->conf['theme']}/{$this->wrapper}";

				if (file_exists(APPPATH.$path)) $path = "../$theme_file";
			}
			// Check the default theme directory
			elseif (file_exists(APPPATH."theme/default/{$this->wrapper}"))
			{
				$path = "../theme/default/{$this->wrapper}";
			}
			// Otherwise we're fucked
			else
			{
				log_message('error', "Couldn't load template wrapper: {$this->wrapper}");
				show_error("Couldn't load template wrapper: {$this->wrapper}");
			}
		}
		else
		{
			log_message('error', 'No template wrapper supplied.');
			show_error('No template wrapper supplied.');
		}

		return $path;
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

		// Set a page title if one hasn't been set
		if (empty($this->data['page_title']))
		{
			if ($this->controller == $this->module) $title = "{$this->method} | {$this->module}";
			else $title = "{$this->method} | {$this->controller} | {$this->module}";

			$this->data['page_title'] = ucwords($title);
		}

		// Get all data needed to pass to views
		$this->data['theme_url'] = APP_URI . "theme/{$this->conf['theme']}/";

		// Get page body
		$this->data['page_body'] = $this->ci->load->view($view, $this->data, TRUE);

		/*
			Now we need to load the template wrapper. If we are using a custom
			theme, check that theme's directory for it. If not found, use the
			default one
		*/

		$wrapper = $this->load_wrapper();

		// Parse the page
		$page = $this->ci->load->view($wrapper, $this->data, TRUE);

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
		$this->title = (string) htmlentities($title);
	}

	/**
	 * Set which view to use as a wrapper
	 * @param string $wrapper
	 * @return void
	 */
	public function set_wrapper($wrapper)
	{
		$this->wrapper = (string) $wrapper;
	}
}

// END - class Template