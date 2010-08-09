<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Form Validation extention
 *
 * Extends the form validation library to give access to errors via an array.
 * @package Lenka
 * @subpackage Libraries
 * @author Luke Mundy
 */
class MY_Form_validation extends CI_Form_validation
{	
	/**
	 * Error Array
	 *
	 * Returns the error messages as an array.
	 * @return array
	 */	
	function error_array()
	{
		return $this->_error_array;
	}
}
// END - class MY_Form_validation