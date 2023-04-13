<div class='row mt-3'>
	<div class='col-9'>
	<?php
		$attributes = array('class' => 'form-inline');
		echo form_open( $module_site_url .'/search', $attributes);
	?>
		
		<div class="form-group mr-3">

			<?php echo form_input(array(
				'name' => 'searchterm',
				'value' => set_value( 'searchterm', $searchterm ),
				'class' => 'form-control form-control-sm',
				'placeholder' => get_msg( 'btn_search' )
			)); ?>

	  	</div>

	  	<div class="form-group" style="padding-right: 3px;">

			<?php
				$options=array();
				$options[0]=get_msg('Prd_search_cat');
				$categories = $this->Category->get_all();
				foreach($categories->result() as $cat) {
					
						$options[$cat->cat_id]=$cat->cat_name;
				}

				echo form_dropdown(
					'cat_id',
					$options,
					set_value( 'cat_id', show_data( @$cat_id), false ),
					'class="form-control form-control-sm mr-3" id="cat_id"'
				);
			?>

	  	</div>

	  	<div class="form-group">
			&nbsp;
			<?php
				echo get_msg( 'order_by' );
				//echo $order_by . " #####";

				$options=array();
				$options[0]=get_msg('select_order');

				foreach ($this->Order->get_all()->result() as $ord) {

					$options[$ord->id]=$ord->name;
								
				}
				echo form_dropdown(
					'order_by',
					$options,
					set_value( 'order_by', show_data( $order_by), false ),
					'class="form-control form-control-sm mr-3 ml-3" id="order_by"'
				);
			?>

	  	</div>

	  	<div class="form-group" style="padding-right: 2px;">
		  	<button type="submit" name="submit" value="submit" class="btn btn-sm btn-primary">
		  		<?php echo get_msg( 'btn_search' )?>
		  	</button>
	  	</div>

	  	<div class="form-group">
		  	<a href='<?php echo $module_site_url; ?>' class='btn btn-sm btn-primary'>
				<?php echo get_msg( 'btn_reset' )?>
			</a>
	  	</div>

	<?php echo form_close(); ?>

	</div>	

	<div class='col-3'>
		<a href='<?php echo $module_site_url .'/add';?>' class='btn btn-sm btn-primary pull-right'>
			<span class='fa fa-plus'></span> 
			<?php echo get_msg( 'subcat_add' )?>
		</a>
	</div>


	<!-- category csv import start -->
	<div class="col-12">
		<hr>
		<div class="card card-info">
			<div class="card-body">

				<?php
				$attributes = array('enctype' => 'multipart/form-data');
				echo form_open( $module_site_url .'/upload', $attributes);
				?>

				<div class="row">

					<div class="col-md-6">
						<div class="form-group">
							<?php if( $message ) { echo "<br>" . $message . "<br>"; } ?>
							<span style="font-size: 17px; color: red;">*</span>
							<label><?php echo get_msg('select_csv_file');?></label><br/>
							<input class="btn btn-sm" type="file" name="file" id="file">
						</div>
					</div>
					<!-- col-md-6 -->

					<div class="col-md-6">
						<label>
							<?php echo get_msg('csv_upload_instruction_subcat');?>
						</label>
					</div>
					<!-- col-md-6 -->

				</div>
				<!-- /.row -->
			</div>
			<!-- /.card-body -->

			<div class="card-footer">
				<button type="submit" class="btn btn-sm btn-primary">
					<?php echo get_msg('btn_save')?>
				</button>

				<a href="<?php echo $module_site_url; ?>" class="btn btn-sm btn-primary">
					<?php echo get_msg('btn_cancel')?>
				</a>
			</div>
			<!-- /.card-footer -->
		</div>
		<!-- /.card -->
	</div>
	<!-- /.col-12 -->
	<!-- category csv import end -->
</div>