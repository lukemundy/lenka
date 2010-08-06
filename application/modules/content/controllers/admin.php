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
	
	/**
	 * Delete articles
	 * @return void
	 */
	public function delete()
	{
		$this->load->model('content_m');
		
		$articles = $this->input->post('articles');
		
		// Make sure we pass an array of integers to the delete method
		foreach ($articles as $k => $val) $articles[$k] = (int) $val;
		
		$result = $this->content_m->delete_article($articles) ? 'success' : 'failure';
		
		$this->output->set_output($result);
	}
}

// END - class Content