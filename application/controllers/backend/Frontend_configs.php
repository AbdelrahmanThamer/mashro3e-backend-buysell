<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Mobile settings Controller
 */


class Frontend_configs extends BE_Controller
{
	protected $languages = array(
		array('language_code'=> 'en', 'country_code' => 'US', 'name' => 'English'),
		array('language_code'=> 'ar', 'country_code' => 'DZ', 'name' => 'Arabic'),
		array('language_code'=> 'hi', 'country_code' => 'IN', 'name' => 'Hindi'),
		array('language_code'=> 'de', 'country_code' => 'DE', 'name' => 'German'),
		array('language_code'=> 'es', 'country_code' => 'ES', 'name' => 'Spainish'),
		array('language_code'=> 'fr', 'country_code' => 'FR', 'name' => 'French'),
		array('language_code'=> 'id', 'country_code' => 'ID', 'name' => 'Indonesian'),
		array('language_code'=> 'it', 'country_code' => 'IT', 'name' => 'Italian'),
		array('language_code'=> 'ja', 'country_code' => 'JP', 'name' => 'Japanese'),
		array('language_code'=> 'ko', 'country_code' => 'KR', 'name' => 'Korean'),
		array('language_code'=> 'ms', 'country_code' => 'MY', 'name' => 'Malay'),
		array('language_code'=> 'pt', 'country_code' => 'PT', 'name' => 'Portuguese'),
		array('language_code'=> 'ru', 'country_code' => 'RU', 'name' => 'Russian'),
		array('language_code'=> 'th', 'country_code' => 'TH', 'name' => 'Thai'),
		array('language_code'=> 'tr', 'country_code' => 'TR', 'name' => 'Turkish'),
		array('language_code'=> 'zh', 'country_code' => 'CN', 'name' => 'Chinese'),
	);

	function __construct()
	{

		parent::__construct(MODULE_CONTROL, 'FRONTEND_CONFIGS');

		$conds_mod['module_name'] = $this->router->fetch_class();
		$module_id = $this->Module->get_one_by($conds_mod)->module_id;

		$logged_in_user = $this->ps_auth->get_user_info();

		$user_id = $logged_in_user->user_id;
		if (empty($this->User->has_permission($module_id, $user_id)) && $logged_in_user->user_is_sys_admin != 1) {
			return redirect(site_url('/admin'));
		}
		///end check
	}

	/**
	 * Load About Entry Form
	 */

	function index($id = "fe1")
	{

		if ($this->is_POST()) {
			// if the method is post

			// server side validation
			if ($this->is_valid_input()) {

				// save user info
				$this->save($id);
			}
		}

		//Get About Object
		$this->data['app'] = $this->Frontend_config->get_one($id);
		$this->data['languages'] = $this->languages;
		$this->load_form($this->data);
	}

	/**
	 * Update the existing one
	 */
	function edit($id = "fe1")
	{


		// load user
		$this->data['app'] = $this->Frontend_config->get_one($id);

		// call the parent edit logic
		parent::edit($id);
	}

	/**
	 * Saving Logic
	 * 1) save about data
	 * 2) check transaction status
	 *
	 * @param      boolean  $id  The about identifier
	 */
	function save($id = false)
	{

		// start the transaction
		$this->db->trans_start();

		// prepare data for save
		$data = array();

		// map_key
		if ($this->has_data('map_key')) {
			$data['map_key'] = $this->get_data('map_key');
		}

		// price_format
		if ($this->has_data('price_format')) {
			$data['price_format'] = $this->get_data('price_format');
		}

		// fcm_server_key
		if ($this->has_data('fcm_server_key')) {
			$data['fcm_server_key'] = $this->get_data('fcm_server_key');
		}

		// firebase_web_push_key_pair
		if ($this->has_data('firebase_web_push_key_pair')) {
			$data['firebase_web_push_key_pair'] = $this->get_data('firebase_web_push_key_pair');
		}

		// ad_client
		if ($this->has_data('ad_client')) {
			$data['ad_client'] = $this->get_data('ad_client');
		}

		// ad_slot
		if ($this->has_data('ad_slot')) {
			$data['ad_slot'] = $this->get_data('ad_slot');
		}

		// copy_right
		if ($this->has_data('copy_right')) {
			$data['copy_right'] = $this->get_data('copy_right');
		}

		// google_play_url
		if ($this->has_data('google_play_url')) {
			$data['google_play_url'] = $this->get_data('google_play_url');
		}

		// app_store_url
		if ($this->has_data('app_store_url')) {
			$data['app_store_url'] = $this->get_data('app_store_url');
		}

		// banner_src
		if ($this->has_data('banner_src')) {
			$data['banner_src'] = $this->get_data('banner_src');
		}
		
		// mile
		if ($this->has_data('mile')) {
			$data['mile'] = $this->get_data('mile');
		}

		// default_language
		if ( $this->has_data( 'default_language' )) {
			$data['default_language'] = $this->get_data( 'default_language' );
		}

		// exclude language
		$exclude_language = "";
		foreach($this->languages as $language){
			if ( $this->has_data( $language['language_code'] )) {
				continue;
			}elseif($this->get_data( 'default_language' ) == $language['language_code']){
				continue;
			}else{
				$exclude_language .= $language['language_code'] . ',';
			}
		}
		$data['exclude_language'] = substr($exclude_language, 0, -1);

		// promote_first_choice_day
		if ( $this->has_data( 'promote_first_choice_day' )) {
			$data['promote_first_choice_day'] = $this->get_data( 'promote_first_choice_day' );
		}

		// promote_second_choice_day
		if ( $this->has_data( 'promote_second_choice_day' )) {
			$data['promote_second_choice_day'] = $this->get_data( 'promote_second_choice_day' );
		}

		// promote_third_choice_day
		if ( $this->has_data( 'promote_third_choice_day' )) {
			$data['promote_third_choice_day'] = $this->get_data( 'promote_third_choice_day' );
		}

		// promote_fourth_choice_day
		if ( $this->has_data( 'promote_fourth_choice_day' )) {
			$data['promote_fourth_choice_day'] = $this->get_data( 'promote_fourth_choice_day' );
		}
		
		// if is_enable_video_setting is checked
		if ($this->has_data('is_enable_video_setting')) {
			$data['is_enable_video_setting'] = 1;
		} else {
			$data['is_enable_video_setting'] = 0;
		}

		// if show_user_profile is checked
		if ($this->has_data('show_user_profile')) {
			$data['show_user_profile'] = 1;
		} else {
			$data['show_user_profile'] = 0;
		}

		// if no_filter_with_location_on_map is checked
		if ($this->has_data('no_filter_with_location_on_map')) {
			$data['no_filter_with_location_on_map'] = 1;
		} else {
			$data['no_filter_with_location_on_map'] = 0;
		}

		// if enable_notification is checked
		if ($this->has_data('enable_notification')) {
			$data['enable_notification'] = 1;
		} else {
			$data['enable_notification'] = 0;
		}

		// if google_setting is checked
		if ($this->has_data('google_setting')) {
			$data['google_setting'] = 1;
		} else {
			$data['google_setting'] = 0;
		}

		// if app_store_setting is checked
		if ($this->has_data('app_store_setting')) {
			$data['app_store_setting'] = 1;
		} else {
			$data['app_store_setting'] = 0;
		}

		// if google_map or open_street_map is checked
		if ($this->has_data('default_map')) {
			if($this->get_data( 'default_map' ) == 'google_map'){
				$data['open_street_map'] = 0;
				$data['google_map'] = 1;
			}else{
				$data['open_street_map'] = 1;
				$data['google_map'] = 0;
			}
		} else {
			$data['open_street_map'] = 0;
			$data['google_map'] = 1;
		}

		// if item_upload_ui1 or item_upload_ui2 is checked
		if ($this->has_data('item_upload_ui')) {
			if($this->get_data( 'item_upload_ui' ) == 'item_upload_ui1'){
				$data['item_upload_ui2'] = 0;
				$data['item_upload_ui1'] = 1;
			}else{
				$data['item_upload_ui2'] = 1;
				$data['item_upload_ui1'] = 0;
			}
		} else {
			$data['item_upload_ui2'] = 0;
			$data['item_upload_ui1'] = 1;
		}

		// save mobile config
		if (!$this->Frontend_config->save($data, $id)) {
			// if there is an error in inserting user data,	

			// rollback the transaction
			$this->db->trans_rollback();

			// set error message
			$this->data['error'] = get_msg('err_model');

			return;
		}

		// commit the transaction
		if (!$this->check_trans()) {

			// set flash error message
			$this->set_flash_msg('error', get_msg('err_model'));
		} else {

			if ($id) {
				// if user id is not false, show success_add message

				$this->set_flash_msg('success', get_msg('success_frontend_edit'));
			} else {
				// if user id is false, show success_edit message

				$this->set_flash_msg('success', get_msg('success_frontend_add'));
			}
		}

		redirect(site_url('/admin/Frontend_configs'));
	}

	/**
	 * Determines if valid input.
	 *
	 * @return     boolean  True if valid input, False otherwise.
	 */
	function is_valid_input($id = 0)
	{
		return true;
	}
}
