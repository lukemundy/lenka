<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Content Admin Controller
 *
 * @package Lenka
 * @subpackage Libraries
 * @author Luke Mundy
 */
class Admin extends Backend_Controller
{
	/**
	 * List Articles
	 *
	 * Lists all editable articles
	 * @return void
	 */
	public function index()
	{
		$this->load->model('content_m');
		
		$this->data['module_title'] = 'Recently Added';
		$this->data['articles'] = $this->content_m->get_list(20, 1);
		
		$this->template->render('admin/article_list', $this->data);
	}
}

// END - class Content