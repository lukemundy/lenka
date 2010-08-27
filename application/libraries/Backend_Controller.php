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
		
		// Check that user is logged in
		if ( ! $this->session->userdata('logged_in'))
		{
			// Only redirect them if they aren't logging in
			if ($this->method != 'login')
			{
				log_message('debug', 'User not logged in, disallowing access to: '. $this->uri->uri_string());
				
				// Save this location in flashdata so they can return here once logged in.
				$this->session->set_flashdata('return_to', $this->uri->uri_string());
				
				redirect('admin/login');
			}
		}
	}
}

// END - class Backend_Controller