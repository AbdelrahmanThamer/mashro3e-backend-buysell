<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Sitemap class for sitemap log table
 */
class Sitemap_generator extends PS_Model {

	/**
	 * Constructs the required data
	 */
	function __construct() 
	{
		parent::__construct( 'bs_sitemap_logs', 'id','log_');   
	}

	/**
	 * Implement the where clause
	 *
	 * @param      array  $conds  The conds
	 */
	function custom_conds( $conds = array())
	{

		// sitemap_path condition
		if ( isset( $conds['sitemap_path'] )) {
			
			if ($conds['sitemap_path'] != "") {
				if($conds['sitemap_path'] != '0'){
					$this->db->where( 'sitemap_path', $conds['sitemap_path'] );	
				}
			}			
		}

		$this->db->order_by( 'added_date', 'desc' );

	}
}
	