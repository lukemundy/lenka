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
			$this->session->set_userdata('logged_in', TRUE);
			
			// Send them back to where they came from, if possible
			if ($this->session->flashdata('return_to'))
			{
				log_message('debug', 'Sending user back to: '. $this->session->flashdata('return_to'));
				
				redirect($this->session->flashdata('return_to'));
			}
			else
			{
				redirect(site_url('admin'));
			}
		}
		else
		{
			// If user is already logged in, send them to the dashboard
			if ($this->session->userdata('logged_in'))
			{
				redirect('admin');
				
				return;
			}
			
			// Keep this until after the login has been processed
			$this->session->keep_flashdata('return_to');
			
			$this->data['page_title'] = 'User Login';
			
			$this->template->render('admin/login', $this->data);
		}
	}
	
	/**
	 * Logout
	 *
	 * Log the user out
	 * @return void
	 */
	public function logout()
	{
		$this->session->unset_userdata('logged_in');
		
		redirect('admin/login');
	}
}

// END - class Admin