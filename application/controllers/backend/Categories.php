<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Categories Controller
 */
class Categories extends BE_Controller {

	/**
	 * Construt required variables
	 */
	function __construct() {
		
		
		parent::__construct( MODULE_CONTROL, 'CATEGORIES' );
		$this->load->library('uploader');
		$this->load->library('csvimport');
		$this->load->library('image_lib');
		$this->load->library( 'PS_Image' );

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
	 * List down the registered users
	 */
	function index() {
		
		// no publish filter
		$conds['no_publish_filter'] = 1;
		$conds['order_by'] = 1;
		$conds['order_by_field'] = "added_date";
		$conds['order_by_type'] = "desc";
		// get rows count
		$this->data['rows_count'] = $this->Category->count_all_by( $conds );
		
		// get categories
		$this->data['categories'] = $this->Category->get_all_by( $conds , $this->pag['per_page'], $this->uri->segment( 4 ) );
		// load index logic
		parent::index();
	}

	/**
	 * Searches for the first match.
	 */
	function search() {
		

		// breadcrumb urls
		$this->data['action_title'] = get_msg( 'cat_search' );
		
		// condition with search term
		if($this->input->post('submit') != NULL ){
			
			if($this->input->post('searchterm') != "") {
				$conds['searchterm'] = $this->input->post('searchterm');
				$this->data['searchterm'] = $this->input->post('searchterm');
				$this->session->set_userdata(array("searchterm" => $this->input->post('searchterm')));
			} else {
				
				$this->session->set_userdata(array("searchterm" => NULL));
			}

			if($this->input->post('order_by') == "name_asc") {
					
				$conds['order_by_field'] = "cat_name";
				$conds['order_by_type'] = "asc";

				$this->data['order_by'] = $this->input->post('order_by');
				$this->session->set_userdata(array("order_by" => $this->input->post('order_by')));
			
			}  

			if($this->input->post('order_by') == "name_desc") {
				
				$conds['order_by_field'] = "cat_name";
				$conds['order_by_type'] = "desc";

				$this->data['order_by'] = $this->input->post('order_by');
				$this->session->set_userdata(array("order_by" => $this->input->post('order_by')));
			}	
			
		} else {
			//read from session value
			if($this->session->userdata('searchterm') != NULL){
				$conds['searchterm'] = $this->session->userdata('searchterm');
				$this->data['searchterm'] = $this->session->userdata('searchterm');
			}

			if($this->session->userdata('order_by') != NULL){
				$conds['order_by_field'] = "cat_name";
				if($this->session->userdata('order_by') == "name_asc"){
					$conds['order_by_type'] = "asc";
				}else{
					$conds['order_by_type'] = "desc";
				}
				
				$this->data['order_by'] = $this->session->userdata('order_by');
			} 

			
		}


		// no publish filter
		$conds['no_publish_filter'] = 1;

		if ($conds['order_by_field'] == "" ){
			$conds['order_by_field'] = "added_date";
			$conds['order_by_type'] = "desc";
		}

		// pagination
		$this->data['rows_count'] = $this->Category->count_all_by( $conds );

		// search data
		$this->data['categories'] = $this->Category->get_all_by( $conds, $this->pag['per_page'], $this->uri->segment( 4 ) );
		
		// load add list
		parent::search();
	}

	/**
	 * Create new one
	 */
	function add() {

		// breadcrumb urls
		$this->data['action_title'] = get_msg( 'cat_add' );

		// call the core add logic
		parent::add();
	}

	/**
	 * Update the existing one
	 */
	function edit( $id ) {

		// breadcrumb urls
		$this->data['action_title'] = get_msg( 'cat_edit' );

		// load user
		$this->data['category'] = $this->Category->get_one( $id );

		// call the parent edit logic
		parent::edit( $id );
	}

	/**
	 * Saving Logic
	 * 1) upload image
	 * 2) save category
	 * 3) save image
	 * 4) check transaction status
	 *
	 * @param      boolean  $id  The user identifier
	 */
	function save( $id = false ) {
		// start the transaction
		$this->db->trans_start();
		
		/** 
		 * Insert Category Records 
		 */
		$data = array();

		// prepare cat name
		if ( $this->has_data( 'cat_name' )) {
			$data['cat_name'] = $this->get_data( 'cat_name' );
		}


		// save category
		if ( ! $this->Category->save( $data, $id )) {
		// if there is an error in inserting user data,	

			// rollback the transaction
			$this->db->trans_rollback();

			// set error message
			$this->data['error'] = get_msg( 'err_model' );
			
			return;
		}

		/** 
		 * Upload Image Records 
		 */
		if ( !$id ) {
			if ( ! $this->insert_icon_images( $_FILES, 'category', $data['cat_id'], "cover" )) {
				// if error in saving image

					// commit the transaction
					$this->db->trans_rollback();
					
					return;
				}
			if ( ! $this->insert_icon_images( $_FILES, 'category-icon', $data['cat_id'], "icon" )) {
				// if error in saving image

					// commit the transaction
					$this->db->trans_rollback();
					
					return;
				}	
		}

		/** 
		 * Check Transactions 
		 */

		// commit the transaction
		if ( ! $this->check_trans()) {
        	
			// set flash error message
			$this->set_flash_msg( 'error', get_msg( 'err_model' ));
		} else {

			if ( $id ) {
			// if user id is not false, show success_add message
				
				$this->set_flash_msg( 'success', get_msg( 'success_cat_edit' ));
			} else {
			// if user id is false, show success_edit message

				$this->set_flash_msg( 'success', get_msg( 'success_cat_add' ));
			}
		}

		redirect( $this->module_site_url());
	}


	

	/**
	 * Delete the record
	 * 1) delete category
	 * 2) delete image from folder and table
	 * 3) check transactions
	 */
	function delete( $category_id ) {

		// start the transaction
		$this->db->trans_start();

		// check access
		$this->check_access( DEL );
		
		// delete categories and images
		if ( !$this->ps_delete->delete_category( $category_id )) {

			// set error message
			$this->set_flash_msg( 'error', get_msg( 'err_model' ));

			// rollback
			$this->trans_rollback();

			// redirect to list view
			redirect( $this->module_site_url());
		}
			
		/**
		 * Check Transcation Status
		 */
		if ( !$this->check_trans()) {

			$this->set_flash_msg( 'error', get_msg( 'err_model' ));	
		} else {
        	
			$this->set_flash_msg( 'success', get_msg( 'success_cat_delete' ));
		}
		
		redirect( $this->module_site_url());
	}


	/**
	 * Delete all the news under category
	 *
	 * @param      integer  $category_id  The category identifier
	 */
	function delete_all( $category_id = 0 )
	{
		// start the transaction
		$this->db->trans_start();

		// check access
		$this->check_access( DEL );
		
		// delete categories and images
		$enable_trigger = true; 
		
		$type = "category";

		/** Note: enable trigger will delete news under category and all news related data */
		if ( !$this->ps_delete->delete_history( $category_id, $type, $enable_trigger )) {
		// if error in deleting category,

			// set error message
			$this->set_flash_msg( 'error', get_msg( 'err_model' ));

			// rollback
			$this->trans_rollback();

			// redirect to list view
			redirect( $this->module_site_url());
		}
			
		/**
		 * Check Transcation Status
		 */
		if ( !$this->check_trans()) {

			$this->set_flash_msg( 'error', get_msg( 'err_model' ));	
		} else {
        	
			$this->set_flash_msg( 'success', get_msg( 'success_cat_delete' ));
		}
		
		redirect( $this->module_site_url());
	}

	
	/**
	 * Determines if valid input.
	 *
	 * @return     boolean  True if valid input, False otherwise.
	 */
	function is_valid_input( $id = 0 ) {
		
		$rule = 'required|callback_is_valid_name['. $id  .']';

		$this->form_validation->set_rules( 'cat_name', get_msg( 'cat_name' ), $rule);

		if ( $this->form_validation->run() == FALSE ) {
		// if there is an error in validating,

			return false;
		}

		return true;
	}

	/**
	 * Determines if valid name.
	 *
	 * @param      <type>   $name  The  name
	 * @param      integer  $id     The  identifier
	 *
	 * @return     boolean  True if valid name, False otherwise.
	 */
	function is_valid_name( $name, $cat_id = 0 )
	{		

		 $conds['cat_name'] = $name;

			
		 	if( $cat_id != "") {
		 		// echo "bbbb";die;
				if ( strtolower( $this->Category->get_one( $id )->cat_name ) == strtolower( $name )) {
				// if the name is existing name for that user id,
					return true;
				} 
			} else {
				// echo "aaaa";die;
				if ( $this->Category->exists( ($conds ))) {
				// if the name is existed in the system,
					$this->form_validation->set_message('is_valid_name', get_msg( 'err_dup_name' ));
					return false;
				}
			}
			return true;
	}

	/**
	 * Check category name via ajax
	 *
	 * @param      boolean  $cat_id  The cat identifier
	 */
	function ajx_exists( $cat_id = false )
	{
		// get category name

		$name = $_REQUEST['cat_name'];

		if ( $this->is_valid_name( $name, $cat_id )) {

		// if the category name is valid,
			
			echo "true";
		} else {
		// if invalid category name,
			
			echo "false";
		}
	}

	/**
	 * Publish the record
	 *
	 * @param      integer  $category_id  The category identifier
	 */
	function ajx_publish( $category_id = 0 )
	{
		// check access
		$this->check_access( PUBLISH );
		
		// prepare data
		$category_data = array( 'status'=> 1 );
			
		// save data
		if ( $this->Category->save( $category_data, $category_id )) {
			echo 'true';
		} else {
			echo 'false';
		}
	}
	
	/**
	 * Unpublish the records
	 *
	 * @param      integer  $category_id  The category identifier
	 */
	function ajx_unpublish( $category_id = 0 )
	{
		// check access
		$this->check_access( PUBLISH );
		
		// prepare data
		$category_data = array( 'status'=> 0 );
			
		// save data
		if ( $this->Category->save( $category_data, $category_id )) {
			echo 'true';
		} else {
			echo 'false';
		}
	}

	/**
	 * CSV file upload with image
	 */
	function upload() {
		
		if ( $this->is_POST()) {

			$file = $_FILES['file']['name'];
			$ext = substr(strrchr($file, '.'), 1);
			
			if(strtolower($ext) == "csv") {

        	 	$upload_data = $this->uploader->upload($_FILES);
				
				if (!isset($upload_data['error'])) {
					foreach ($upload_data as $upload) {
						
						$file_data = $this->upload->data();
		            	$file_path =  './uploads/'.$file_data['file_name'];

		            	if ($this->csvimport->get_array($file_path)) {

							//get data from imported csv file
			                $csv_array = $this->csvimport->get_array($file_path);
			                $i = 0; $s = 0; $f=0;
			                $fail_records = "";

			                foreach ($csv_array as $row) {
			                    
								// Get category data
								$cat_name = trim($row['cat_name']);
								$status = $row['status'];
								$photo_name = $row['photo_name'];
								$icon_name = $row['icon_name'];
								
			                    if($cat_name != '') {
									
									//Get Image Info 
									$data_img = getimagesize(base_url() . "uploads/" . $photo_name);
									$data_icon = getimagesize(base_url() . "uploads/" . $icon_name);
									
									if( count($data_img) != 1 ) {
										
										if( count($data_icon) != 1 ) {

											$data = array(
												'cat_name' => $cat_name,
												'status' => $status,
											);

											// check cat is already existed or not
											$conds['cat_name'] = $cat_name;
											$conds['no_publish_filter'] = 1;

											if($this->Category->count_all_by($conds) > 0){
												$f++; $i++;
												$fail_records .= " - " . $cat_name . " " .get_msg( 'already_existed' ) . "<br>";
												continue;
											}

											$id = false;
											
											if($this->Category->save($data, $id)) {
												
												$id = ( !$id )? $data['cat_id']: $id ;
												
												$image = array(
													'img_parent_id' => $id,
													'img_type' 		=> "category",
													'img_desc' 		=> "",
													'img_path' 		=> $photo_name,
													'img_width'     => $data_img[0],
													'img_height'    => $data_img[1]
												);
												
												//cover photo path
												$path = "uploads/" . $photo_name;
												$this->ps_image->create_thumbnail($path);

												$image_icon = array(
													'img_parent_id' => $id,
													'img_type' 		=> "category-icon",
													'img_desc' 		=> "",
													'img_path' 		=> $icon_name,
													'img_width'     => $data_icon[0],
													'img_height'    => $data_icon[1]
												);

												//icon photo path
												$path_icon = "uploads/" . $icon_name;
												$this->ps_image->create_thumbnail($path_icon);
												$this->Image->save($image_icon);
												
												if($this->Image->save($image)) {
													//both success
													$s++;
												}

											} else {
												$f++;
												$fail_records .= " - " . $cat_name . " " .get_msg( 'db_err' ) . "<br>";
											}	

										} else {
											//icon at uploads missing 
											$f++;
				                			$fail_records .= " - " . $cat_name . " " . get_msg( 'miss_cat_icon' ) . "<br>";
										}

									} else {
										//image at uploads missing 
										$f++;
				                		$fail_records .= " - " . $cat_name . " " . get_msg( 'miss_cat_img' ) . "<br>";
									}
									
			                	} else {
									// category name missing
			                		$f++;
			                		$fail_records .= " - " . get_msg( 'miss_cat' ) . ".<br>";
			                	}

			                	$i++;

			                }

			                $result_str = get_msg( 'total_cat' ) .' ' . $i . "<br>";
			                $result_str .= get_msg( 'success_cat' ) . ' ' . $s . "<br>";
			                $result_str .= get_msg( 'fail_cat' ) . ' ' . $f .  "<br>" . $fail_records;

			                $this->data['message'] = $result_str;
			                $this->set_flash_msg( 'success', $result_str);

			            	redirect( $this->module_site_url());
							
			            } else {

			            	$this->set_flash_msg( 'error', get_msg( 'something_wrong_upload' ));
			            	redirect( $this->module_site_url());

			            }
					}
				} else {

					$this->set_flash_msg( 'error', $upload_data['error']);
					redirect( $this->module_site_url());
				}

			} else {

				$this->set_flash_msg( 'error',  get_msg( 'pls_upload_csv' ));
				redirect( $this->module_site_url());
			}

		} else {
			redirect( $this->module_site_url());
		}
	}
}