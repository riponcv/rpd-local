<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter URL Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/url_helper.html
 */

// ------------------------------------------------------------------------

/**
 * Site URL
 *
 * Create a local URL based on your basepath. Segments can be passed via the
 * first parameter either as a string or an array.
 *
 * @access	public
 * @param	string
 * @return	string
 */
if ( ! function_exists('get_common_year'))
{
	function get_common_year($status=0)
	{
		$CI =& get_instance();
        $data=array();
        $where='';
        if($status==1)
        {
           $where=" WHERE status='$status' "; 
        }
		$query = $CI->db->query("SELECT * FROM genYrTbl $where ORDER BY order_id DESC");
       
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result_array() as $row)
		   {
		   		$data[]= $row['yr'];
		   }
		}
		return $data; 
	}
}

/* End of file base_helper.php */
/* Location: ./application/helpers/base_helper.php */