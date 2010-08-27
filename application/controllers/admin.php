<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Default Admin Controller
 *
 * @package Lenka
 * @subpackage Libraries
 * @author Luke Mundy
 */
class Admin extends Backend_Controller
{
	/**
	 * Show Dashboard
	 *
	 * Shows the administrator dashboard
	 * @return void
	 */
	public function index()
	{
		$this->output->set_output('gday');
	}
	
	/**
	 * Login Form
	 *
	 * Displays a login form
	 * @return void
	 */
	public function login()
	{
		// Check for POST data
		if ($_POST)
		{
			// ... do login
		}
		else
		{
			$this->data['page_title'] = 'User Login';
			
			$this->template->render('admin/login', $this->data);
		}
	}
}

// END - class Admin