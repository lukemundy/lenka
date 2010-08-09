<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Content Model
 *
 * @package Lenka
 * @subpackage Libraries
 * @author Luke Mundy
 */
class Content_m extends Model
{
	/**
	 * Get recently posted articles
	 * @param int $num
	 * @return array
	 */
	public function get_recent($num = 5)
	{
		$content = array();
		
		// Database query
		$content = $this->db
			->where('state', 'published')
			->order_by('date', 'desc')
			->limit($num)
			->get('content')
			->result_array();
		
		// Convert MySQL date string to a unix timestamp
		foreach ($content as $k => $val) $content[$k]['date'] = mysql_to_unix($val['date']);
		
		return $content;
	}
	
	/**
	 * Returns a list of articles, minus their body.
	 * @param int $n Number of articles to return
	 * @param int $pg Page number for pagination
	 * @return array
	 */
	public function get_list($n, $pg)
	{
		$content = $this->db
			->select('ID_CNT, stub, title, date, state')
			->limit($n, (($pg-1) * $n))
			->order_by('date', 'desc')
			->get('content')
			->result_array();
		
		// Convert MySQL date string to a unix timestamp
		foreach ($content as $k => $val) $content[$k]['date'] = mysql_to_unix($val['date']);
		
		return $content;
	}
	
	/**
	 * Delete one or more articles
	 * @param array articles
	 * @return bool
	 */
	public function delete_article($articles)
	{
		foreach ($articles as $id) $this->db->or_where('ID_CNT', $id);
		
		$this->db->delete('content');
		
		return ($this->db->affected_rows() == count($articles));
	}
	
	/**
	 * Check if stub is unique
	 * @param string $stub
	 * @return bool
	 */
	public function stub_is_unique($stub)
	{
		$foo = $this->db
			->select('COUNT(*) as num')
			->where('stub', $stub)
			->get('content')
			->row();
		
		return ($foo->num == 0);
	}
	
	/**
	 * Update an article
	 * @param array $article
	 * @return void
	 */
	public function update($article)
	{
		$article['modified'] = date('Y-m-d H:i:s', now());
		
		$this->db
			->where('ID_CNT', $article['ID_CNT'])
			->update('content', $article);
	}
	
	/**
	 * Add new article to database
	 * @param array $article
	 * @return void
	 */
	public function create($article)
	{
		$article['date'] = date('Y-m-d H:i:s', now());
		
		$this->db->insert('content', $article);
	}
}

// END - class Content_m