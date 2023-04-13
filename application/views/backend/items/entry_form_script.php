<script>
	$(document).ready(function(){
		<?php 
			$on = 1; $off = 1;
			$data = $this->Item_upload_config->get_one('1');
		?>
				
		<?php		
			if($data->condition_of_item_id == '1'){
				if($on %2 != 0){ ?> $("#condition_of_item_id").prependTo($("#left")); <?php }else{ ?> $("#condition_of_item_id").prependTo($("#right")); <?php } $on += 1;
			}else{
				if($off %2 != 0){ ?> $("#condition_of_item_id").appendTo($("#left")); <?php }else{ ?> $("#condition_of_item_id").appendTo($("#right")); <?php } $off += 1;
			}

			if($data->discount_rate_by_percentage == '1'){
				if($on %2 != 0){ ?> $("#discount_rate_by_percentage").prependTo($("#left")); <?php }else{ ?> $("#discount_rate_by_percentage").prependTo($("#right")); <?php } $on += 1;
			}else{
				if($off %2 != 0){ ?> $("#discount_rate_by_percentage").appendTo($("#left")); <?php }else{ ?> $("#discount_rate_by_percentage").appendTo($("#right")); <?php } $off += 1;
			}

			if($data->deal_option_id == '1'){
				if($on %2 != 0){ ?> $("#deal_option_id").prependTo($("#left")); <?php }else{ ?> $("#deal_option_id").prependTo($("#right")); <?php } $on += 1;
			}else{
				if($off %2 != 0){ ?> $("#deal_option_id").appendTo($("#left")); <?php }else{ ?> $("#deal_option_id").appendTo($("#right")); <?php } $off += 1;
			}

			if($data->deal_option_remark == '1'){
				if($on %2 != 0){ ?> $("#deal_option_remark").prependTo($("#left")); <?php }else{ ?> $("#deal_option_remark").prependTo($("#right")); <?php } $on += 1;
			}else{
				if($off %2 != 0){ ?> $("#deal_option_remark").appendTo($("#left")); <?php }else{ ?> $("#deal_option_remark").appendTo($("#right")); <?php } $off += 1;
			}

			if($data->highlight_info == '1'){
				if($on %2 != 0){ ?> $("#highlight_info").prependTo($("#left")); <?php }else{ ?> $("#highlight_info").prependTo($("#right")); <?php } $on += 1;
			}else{
				if($off %2 != 0){ ?> $("#highlight_info").appendTo($("#left")); <?php }else{ ?> $("#highlight_info").appendTo($("#right")); <?php } $off += 1;
			}

			if($data->brand == '1'){
				if($on %2 != 0){ ?> $("#brand").prependTo($("#left")); <?php }else{ ?> $("#brand").prependTo($("#right")); <?php } $on += 1;
			}else{
				if($off %2 != 0){ ?> $("#brand").appendTo($("#left")); <?php }else{ ?> $("#brand").appendTo($("#right")); <?php } $off += 1;
			}			

			if($data->item_type_id == '1'){
				if($on %2 != 0){ ?> $("#item_type_id").prependTo($("#left")); <?php }else{ ?> $("#item_type_id").prependTo($("#right")); <?php } $on += 1;
			}else{
				if($off %2 != 0){ ?> $("#item_type_id").appendTo($("#left")); <?php }else{ ?> $("#item_type_id").appendTo($("#right")); <?php } $off += 1;
			}

			if($data->item_price_type_id == '1'){
				if($on %2 != 0){ ?> $("#item_price_type_id").prependTo($("#left")); <?php }else{ ?> $("#item_price_type_id").prependTo($("#right")); <?php } $on += 1;
			}else{
				if($off %2 != 0){ ?> $("#item_price_type_id").appendTo($("#left")); <?php }else{ ?> $("#item_price_type_id").appendTo($("#right")); <?php } $off += 1;
			}

			if($data->item_location_township_id == '1'){
				if($on %2 != 0){ ?> $("#item_location_township").prependTo($("#left")); <?php }else{ ?> $("#item_location_township").prependTo($("#right")); <?php } $on += 1;
			}else{
				if($off %2 != 0){ ?> $("#item_location_township").appendTo($("#left")); <?php }else{ ?> $("#item_location_township").appendTo($("#right")); <?php } $off += 1;
			}

			if($data->sub_cat_id == '1'){
				if($on %2 != 0){ ?> $("#sub_cat").prependTo($("#left")); <?php }else{ ?> $("#sub_cat").prependTo($("#right")); <?php } $on += 1;
			}else{
				if($off %2 != 0){ ?> $("#sub_cat").appendTo($("#left")); <?php }else{ ?> $("#sub_cat").appendTo($("#right")); <?php } $off += 1;
			}			
		?>
		
			$("#description").prependTo($("#right"));
			$("#item_currency_id").prependTo($("#left"));
			$("#item_location").prependTo($("#left"));
			$("#cat").prependTo($("#right"));
			$("#price").prependTo($("#right"));
			$("#title").prependTo($("#left"));

			$("#right").append($("#image"));
			$("#right").append($("#video"));
			$("#right").append($("#video_icon"));
			$("#left").append($("#business_mode"));
			$("#left").append($("#dynamic_link"));
			$("#left").append($("#owner_of_item"));
			$("#left").append($("#status"));
			$("#left").append($("#is_sold_out"));
	});
	<?php if ( $this->config->item( 'client_side_validation' ) == true ): ?>

	function jqvalidate() {

		$('#item-form').validate({
			rules:{
				title: {
					blankCheck : "",
					minlength: 3,
					remote: "<?php echo $module_site_url .'/ajx_exists/'.@$item->id; ?>"
				},
				cat_id: {
		       		indexCheck : ""
		      	},
				price: {
					blankCheck : "",
                    indexCheck : ""
		      	},
				description: {
		       		blankCheck : ""
		      	},
				item_currency_id: {
		       		indexCheck : ""
		      	},
				item_location_id: {
		       		indexCheck : ""
		      	},
				cover:{
					required: true
				},
				lat:{
					indexCheck : "",
			     	validChecklat : ""
				},
				lng:{
					indexCheck : "",
			     	validChecklng : ""
				}
			},
			messages:{
				title:{
					blankCheck : "<?php echo get_msg( 'err_item_name' ) ;?>",
					minlength: "<?php echo get_msg( 'err_item_len' ) ;?>",
					remote: "<?php echo get_msg( 'err_item_exist' ) ;?>."
				},
				cat_id:{
			       indexCheck: "<?php echo get_msg( 'err_cat_name' ) ;?>"
			    },
			    price:{
					blankCheck : "<?php echo get_msg( 'err_price' ) ;?>",
					indexCheck : "<?php echo get_msg( 'price_cannot_zero' ) ;?>"
			    },
				description:{
			       blankCheck: "<?php echo get_msg( 'err_desciption' ) ;?>"
			    },
				item_currency_id:{
			       indexCheck: "<?php echo get_msg( 'err_currency_name' ) ;?>"
			    },
				item_location_id:{
			       indexCheck: "<?php echo get_msg( 'err_location_name' ) ;?>"
			    },
				cover:{
			       required: "<?php echo get_msg( 'err_image' ) ;?>"
			    },
				lat:{
			     	indexCheck : "<?php echo get_msg( 'err_lat_lng' ) ;?>",
			     	validChecklat : "<?php echo get_msg( 'lat_invlaid' ) ;?>"
			    },
			    lng:{
			     	indexCheck : "<?php echo get_msg( 'err_lat_lng' ) ;?>",
			     	validChecklng : "<?php echo get_msg( 'lng_invlaid' ) ;?>"
			    }
			},

			submitHandler: function(form) {
		        if ($("#item-form").valid()) {
		            form.submit();
		        }
		    }

		});
		
		jQuery.validator.addMethod("indexCheck",function( value, element ) { 
			   if(value == 0 || value == '') {
			    	return false;
			   } else {
			    	return true;
			   };
			   
		});

		jQuery.validator.addMethod("blankCheck",function( value, element ) {
			
			   if(value == "") {
			    	return false;
			   } else {
			   	 	return true;
			   }
		});

		jQuery.validator.addMethod("validChecklat",function( value, element ) {
			    if (value < -90 || value > 90) {
			    	return false;
			    } else {
			   	 	return true;
			    }
		});

		jQuery.validator.addMethod("validChecklng",function( value, element ) {
			    if (value < -180 || value > 180) {
			    	return false;
			   } else {
			   	 	return true;
			   }
		});
			

	}

	<?php endif; ?>
	function runAfterJQ() {

		$('#cat_id').on('change', function() {

			var value = $('option:selected', this).text().replace(/Value\s/, '');

			var catId = $(this).val();

			$.ajax({
				url: '<?php echo $module_site_url . '/get_all_sub_categories/';?>' + catId,
				method: 'GET',
				dataType: 'JSON',
				success:function(data){
					$('#sub_cat_id').html("");
					$.each(data, function(i, obj){
					    $('#sub_cat_id').append('<option value="'+ obj.id +'">' + obj.name+ '</option>');
					});
					$('#name').val($('#name').val() + " ").blur();
					$('#sub_cat_id').trigger('change');
				}
			});
		});

		$('#item_location_id').on('change', function() {

			var value = $('option:selected', this).text().replace(/Value\s/, '');

			var city_id = $(this).val();

			$.ajax({
				url: '<?php echo $module_site_url . '/get_all_location_townships/';?>' + city_id,
				method: 'GET',
				dataType: 'JSON',
				success:function(data){
					$('#item_location_township_id').html("");
					$.each(data, function(i, obj){
					    $('#item_location_township_id').append('<option value="'+ obj.id +'">' + obj.township_name+ '</option>');
					});
					$('#township_name').val($('#township_name').val() + " ").blur();
					$('#item_location_township_id').trigger('change');
				}
			});
		});
        
		 $(function() {
			var selectedClass = "";
			$(".filter").click(function(){
			selectedClass = $(this).attr("data-rel");
			$("#gallery").fadeTo(100, 0.1);
			$("#gallery div").not("."+selectedClass).fadeOut().removeClass('animation');
			setTimeout(function() {
			$("."+selectedClass).fadeIn().addClass('animation');
			$("#gallery").fadeTo(300, 1);
			}, 300);
			});
		});

		$('.delete-img').click(function(e){
			e.preventDefault();

			// get id and image
			var id = $(this).attr('id');

			// do action
			var action = '<?php echo $module_site_url .'/delete_cover_photo/'; ?>' + id + '/<?php echo @$item->id; ?>';
			console.log( action );
			$('.btn-delete-image').attr('href', action);
		});


		$('.delete-video').click(function(e){
			e.preventDefault();

			// get id and image
			var id = $(this).attr('id');

			// do action
			var action = '<?php echo $module_site_url .'/delete_video/'; ?>' + id + '/<?php echo @$item->id; ?>';
			console.log( action );
			$('.btn-delete-video').attr('href', action);
		});

		// check price not to type chars and specail chars

		$('input[name="price"]').keyup(function(e)
										{
		  if (/[^\d.-]/g.test(this.value))
		  {
		    // Filter non-digits from input value.
		    this.value = this.value.replace(/[^\d.-]/g, '');
		  }
		});

		// check discount rate not to type chars and specail chars
		$('input[name="discount_rate_by_percentage"]').keyup(function(e)
                                {
		  if (/[^\d.-]/g.test(this.value))
		  {
		    // Filter non-digits from input value.
		    this.value = this.value.replace(/[^\d.-]/g, '');
		  }
		});
	}

</script>
<?php 
	// replace and delete item image
	$data = array(
		'title' => get_msg('upload_photo'),
		'img_type' => 'item',
		'img_parent_id' => @$item->id
	);

	$this->load->view( $template_path .'/components/photo_upload_modal', $data );

	$this->load->view( $template_path .'/components/delete_cover_photo_modal' ); 

	// replace and delete video icon

	$data = array(
		'title' => get_msg('upload_photo'),
		'img_type' => 'video-icon',
		'img_parent_id' => @$item->id
	);


	$this->load->view( $template_path .'/components/icon_upload_modal', $data );

	$this->load->view( $template_path .'/components/delete_cover_photo_modal' ); 

	// replace and delete video
	$data = array(
		'title' => get_msg('upload_video'),
		'img_type' => 'video',
		'img_parent_id' => @$item->id
	);

	$this->load->view( $template_path .'/components/video_upload_modal', $data );

	// delete cover photo modal
	$this->load->view( $template_path .'/components/delete_video_modal' );
?>