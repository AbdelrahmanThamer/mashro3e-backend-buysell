<?php
$attributes = array('id' => 'thumbnail-form','enctype' => 'multipart/form-data');
echo form_open( '', $attributes);
?>
<section class="content animated fadeInRight">
	<div class="col-md-6">
		<div class="card card-info">
			<div class="card-header">
		        <h3 class="card-title"><?php echo get_msg('thumbnail_generators_lng')?></h3>
		    </div>

			<div class="card-body">
		        <div class="row">
		        	<label class="mt-2"><i><?php echo get_msg('generate_thumbnail_label'); ?></i></label>
		        	<button type="submit" name="save" class="btn btn-sm btn-primary mt-2">
						<?php echo get_msg('btn_create_thumbnail')?>
					</button>
		        </div>
		    </div>
		</div>
	</div>
</section>


<?php echo form_close(); ?>