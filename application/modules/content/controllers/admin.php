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
	 * Show Article Editor
	 * @return void
	 */
	public function create()
	{
		$this->template->render('admin/article_editor');
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
	
	/**
	 * Return parsed preview
	 * @return void
	 */
	public function preview()
	{
		$parsed = '';
		
		if ($_POST)
		{
			$this->load->helper('content');
			
			$parsed = parse_markdown($this->input->post('txt'));
		}
		
		$this->output->set_output($parsed);
	}
	
	/**
	 * Save an article
	 * @return void
	 */
	public function save()
	{
		// Only continue if POST data given
		if (empty($_POST)) return;
		
		$this->load->library('form_validation');
		
		// Set default validation rules
		$this->form_validation->set_rules(array(
			array(
				'field' => 'title',
				'label' => 'Article title',
				'rules' => 'trim|htmlspecialchars|required|min_length[4]|max_length[255]'
			),
			array(
				'field' => 'stub',
				'label' => 'Article stub',
				'rules' => 'trim|strtolower|required|alpha_dash|min_length[4]|max_length[64]|callback_stubcheck'
			),
			array(
				'field' => 'state',
				'label' => 'State',
				'rules' => 'required|numeric'
			),
			array(
				'field' => 'body',
				'label' => 'Article body',
				'rules' => 'trim|required'
			)
		));
		
		$this->form_validation->set_message('stubcheck', 'The stub you entered already exists in the database. Please choose a unique stub.');
		
		// Are we updating an existing article or creating a new one?
		if ($this->input->post('ID_CNT'))
		{	// Updating
			// Add validation rule for the article ID
			$this->form_validation->set_rules('ID_CNT', 'Article ID', 'required|numeric');
			
			// Run validation
			if ($this->form_validation->run() == FALSE)
			{
				print_r($this->form_validation->error_array());
			}
			else
			{
				$article = array(
					'ID_CNT' => $this->input->post('ID_CNT'),
					'title' => $this->input->post('title'),
					'stub' => $this->input->post('stub'),
					'state' => $this->input->post('state'),
					'body' => $this->input->post('body')
				);
				
				$this->content_m->update($article);
			}
		}
		else
		{	// New article
			// Run validation
			if ($this->form_validation->run() == FALSE)
			{
				print_r($this->form_validation->error_array());
			}
			else
			{
				$article = array(
					'title' => $this->input->post('title'),
					'stub' => $this->input->post('stub'),
					'state' => $this->input->post('state'),
					'body' => $this->input->post('body')
				);
				
				$this->content_m->create($article);
			}
		}
	}
	
	/**
	 * Validation Callback function - Checks that stub is unique
	 * @param string $str
	 * @return bool
	 */
	public function stubcheck($str)
	{
		$this->load->model('content_m');
		
		return $this->content_m->stub_is_unique($str);
	}
}

// END - class Content/Admin