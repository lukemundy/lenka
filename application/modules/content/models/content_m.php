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
	function get_recent($num = 5)
	{
		$content = array();
		
		// Database query
		$content = $this->db
			->where('state', 'published')
			->order_by('date', 'desc')
			->limit($num)
			->get('content')
			->result_array();
		
		return $content;
	}
	
	/**
	 * Returns a list of articles, minus their body.
	 * @param int $n Number of articles to return
	 * @param int $pg Page number for pagination
	 * @return array
	 */
	function get_list($n, $pg)
	{
		$content = $this->db
			->select('ID_CNT, stub, title, date, state')
			->limit($n, (($pg-1) * $n))
			->order_by('date', 'desc')
			->get('content')
			->result_array();
		
		return $content;
	}
}

// END - class Content_m