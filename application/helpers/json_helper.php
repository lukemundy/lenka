<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * JSON Helper
 *
 * Functions for returning standardised JSON responses to AJAX scripts. They are
 * essentially just wrappers to PHP's built in JSON functions.
 * @package Lenka
 * @subpackage Helpers
 * @author Luke Mundy
 */

/**
 * Return a response message
 * @param bool $success
 * @param string $response
 * @param string $txt
 * @return string
 */
function json_response($success, $response, $txt)
{
	return json_encode(array(
		'success' => (bool) $success,
		'response' => $response,
		'txt' => $txt
	));
}

/**
 * Return a result set
 * @param array $results
 * @return string
 */
function json_result($results)
{
	return json_encode(array(
		'total' => count($results),
		'results' => $results
	));
}

// END - json_helper