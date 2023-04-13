<?php
require_once( APPPATH .'libraries/REST_Controller.php' );

/**
 * REST API for News
 */
class Items extends API_Controller
{

	/**
	 * Constructs Parent Constructor
	 */
	function __construct()
	{
		parent::__construct( 'Item' );
		$this->load->library( 'PS_Image' );
	}

	/**
	 * Default Query for API
	 * @return [type] [description]
	 */
	function default_conds()
	{
		$conds = array();

		if ( $this->is_get ) {
		// if is get record using GET method

			// get default setting for GET_ALL_CATEGORIES
			//$setting = $this->Api->get_one_by( array( 'api_constant' => GET_ALL_CATEGORIES ));

			$conds['order_by'] = 1;
			$conds['order_by_field'] = $setting->order_by_field;
			$conds['order_by_type'] = $setting->order_by_type;
		}
		

		if ( $this->is_search ) {

			//$setting = $this->Api->get_one_by( array( 'api_constant' => SEARCH_WALLPAPERS ));

			if($this->post('searchterm') != "") {
				$conds['searchterm']   = $this->post('searchterm');
			}

			if($this->post('brand_id') != "") {
				$conds['brand_id']   = $this->post('brand_id');
			}

			if($this->post('cat_id') != "") {
				$conds['cat_id']   = $this->post('cat_id');
			}

			if($this->post('sub_cat_id') != "") {
				$conds['sub_cat_id']   = $this->post('sub_cat_id');
			}

			if($this->post('item_type_id') != "") {
				$conds['item_type_id']   = $this->post('item_type_id');
			}

			if($this->post('item_currency_id') != "") {
				$conds['item_currency_id']   = $this->post('item_currency_id');
			}

			if($this->post('item_price_type_id') != "") {
				$conds['item_price_type_id']   = $this->post('item_price_type_id');
			}
			
			if($this->post('lat') != "" && $this->post('lng') != "" && $this->post('miles') != "" && $this->post('item_location_id') != "") {
				$conds['item_location_id']   = $this->post('item_location_id');
			} if($this->post('lat') != "" && $this->post('lng') != "" && $this->post('miles') != "" && $this->post('item_location_id') == "") {
				$conds['item_location_id']   ="";
			} else {
				if($this->post('item_location_id') != "") {
					$conds['item_location_id']   = $this->post('item_location_id');
				}
			}

			if($this->post('lat') != "" && $this->post('lng') != "" && $this->post('miles') != "" && $this->post('item_location_township_id') != "") {
				$conds['item_location_township_id']   = $this->post('item_location_township_id');
			} if($this->post('lat') != "" && $this->post('lng') != "" && $this->post('miles') != "" && $this->post('item_location_township_id') == "") {
				$conds['item_location_township_id']   ="";
			} else {
				if($this->post('item_location_township_id') != "") {
					$conds['item_location_township_id']   = $this->post('item_location_township_id');
				}
			}

			if($this->post('deal_option_id') != "") {
				$conds['deal_option_id']   = $this->post('deal_option_id');
			}

			if($this->post('condition_of_item_id') != "") {
				$conds['condition_of_item_id']   = $this->post('condition_of_item_id');
			}

			if($this->post('min_price') != "") {
				$conds['min_price']   = $this->post('min_price');
			}

			if($this->post('max_price') != "") {
				$conds['max_price']   = $this->post('max_price');
			}

			if($this->post('brand') != "") {
				$conds['brand']   = $this->post('brand');
			}

			if($this->post('lat') != "") {
				$conds['lat']   = $this->post('lat');
			}

			if($this->post('lng') != "") {
				$conds['lng']   = $this->post('lng');
			}

			if($this->post('miles') != "") {
				$conds['miles']   = $this->post('miles');
			}

			if($this->post('added_user_id') != "") {
				$conds['added_user_id']   = $this->post('added_user_id');
			}

			if($this->post('ad_post_type') != "") {
				$conds['ad_post_type']   = $this->post('ad_post_type');
			}

			if($this->post('is_discount') != "") {
				$conds['is_discount']   = $this->post('is_discount');
			}

			if($this->post('status') != "") {
				$conds['status']   = $this->post('status');
			} else {
				$conds['status']   = 1;
			}

			if($this->post('is_sold_out') != "") {
				$conds['is_sold_out']   = $this->post('is_sold_out');
			}

			$conds['item_search'] = 1;
			$conds['order_by'] = 1;
			$conds['order_by_field']    = $this->post('order_by');
			$conds['order_by_type']     = $this->post('order_type');
				
		}

		return $conds;
	}

	function add_post() {
		$approval_enable = $this->App_setting->get_one('app1')->is_approval_enabled;
		$is_paid_app = $this->App_setting->get_one('app1')->is_paid_app;
		if ($approval_enable == 1) {
			$status = 0;
		} else {
			$status = 1;
		}

		// checking validation 
		$rules = array(
			array(
	        	'field' => 'title',
	        	'rules' => 'required'
	        ),
	        array(
	        	'field' => 'description',
	        	'rules' => 'required'
	        ),
	        array(
	        	'field' => 'cat_id',
	        	'rules' => 'required'
	        ),
	        array(
	        	'field' => 'price',
	        	'rules' => 'required'
	        ),
	        array(
	        	'field' => 'item_location_id',
	        	'rules' => 'required'
			),
			array(
	        	'field' => 'item_currency_id',
	        	'rules' => 'required'
	        )
        );
		
        $lat = $this->post('lat');
		$lng = $this->post('lng');
        // $location = location_check($lat,$lng);

        // exit if there is an error in validation,
        if ( !$this->is_valid( $rules )) exit;
        
	  	$item_data = array(

        	"cat_id" => $this->post('cat_id'), 
        	"sub_cat_id" => $this->post('sub_cat_id'),
        	"item_type_id" => $this->post('item_type_id'),
        	"item_price_type_id" => $this->post('item_price_type_id'),
        	"item_currency_id" => $this->post('item_currency_id'), 
        	"condition_of_item_id" => $this->post('condition_of_item_id'),
        	"item_location_id" => $this->post('item_location_id'),
        	"item_location_township_id" => $this->post('item_location_township_id'),
        	"deal_option_remark" => $this->post('deal_option_remark'),
        	"description" => $this->post('description'),
        	"highlight_info" => $this->post('highlight_info'),
        	"price" => $this->post('price'),
        	"deal_option_id" => $this->post('deal_option_id'),
        	"brand" => $this->post('brand'),
        	"business_mode" => $this->post('business_mode'),
        	"is_sold_out" => $this->post('is_sold_out'),
        	"title" => $this->post('title'),
        	"address" => $this->post('address'),
        	"lat" => $this->post('lat'),
        	"lng" => $this->post('lng'),
        	"status" => $status,
        	"id" => $this->post('id'),
        	"added_user_id" => $this->post('added_user_id'),
        	"discount_rate_by_percentage" => $this->post('discount_rate_by_percentage'),
        	"added_date" =>  date("Y-m-d H:i:s")        	
        );

		$id = $item_data['id'];


		
		if($id != ""){

			$login_user_id = $this->get( 'login_user_id' );
			$owner_id = $this->Item->get_one($id)->added_user_id; 

			if($login_user_id == $owner_id) {

				//edit
				//$status = $this->Item->get_one($id)->status;
				$item_data['status'] = $status;
				$this->Item->save($item_data,$id);
				///start deep link update item tb by MN
				$description = $item_data['description'];
				$title = $item_data['title'];
				$conds_img = array( 'img_type' => 'item', 'img_parent_id' => $id );
				$images = $this->Image->get_all_by( $conds_img )->result();
				$img = $this->ps_image->upload_url . $images[0]->img_path;
				$deep_link = deep_linking_shorten_url($description,$title,$img,$id);
				$itm_data = array(
					'dynamic_link' => $deep_link
				);
				$this->Item->save($itm_data,$id);
				///End
			} else {
				$this->error_response(get_msg('unauthorize_item_edit'), 403);
			}

		} else{



			// limit ad checking start

			$user_data = $this->User->get_one($item_data['added_user_id']);
			if($is_paid_app == '1' && $user_data->role_id == '4'){
				
				$remaining_post = $user_data->remaining_post;
				if(!$remaining_post <= '0'){
					$usr_data = array(
						'remaining_post' => $remaining_post - 1,
					);
					$this->User->save($usr_data, $item_data['added_user_id']);
				}else{
					$this->error_response( get_msg("not_enought_post_count"), 400 );
				}
				
			}

			// limit ad checking end

		 	$this->Item->save($item_data);

		 	$id = $item_data['id'];
		 	///start deep link update item tb by MN
			$description = $item_data['description'];
			$title = $item_data['title'];
			$conds_img = array( 'img_type' => 'item', 'img_parent_id' => $id );
	        $images = $this->Image->get_all_by( $conds_img )->result();
			$img = $this->ps_image->upload_url . $images[0]->img_path;
			$deep_link = deep_linking_shorten_url($description,$title,$img,$id);
			$itm_data = array(
				'dynamic_link' => $deep_link
			);
			$this->Item->save($itm_data,$id);
			///End

			//add

			// sending subscribe noti - noti will send add item with status 1 start

			if ($item_data['status'] == 1) {

				// update the updated_flag 1
				$itm_data = array(
					'updated_flag' => 1
				);
				$this->Item->save($itm_data,$id);

				$sub_cat_id =  $this->post('sub_cat_id');
				$name = $this->Subcategory->get_one($sub_cat_id)->name;
				$message = get_msg( 'new_item_upload_label' ) . ' ' . $name;

				$data['message'] = $message;
				$data['subscribe'] = 1;
				$data['push'] = 0;
				$data['sub_cat_id'] = $item_data['sub_cat_id'];
				$data['item_id'] = $id;

				// Push Notification for Mobile and FE

				$dyn_link_deep_url = $this->Backend_config->get_one('be1')->dyn_link_deep_url;

				$prj_url = explode('/', $dyn_link_deep_url);
				$i = count($prj_url)-3;
				$prj_name = $prj_url[$i];

				$status = send_android_fcm_topics_subscribe( $data );
				if ( !$status ) $error_msg .= get_msg('fail_push_devices') . " <br/>";

				$status_fe = send_android_fcm_topics_subscribe_fe( $data, $prj_name );
				if ( !$status_fe ) $error_msg .= get_msg('fail_push_websites') . " <br/>";

			}

			// subscribe noti end

		}
		 
		$obj = $this->Item->get_one( $id );
		
		$this->ps_adapter->convert_item( $obj );
		$this->custom_response( $obj );

	}


	/**
	* Trigger to delete item related data when item is deleted
	* delete item related data
	*/

	function item_delete_post( ) {

		// validation rules for item register
		$rules = array(
			array(
	        	'field' => 'item_id',
	        	'rules' => 'required'
	        )
	    );   
	    
	    // exit if there is an error in validation,
        if ( !$this->is_valid( $rules )) exit;

        $id = $this->post('item_id');

        $conds['id'] = $id;

        // check user id

        $item_data = $this->Item->get_one_by($conds);

        //print_r($item_data);die;


        if ( $item_data->id == "" || $item_data->status == "-1" ) {

        	$this->error_response( get_msg( 'invalid_item_id' ), 400);

        } else {

        	// delete Item -just updated status - modified by PP @18Dec2020
        	$itm_data['status'] = -1 ;
			if ( !$this->Item->save( $itm_data,$id )) {

				return false;
			}

        	// $conds_id['id'] = $id;
         	// $conds_item['item_id'] = $id;
        	// $conds_img['img_parent_id'] = $id;

			// // delete Item
			// if ( !$this->Item->delete_by( $conds_id )) {

			// 	return false;
			// }

			
			// // delete chat history
			// if ( !$this->Chat->delete_by( $conds_item )) {

			// 	return false;
			// }

			// // delete favourite
			// if ( !$this->Favourite->delete_by( $conds_item )) {

			// 	return false;
			// }

			// // delete item reports
			// if ( !$this->Itemreport->delete_by( $conds_item )) {

			// 	return false;
			// }

			// // delete touches
			// if ( !$this->Touch->delete_by( $conds_item )) {

			// 	return false;
			// }

			// // delete images
			// if ( !$this->Image->delete_by( $conds_img )) {

			// 	return false;
			// }

			// // delete paid item
			// if ( !$this->Paid_item->delete_by( $conds_item )) {

			// 	return false;
			// }
			
			$this->success_response( get_msg( 'success_delete' ));

        }


	}

	/**
	 * Update Price 
	 */
	function sold_out_from_itemdetails_post()
	{
		// validation rules for chat history
		$rules = array(
			array(
	        	'field' => 'item_id',
	        	'rules' => 'required'
	        )
        );


		// exit if there is an error in validation,
        if ( !$this->is_valid( $rules )) exit;
        $id = $this->post('item_id');
        $item_sold_out = array(

        	"is_sold_out" => 1, 

        );

        $this->Item->save($item_sold_out,$id);
        $conds['id'] = $id;
        
        $obj = $this->Item->get_one_by($conds);

        $this->ps_adapter->convert_item( $obj );
        $this->custom_response($obj);
    }


	/**
	 * Convert Object
	 */
	function convert_object( &$obj )
	{

		// call parent convert object
		parent::convert_object( $obj );

		// convert customize item object
		$this->ps_adapter->convert_item( $obj );
	}

}