<?php
require_once( APPPATH .'libraries/REST_Controller.php' );

/**
 * REST API for Favourites
 */
class Subcat_subscribes extends API_Controller
{

	/**
	 * Constructs Parent Constructor
	 */
	function __construct()
	{
		// call the parent
		parent::__construct( 'Subcat_subscribe' );
	}

    /**
     * Subcategory subscribe
     */
    function subcategory_subscribe_post(){
        
        // validation rules for chat history
		$rules = array(
			array(
	        	'field' => 'user_id',
	        	'rules' => 'required'
            ),
            array(
	        	'field' => 'cat_id',
	        	'rules' => 'required'
	        )
        );

        
        $sub_cat_ids = $this->post('sub_cat_ids');

        // exit if there is an error in validation,
        if ( !$this->is_valid( $rules )) exit;

        

        foreach($sub_cat_ids as $subcat_id){
            $data = array(
                'user_id' => $this->post('user_id'),
                'cat_id' => $this->post('cat_id'),
                'subcat_id' => $subcat_id
            );
            
            if(!$this->Subcat_subscribe->exists($data)){
                // sub category subscribe
                if(!$this->Subcat_subscribe->save($data)){
                    $this->error_response( get_msg( 'err_subcat_subscribe_save' ), 500);
                }
            }else{
                // sub category unsubscribe
                if(!$this->Subcat_subscribe->delete_by($data)){
                    $this->error_response( get_msg( 'err_subcat_subscribe_delete' ), 500);
                }
            }            
            
        }
        $this->success_response( get_msg( 'success_subcat_subscribe' ), 201);
    }

}