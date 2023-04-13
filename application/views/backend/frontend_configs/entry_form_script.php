<script>
	function jqvalidate() {

		$(document).ready(function(){
			$('#frontend_config_form').validate({
				rules:{
					default_language:{
						indexCheck : "",
					},
					map_key:{
						blankCheck : "",
					},
					price_format:{
						blankCheck : "",
					},
					fcm_server_key:{
						blankCheck : "",
					},
					firebase_web_push_key_pair:{
						blankCheck : "",
					},
					ad_client:{
						blankCheck : "",
					},
					ad_slot:{
						blankCheck : "",
					},
					copy_right:{
						blankCheck : "",
					},
					google_play_url:{
						blankCheck : "",
					},
					app_store_url:{
						blankCheck : "",
					},
					banner_src:{
						blankCheck : "",
					},
					app_store_url:{
						blankCheck : "",
					},
					mile:{
						blankCheck : "",
					},
					promote_first_choice_day:{
						blankCheck : "",
						indexCheck : ""
					},
					promote_second_choice_day:{
						blankCheck : "",
						indexCheck : ""
					},
					promote_third_choice_day:{
						blankCheck : "",
						indexCheck : ""
					},
					promote_fourth_choice_day:{
						blankCheck : "",
						indexCheck : ""
					},	
				},
				messages:{
					default_language:{
						indexCheck : "<?php echo get_msg( 'err_default_lang' ) ;?>",
					},
					map_key:{
						blankCheck : "<?php echo get_msg( 'err_map' ) ;?>",
					},
					price_format:{
						blankCheck : "<?php echo get_msg( 'err_price_format' ) ;?>",
					},
					fcm_server_key:{
						blankCheck : "<?php echo get_msg( 'err_fcm_server_key' ) ;?>",
					},
					firebase_web_push_key_pair:{
						blankCheck : "<?php echo get_msg( 'err_firebase_web_push_key_pair' ) ;?>",
					},
					ad_client:{
						blankCheck : "<?php echo get_msg( 'err_ad_client' ) ;?>",
					},
					ad_slot:{
						blankCheck : "<?php echo get_msg( 'err_ad_slot' ) ;?>",
					},
					copy_right:{
						blankCheck : "<?php echo get_msg( 'err_copy_right' ) ;?>",
					},
					google_play_url:{
						blankCheck : "<?php echo get_msg( 'err_google_play_url' ) ;?>",
					},
					app_store_url:{
						blankCheck : "<?php echo get_msg( 'err_app_store_url' ) ;?>",
					},
					banner_src:{
						blankCheck : "<?php echo get_msg( 'err_banner_src' ) ;?>",
					},
					mile:{
						blankCheck : "<?php echo get_msg( 'err_mile' ) ;?>",
					},
					promote_first_choice_day:{
						indexCheck : "<?php echo get_msg( 'err_promote_first_choice_day_zero' ) ;?>",
						blankCheck : "<?php echo get_msg( 'err_promote_first_choice_day' ) ;?>",
					},
					promote_second_choice_day:{
						indexCheck : "<?php echo get_msg( 'err_promote_second_choice_day_zero' ) ;?>",
						blankCheck : "<?php echo get_msg( 'err_promote_second_choice_day' ) ;?>",
					},
					promote_third_choice_day:{
						indexCheck : "<?php echo get_msg( 'err_promote_third_choice_day_zero' ) ;?>",
						blankCheck : "<?php echo get_msg( 'err_promote_third_choice_day' ) ;?>",
					},
					promote_fourth_choice_day:{
						indexCheck : "<?php echo get_msg( 'err_promote_fourth_choice_day_zero' ) ;?>",
						blankCheck : "<?php echo get_msg( 'err_promote_fourth_choice_day' ) ;?>",
					},					
				}
			});
			
			// default language is selected, available language is auto on
			var default_language = $('#default_language').val();
			const language_codes = ['en', 'ar', 'hi', 'de', 'es', 'fr', 'id', 'it', 'ja', 'ko', 'ms', 'pt', 'ru', 'th', 'tr', 'zh'];

			for(let x in language_codes){
				
				if(language_codes[x] == default_language){
					$('#'+default_language).attr('checked', true);
					$('#'+default_language).attr('disabled', true);
				}else{
					$('#'+language_codes[x]).attr('disabled', false);
				}
			}
			
		});

		jQuery.validator.addMethod("indexCheck",function( value, element ) {
			if(value == 0) {
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
		
	}

	function runAfterJQ() {

		$('#default_language').on('change', function() {

			var default_language = $(this).val();

			const language_codes = ['en', 'ar', 'hi', 'de', 'es', 'fr', 'id', 'it', 'ja', 'ko', 'ms', 'pt', 'ru', 'th', 'tr', 'zh'];

			for(let x in language_codes){
				
				if(language_codes[x] == default_language){
					$('#'+default_language).attr('checked', true);
					$('#'+default_language).attr('disabled', true);
				}else{
					$('#'+language_codes[x]).attr('disabled', false);
				}
			}
		});
	}
</script>