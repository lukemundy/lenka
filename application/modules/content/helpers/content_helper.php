<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Content Helper Functions
 *
 * @package Lenka
 * @author Luke Mundy
 */

/**
 * Parse Markdown markup
 * @param string $txt
 * @return string
 */
function parse_markdown($txt)
{
	$parsed = '';
	
	// Get CodeIgniter instance so we can get some config values
	$ci =& get_instance();
	$ci->config->load('content');
	
	$markdown = $ci->config->item('path_to_markdown');
	
	// Find path to perl
	$perl = trim(`which perl`);
	
	// Create a tempfile with the text in it
	$tmpfile = $ci->config->item('tmp_dir') . generate_filename('.txt');
	
	write_file($tmpfile, $txt);
	
	if (is_readable($markdown) && is_readable($perl) && is_really_writable($tmpfile))
	{
		$parsed = shell_exec("$perl $markdown $tmpfile");
		
		// Remove tmpfile
		unlink($tmpfile);
	}
	else
	{
		log_message('error', 'Could not read Perl executable, Markdown.pl or write to temp dir - check paths and permissions.');
		
		$parsed = nl2br(htmlentities($txt));
	}
	
	return $parsed;
}
 
 // END - content_helper.php