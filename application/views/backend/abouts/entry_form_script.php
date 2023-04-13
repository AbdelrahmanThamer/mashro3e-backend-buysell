<script>
	function jqvalidate() {

		$(document).ready(function(){
			$('#about-form').validate({
				rules:{
					title:{
						required: true,
						minlength: 4
					}
				},
				messages:{
					title:{
						required: "<?php echo get_msg( 'err_title' ) ;?>",
						minlength: "<?php echo get_msg( 'err_title_len' ) ;?>"
					}
				}
			});
		});
	}

	function runAfterJQ()
	{
		CKEDITOR.editorConfig = function( config ) {
			config.toolbarGroups = [
				{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
				{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
				{ name: 'links', groups: [ 'links' ] },
				{ name: 'insert', groups: [ 'insert' ] },
				{ name: 'forms', groups: [ 'forms' ] },
				{ name: 'tools', groups: [ 'tools' ] },
				{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
				{ name: 'others', groups: [ 'others' ] },
				'/',
				{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
				{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
				{ name: 'styles', groups: [ 'styles' ] },
				{ name: 'colors', groups: [ 'colors' ] },
				{ name: 'about', groups: [ 'about' ] }
			];

			config.removeButtons = 'BGColor,Styles,Format,Anchor,Image,Table,HorizontalRule,SpecialChar,Source,NumberedList,BulletedList,Indent,Outdent';
		};
		CKEDITOR.replaceAll( 'ckeditor' );
	}

	// function runAfterJQ()
	// {
	// 	CKEDITOR.editorConfig = function( config ) {
	// 		config.toolbarGroups = [
	// 			{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
	// 			{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
	// 			{ name: 'links', groups: [ 'links' ] },
	// 			{ name: 'insert', groups: [ 'insert' ] },
	// 			{ name: 'forms', groups: [ 'forms' ] },
	// 			{ name: 'tools', groups: [ 'tools' ] },
	// 			{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
	// 			{ name: 'others', groups: [ 'others' ] },
	// 			'/',
	// 			{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
	// 			{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
	// 			{ name: 'styles', groups: [ 'styles' ] },
	// 			{ name: 'colors', groups: [ 'colors' ] },
	// 			{ name: 'about', groups: [ 'about' ] }
	// 		];

	// 		config.removeButtons = 'BGColor,Styles,Format,Anchor,Image,Table,HorizontalRule,SpecialChar,Source,NumberedList,BulletedList,Indent,Outdent';
	// 	};
	// 	CKEDITOR.replace( 'faq_pages' );
	// }


</script>
<?php
// replace cover photo modal
	$data = array(
		'title' => get_msg('upload_photo'),
		'img_type' => 'about',
		'img_parent_id' => @$about->about_id
	);

	$this->load->view( $template_path .'/components/photo_upload_modal', $data );

	// delete cover photo modal
	$this->load->view( $template_path .'/components/delete_cover_photo_modal' ); 
?>