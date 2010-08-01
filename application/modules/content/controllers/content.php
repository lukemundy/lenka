<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Content Controller
 *
 * @package Lenka
 * @subpackage Libraries
 * @author Luke Mundy
 */
class Content extends MY_Controller
{
	/**
	 * Content index page
	 *
	 * Shows recently posted articles.
	 * @return void
	 */
	public function index()
	{
		$this->load->model('content_m');
		
		$this->data['articles'] = $this->content_m->get_recent();
		
		$this->template->render('recently_posted', $this->data);
	}
}

// END - class Content