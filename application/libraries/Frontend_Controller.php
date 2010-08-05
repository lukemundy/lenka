<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Frontend Controller
 *
 * Common code for all frontend controllers goes here
 * @package Lenka
 * @subpackage Libraries
 * @author Luke Mundy
 */
class Frontend_Controller extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		// Set template wrapper
		$this->template->set_wrapper('index.php');
	}
}

// END - class Frontend_Controller