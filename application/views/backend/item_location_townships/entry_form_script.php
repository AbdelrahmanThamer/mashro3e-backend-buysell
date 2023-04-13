<script>

	<?php if ( $this->config->item( 'client_side_validation' ) == true ): ?>

	function jqvalidate() {

		$('#location-township-form').validate({
			rules:{
				township_name:{
					blankCheck : "",
					minlength: 3
					
				},
				lat:{
					blankCheck : "",
					validChecklat : "",
					indexCheck : ""
				},
				lng:{
					blankCheck : "",
					validChecklng : "",
					indexCheck : ""
				},
				city_id: {
		       		indexCheck : ""
		      	}

			},
			messages:{
				township_name:{
					blankCheck : "<?php echo get_msg( 'err_township_name' ) ;?>",
					minlength: "<?php echo get_msg( 'err_township_len' ) ;?>"
					
				},
				lat:{
					blankCheck : "<?php echo get_msg( 'err_lat' ) ;?>",
					validChecklat : "<?php echo get_msg( 'lat_invlaid' ) ;?>",
					indexCheck : "<?php echo get_msg( 'err_lat_lng' ) ;?>",
				},
				lng:{
					blankCheck : "<?php echo get_msg( 'err_lng' ) ;?>",
					validChecklng : "<?php echo get_msg( 'lng_invlaid' ) ;?>",
					indexCheck : "<?php echo get_msg( 'err_lat_lng' ) ;?>"
				},
				city_id:{
			       indexCheck: "<?php echo get_msg('city_id_required'); ?>"
			    }
			}
		});
		// custom validation
		jQuery.validator.addMethod("blankCheck",function( value, element ) {
			
			   if(value == "") {
			    	return false;
			   } else {
			    	return true;
			   }
		})

		//index check

		jQuery.validator.addMethod("indexCheck",function( value, element ) {
			   if(value == 0) {
			    	return false;
			   } else {
			    	return true;
			   };
			   
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

		  $('input[name="ordering"]').keyup(function(e)
                                {
		  if (/[^0-9\.]/g.test(this.value))
		  {
		    // Filter non-digits from input value.
		    //this.value = this.value.replace(/\D/g, '');
		    this.value = this.value.replace(/[^0-9\.]/g,'');
		  }
		});
	}	

</script>