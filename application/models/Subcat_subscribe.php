<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model class for touch table
 */
class Subcat_subscribe extends PS_Model {

	/**
	 * Constructs the required data
	 */
	function __construct() 
	{
		parent::__construct( 'bs_subcat_subscribes', 'id', 'subcat_scr_' );
	}

	/**
	 * Implement the where clause
	 *
	 * @param      array  $conds  The conds
	 */
	function custom_conds( $conds = array())
	{
        // id condition
		if ( isset( $conds['id'] )) {
			$this->db->where( 'id', $conds['id'] );
		}

		// user_id condition
		if ( isset( $conds['user_id'] )) {
			$this->db->where( 'user_id', $conds['user_id'] );
		}

		// cat_id condition
		if ( isset( $conds['cat_id'] )) {
			$this->db->where( 'cat_id', $conds['cat_id'] );
		}

		// subcat_id condition
		if ( isset( $conds['subcat_id'] )) {
			$this->db->where( 'subcat_id', $conds['subcat_id'] );
		}

		// subcat_id_fe condition
		if ( isset( $conds['subcat_id_fe'] )) {
			$this->db->where( 'subcat_id', $conds['subcat_id_fe'] . '_FE' );
		}

		// subcat_id_mb condition
		if ( isset( $conds['subcat_id_mb'] )) {
			$this->db->where( 'subcat_id', $conds['subcat_id_mb'] . '_MB' );
		}

	}
}