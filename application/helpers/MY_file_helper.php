<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * MY File Helper
 *
 * @package Lenka
 * @author Luke Mundy
 */

/**
 * Generate a random filename
 * @return string
 */
function generate_filename($ext = '.file')
{
	return md5(uniqid(mt_rand())) . $ext;
}
 
 // END - MY_file_helper.php