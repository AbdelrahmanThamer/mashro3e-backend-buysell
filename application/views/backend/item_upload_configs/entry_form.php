<?php
$attributes = array('id' => 'item-config-form','enctype' => 'multipart/form-data');
echo form_open( '', $attributes);
?>
<section class="content animated fadeInRight">
	<div class="card card-info">
		 <div class="card-header">
	        <h3 class="card-title"><?php echo get_msg('item_config_label')?></h3>
	    </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
							<?php echo form_checkbox( array(
								'name' => 'sub_cat_id',
								'id' => 'sub_cat_id',
								'value' => 'accept',
								'checked' => set_checkbox('sub_cat_id', 1, ( @$item_config->sub_cat_id == 1 )? true: false ),
								'class' => 'form-check-input',
							));	?>
							<?php echo get_msg( 'subcat_name' ); ?>
							</label>
						</div>
					</div>
					<div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
							<?php echo form_checkbox( array(
								'name' => 'item_price_type_id',
								'id' => 'item_price_type_id',
								'value' => 'accept',
								'checked' => set_checkbox('item_price_type_id', 1, ( @$item_config->item_price_type_id == 1 )? true: false ),
								'class' => 'form-check-input',
							));	?>
							<?php echo get_msg( 'price_type' ); ?>
							</label>
						</div>
					</div>
					<div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
							<?php echo form_checkbox( array(
								'name' => 'item_type_id',
								'id' => 'item_type_id',
								'value' => 'accept',
								'checked' => set_checkbox('item_type_id', 1, ( @$item_config->item_type_id == 1 )? true: false ),
								'class' => 'form-check-input',
							));	?>
							<?php echo get_msg( 'item_type' ); ?>
							</label>
						</div>
					</div>					
					<div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
							<?php echo form_checkbox( array(
								'name' => 'discount_rate_by_percentage',
								'id' => 'discount_rate_by_percentage',
								'value' => 'accept',
								'checked' => set_checkbox('discount_rate_by_percentage', 1, ( @$item_config->discount_rate_by_percentage == 1 )? true: false ),
								'class' => 'form-check-input',
							));	?>
							<?php echo get_msg( 'discount_rate_by_percentage' ); ?>
							</label>
						</div>
					</div>
					<div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
							<?php echo form_checkbox( array(
								'name' => 'deal_option_id',
								'id' => 'deal_option_id',
								'value' => 'accept',
								'checked' => set_checkbox('deal_option_id', 1, ( @$item_config->deal_option_id == 1 )? true: false ),
								'class' => 'form-check-input',
							));	?>
							<?php echo get_msg( 'deal_option_id_label' ); ?>
							</label>
						</div>
					</div>
					<div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
							<?php echo form_checkbox( array(
								'name' => 'deal_option_remark',
								'id' => 'deal_option_remark',
								'value' => 'accept',
								'checked' => set_checkbox('deal_option_remark', 1, ( @$item_config->deal_option_remark == 1 )? true: false ),
								'class' => 'form-check-input',
							));	?>
							<?php echo get_msg( 'deal_option_remark' ); ?>
							</label>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
							<?php echo form_checkbox( array(
								'name' => 'video',
								'id' => 'video',
								'value' => 'accept',
								'checked' => set_checkbox('video', 1, ( @$item_config->video == 1 )? true: false ),
								'class' => 'form-check-input',
							));	?>
							<?php echo get_msg( 'item_video' ); ?>
							</label>
						</div>
					</div>
					<div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
							<?php echo form_checkbox( array(
								'name' => 'video_icon',
								'id' => 'video_icon',
								'value' => 'accept',
								'checked' => set_checkbox('video_icon', 1, ( @$item_config->video_icon == 1 )? true: false ),
								'class' => 'form-check-input',
							));	?>
							<?php echo get_msg( 'item_video_icon' ); ?>
							</label>
						</div>
					</div>
					<div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
							<?php echo form_checkbox( array(
								'name' => 'brand',
								'id' => 'brand',
								'value' => 'accept',
								'checked' => set_checkbox('brand', 1, ( @$item_config->brand == 1 )? true: false ),
								'class' => 'form-check-input',
							));	?>
							<?php echo get_msg( 'brand_label' ); ?>
							</label>
						</div>
					</div>
					<div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
							<?php echo form_checkbox( array(
								'name' => 'business_mode',
								'id' => 'business_mode',
								'value' => 'accept',
								'checked' => set_checkbox('business_mode', 1, ( @$item_config->business_mode == 1 )? true: false ),
								'class' => 'form-check-input',
							));	?>
							<?php echo get_msg( 'itm_business_mode' ); ?> <?php echo get_msg( 'itm_show_shop' ) ?>
							</label>
						</div>
					</div>
					<div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
							<?php echo form_checkbox( array(
								'name' => 'condition_of_item_id',
								'id' => 'condition_of_item_id',
								'value' => 'accept',
								'checked' => set_checkbox('condition_of_item_id', 1, ( @$item_config->condition_of_item_id == 1 )? true: false ),
								'class' => 'form-check-input',
							));	?>
							<?php echo get_msg( 'condition_of_item' ); ?>
							</label>
						</div>
					</div>
					<div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
							<?php echo form_checkbox( array(
								'name' => 'highlight_info',
								'id' => 'highlight_info',
								'value' => 'accept',
								'checked' => set_checkbox('highlight_info', 1, ( @$item_config->highlight_info == 1 )? true: false ),
								'class' => 'form-check-input',
							));	?>
							<?php echo get_msg( 'prd_high_info' ); ?>
							</label>
						</div>
					</div>
				</div>
				<legend class="ml-3 mt-3"><?php echo get_msg('item_loc_config')?></legend>
				<div class="col-6">
					<div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
							<?php echo form_checkbox( array(
								'name' => 'address',
								'id' => 'address',
								'value' => 'accept',
								'checked' => set_checkbox('address', 1, ( @$item_config->address == 1 )? true: false ),
								'class' => 'form-check-input',
							));	?>
							<?php echo get_msg( 'item_address_label' ); ?>
							</label>
						</div>
					</div>
					<div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
							<?php echo form_checkbox( array(
								'name' => 'lat',
								'id' => 'lat',
								'value' => 'accept',
								'checked' => set_checkbox('lat', 1, ( @$item_config->lat == 1 )? true: false ),
								'class' => 'form-check-input',
							));	?>
							<?php echo get_msg( 'lat_label' ); ?>
							</label>
						</div>
					</div>
					<div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
							<?php echo form_checkbox( array(
								'name' => 'lng',
								'id' => 'lng',
								'value' => 'accept',
								'checked' => set_checkbox('lng', 1, ( @$item_config->lng == 1 )? true: false ),
								'class' => 'form-check-input',
							));	?>
							<?php echo get_msg( 'lng_label' ); ?>
							</label>
						</div>
					</div>
				</div>
				</div>
            </div>
            <div class="card-footer">
				<button type="submit" name="save" class="btn btn-sm btn-primary">
					<?php echo get_msg('btn_save')?>
				</button>
				<a href="<?php echo $module_site_url; ?>" class="btn btn-sm btn-primary">
					<?php echo get_msg('btn_cancel')?>
				</a>
			</div>
        </div>
    </div>
</section>
<?php echo form_close(); ?>