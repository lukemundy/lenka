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
		
		$this->template->add_script('index');
		
		$this->template->render('admin/article_list', $this->data);
	}
	
	/**
	 * Show Article Editor
	 * @return void
	 */
	public function create()
	{
		$this->template->add_script('article_editor');
		
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
	 * Edit an article
	 * @return void
	 */
	public function edit($id)
	{
		$this->load->model('content_m');
		
		// Check article exists
		if ($article = $this->content_m->get_article((int) $id))
		{
			$this->data['article'] = $article;
			$this->data['page_title'] = "Editing: {$article['title']}";
			$this->template->add_script('article_editor');
			
			$this->template->render('admin/article_editor', $this->data);
		}
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
		$this->load->helper('json');
		
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
				'rules' => 'required|is_natural_no_zero'
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
			$this->form_validation->set_rules('ID_CNT', 'Article ID', 'required|integer');
			
			// Run validation
			if ($this->form_validation->run() == FALSE)
			{
				$errors = $this->form_validation->error_string('<li>', '</li>');
				
				$response = json_response(FALSE, 'Could not save changes', "<ul>$errors</ul>");
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
				
				$response = json_response(TRUE, 'Article Saved Successfully', "The article \"{$article['title']}\" was successfully saved.");
			}
		}
		else
		{	// New article
			// Run validation
			if ($this->form_validation->run() == FALSE)
			{
				$errors = $this->form_validation->error_string('<li>', '</li>');
				
				$response = json_response(FALSE, 'Could not save changes', "<ul>$errors</ul>");
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
				
				$response = json_response(TRUE, 'Article Saved Successfully', "The article \"{$article['title']}\" was successfully saved.");
			}
		}
		
		$this->output->set_output($response);
	}
	
	/**
	 * Validation Callback function - Checks that stub is unique
	 * @param string $str
	 * @return bool
	 */
	public function stubcheck($str)
	{
		$this->load->model('content_m');
		
		$this->form_validation->set_message('stubcheck', 'The stub you entered already exists in the database. Please choose a unique stub.');
		
		return $this->content_m->stub_is_unique($str, $this->input->post('ID_CNT'));
	}
}

// END - class Content/Admin