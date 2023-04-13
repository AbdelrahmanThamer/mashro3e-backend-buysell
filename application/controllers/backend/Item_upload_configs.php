<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Likes Controller
 */

class Item_upload_configs extends BE_Controller {

		/**
	 * Construt required variables
	 */
	function __construct() {

		parent::__construct( MODULE_CONTROL, 'ITEM_UPLOAD_CONFIGS' );
		///start allow module check 
		$conds_mod['module_name'] = $this->router->fetch_class();
		$module_id = $this->Module->get_one_by($conds_mod)->module_id;
		
		$logged_in_user = $this->ps_auth->get_user_info();

		$user_id = $logged_in_user->user_id;
		if(empty($this->User->has_permission( $module_id,$user_id )) && $logged_in_user->user_is_sys_admin!=1){
			return redirect( site_url('/admin') );
		}
		///end check
	}

	/**
	 * Load About Entry Form
	 */

	function index( $id = "1" ) {

		if ( $this->is_POST()) {
		// if the method is post

			// server side validation
			//if ( $this->is_valid_input()) {

				// save user info
				$this->save( $id );
			//}
		}
		
		//Get About Object
		$this->data['item_config'] = $this->Item_upload_config->get_one( $id );

		$this->load_form($this->data);

	}

	/**
	 * Update the existing one
	 */
	function edit( $id = "1") {


		// load user
		$this->data['item_config'] = $this->Item_upload_config->get_one( $id );

		// call the parent edit logic
		parent::edit( $id );
	}

	/**
	 * Saving Logic
	 * 1) save about data
	 * 2) check transaction status
	 *
	 * @param      boolean  $id  The about identifier
	 */
	function save( $id = false ) {
	
		// prepare data for save
		$data = array();

		// id
		if ( $this->has_data( 'id' )) {
			$data['id'] = $this->get_data( 'id' );
		}

		// if sub_cat_id is checked,
		if ( $this->has_data( 'sub_cat_id' )) {
			$data['sub_cat_id'] = 1;
		}else{
			$data['sub_cat_id'] = 0;
		}

		// if item_price_type_id is checked,
		if ( $this->has_data( 'item_price_type_id' )) {
			$data['item_price_type_id'] = 1;
		}else{
			$data['item_price_type_id'] = 0;
		}

		// if item_type_id is checked,
		if ( $this->has_data( 'item_type_id' )) {
			$data['item_type_id'] = 1;
		}else{
			$data['item_type_id'] = 0;
		}

		// if condition_of_item_id is checked,
		if ( $this->has_data( 'condition_of_item_id' )) {
			$data['condition_of_item_id'] = 1;
		}else{
			$data['condition_of_item_id'] = 0;
		}

		// if highlight_info is checked,
		if ( $this->has_data( 'highlight_info' )) {
			$data['highlight_info'] = 1;
		}else{
			$data['highlight_info'] = 0;
		}

		// if deal_option_id is checked,
		if ( $this->has_data( 'deal_option_id' )) {
			$data['deal_option_id'] = 1;
		}else{
			$data['deal_option_id'] = 0;
		}

		// if deal_option_remark is checked,
		if ( $this->has_data( 'deal_option_remark' )) {
			$data['deal_option_remark'] = 1;
		}else{
			$data['deal_option_remark'] = 0;
		}

		// if brand is checked,
		if ( $this->has_data( 'brand' )) {
			$data['brand'] = 1;
		}else{
			$data['brand'] = 0;
		}

		// if business_mode is checked,
		if ( $this->has_data( 'business_mode' )) {
			$data['business_mode'] = 1;
		}else{
			$data['business_mode'] = 0;
		}

		// if address is checked,
		if ( $this->has_data( 'address' )) {
			$data['address'] = 1;
		}else{
			$data['address'] = 0;
		}

		// if lat is checked,
		if ( $this->has_data( 'lat' )) {
			$data['lat'] = 1;
		}else{
			$data['lat'] = 0;
		}

		// if lng is checked,
		if ( $this->has_data( 'lng' )) {
			$data['lng'] = 1;
		}else{
			$data['lng'] = 0;
		}
		
		// if video is checked,
		if ( $this->has_data( 'video' )) {
			$data['video'] = 1;
		}else{
			$data['video'] = 0;
		}

		// if discount_rate_by_percentage is checked,
		if ( $this->has_data( 'discount_rate_by_percentage' )) {
			$data['discount_rate_by_percentage'] = 1;
		}else{
			$data['discount_rate_by_percentage'] = 0;
		}

		// if video_icon is checked,
		if ( $this->has_data( 'video_icon' )) {
			$data['video_icon'] = 1;
		}else{
			$data['video_icon'] = 0;
		}

		if ( ! $this->Item_upload_config->save( $data, $id )) {
		// if there is an error in inserting user data,	

			// set error message
			$this->data['error'] = get_msg( 'err_model' );
			
			return;
		}

		// commit the transaction
		if ( ! $this->check_trans()) {
        	
			// set flash error message
			$this->set_flash_msg( 'error', get_msg( 'err_model' ));
		} else {

			if ( $id ) {
			// if user id is not false, show success_add message
				
				$this->set_flash_msg( 'success', get_msg( 'success_item_config_edit' ));
			} else {
			// if user id is false, show success_edit message

				$this->set_flash_msg( 'success', get_msg( 'success_item_config_add' ));
			}
		}

		redirect( site_url('/admin/item_upload_configs') );
	}
}