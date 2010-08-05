<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Backend Controller
 *
 * Common code for all backend controllers goes here
 * @package Lenka
 * @subpackage Libraries
 * @author Luke Mundy
 */
class Backend_Controller extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		// Set template wrapper
		$this->template->set_wrapper('admin.php');
	}
}

// END - class Backend_Controller