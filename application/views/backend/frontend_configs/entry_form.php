<?php
$attributes = array('id' => 'frontend_config_form', 'enctype' => 'multipart/form-data');
echo form_open('', $attributes);
?>

<div class="content animated fadeInRight">
	<div class="">
		<div class="card card-info">
			<div class="card-header">
				<h3 class="card-title"><?php echo get_msg('frontend_config_label') ?></h3>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<div class="row">

					<div class="col-md-6">
						<div class="form-group">
							<label><?php echo get_msg('google_play_url') ?>
								<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('google_play_url') ?>">
									<span class='glyphicon glyphicon-info-sign menu-icon'>
								</a>
							</label><br>
							<?php
							echo form_input(array(
								'type' => 'text',
								'name' => 'google_play_url',
								'id' => 'google_play_url',
								'class' => 'form-control',
								'placeholder' => get_msg('google_play_url'),
								'value' =>  set_value('google_play_url', show_data(@$app->google_play_url), false),
							));
							?>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label><?php echo get_msg('app_store_url') ?>
								<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('app_store_url') ?>">
									<span class='glyphicon glyphicon-info-sign menu-icon'>
								</a>
							</label><br>
							<?php
							echo form_input(array(
								'type' => 'text',
								'name' => 'app_store_url',
								'id' => 'app_store_url',
								'class' => 'form-control',
								'placeholder' => get_msg('app_store_url'),
								'value' =>  set_value('app_store_url', show_data(@$app->app_store_url), false),
							));
							?>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label><?php echo get_msg('map_key') ?>
								<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('map_key') ?>">
									<span class='glyphicon glyphicon-info-sign menu-icon'>
								</a>
							</label><br>
							<?php
							echo form_input(array(
								'type' => 'text',
								'name' => 'map_key',
								'id' => 'map_key',
								'class' => 'form-control',
								'placeholder' => get_msg('map_key'),
								'value' =>  set_value('map_key', show_data(@$app->map_key), false),
							));
							?>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label><?php echo get_msg('price_format') ?>
								<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('price_format') ?>">
									<span class='glyphicon glyphicon-info-sign menu-icon'>
								</a>
							</label><br>
							<?php
							echo form_input(array(
								'type' => 'text',
								'name' => 'price_format',
								'id' => 'price_format',
								'class' => 'form-control',
								'placeholder' => get_msg('price_format'),
								'value' =>  set_value('price_format', show_data(@$app->price_format), false),
							));
							?>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label><?php echo get_msg('fcm_server_key') ?>
								<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('fcm_server_key') ?>">
									<span class='glyphicon glyphicon-info-sign menu-icon'>
								</a>
							</label><br>
							<?php
							echo form_input(array(
								'type' => 'text',
								'name' => 'fcm_server_key',
								'id' => 'fcm_server_key',
								'class' => 'form-control',
								'placeholder' => get_msg('fcm_server_key'),
								'value' =>  set_value('fcm_server_key', show_data(@$app->fcm_server_key), false),
							));
							?>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label><?php echo get_msg('firebase_web_push_key_pair') ?>
								<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('firebase_web_push_key_pair') ?>">
									<span class='glyphicon glyphicon-info-sign menu-icon'>
								</a>
							</label><br>
							<?php
							echo form_input(array(
								'type' => 'text',
								'name' => 'firebase_web_push_key_pair',
								'id' => 'firebase_web_push_key_pair',
								'class' => 'form-control',
								'placeholder' => get_msg('firebase_web_push_key_pair'),
								'value' =>  set_value('firebase_web_push_key_pair', show_data(@$app->firebase_web_push_key_pair), false),
							));
							?>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label><?php echo get_msg('ad_client') ?>
								<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('ad_client') ?>">
									<span class='glyphicon glyphicon-info-sign menu-icon'>
								</a>
							</label><br>
							<?php
							echo form_input(array(
								'type' => 'text',
								'name' => 'ad_client',
								'id' => 'ad_client',
								'class' => 'form-control',
								'placeholder' => get_msg('ad_client'),
								'value' =>  set_value('ad_client', show_data(@$app->ad_client), false),
							));
							?>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label><?php echo get_msg('ad_slot') ?>
								<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('ad_slot') ?>">
									<span class='glyphicon glyphicon-info-sign menu-icon'>
								</a>
							</label><br>
							<?php
							echo form_input(array(
								'type' => 'text',
								'name' => 'ad_slot',
								'id' => 'ad_slot',
								'class' => 'form-control',
								'placeholder' => get_msg('ad_slot'),
								'value' =>  set_value('ad_slot', show_data(@$app->ad_slot), false),
							));
							?>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label><?php echo get_msg('banner_src') ?>
								<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('banner_src') ?>">
									<span class='glyphicon glyphicon-info-sign menu-icon'>
								</a>
							</label><br>
							<?php
							echo form_input(array(
								'type' => 'text',
								'name' => 'banner_src',
								'id' => 'banner_src',
								'class' => 'form-control',
								'placeholder' => get_msg('banner_src'),
								'value' =>  set_value('banner_src', show_data(@$app->banner_src), false),
							));
							?>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label><?php echo get_msg('mile') ?>
								<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('mile') ?>">
									<span class='glyphicon glyphicon-info-sign menu-icon'>
								</a>
							</label><br>
							<?php
							echo form_input(array(
								'type' => 'text',
								'name' => 'mile',
								'id' => 'mile',
								'class' => 'form-control',
								'placeholder' => get_msg('mile'),
								'value' =>  set_value('mile', show_data(@$app->mile), false),
							));
							?>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label><?php echo get_msg('copy_right') ?>
								<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('copy_right') ?>">
									<span class='glyphicon glyphicon-info-sign menu-icon'>
								</a>
							</label><br>
							<?php
							echo form_input(array(
								'type' => 'text',
								'name' => 'copy_right',
								'id' => 'copy_right',
								'class' => 'form-control',
								'placeholder' => get_msg('copy_right'),
								'value' =>  set_value('copy_right', show_data(@$app->copy_right), false),
							));
							?>
						</div>
					</div>

					<div class="col-12">
						<div class="row">

							<div class="col-md-6">
								<div class="form-group">
									<div class="form-check">
										<label class="form-check-label">
											<?php echo form_checkbox(array(
												'name' => 'is_enable_video_setting',
												'id' => 'is_enable_video_setting',
												'value' => 'accept',
												'checked' => set_checkbox('is_enable_video_setting', 1, (@$app->is_enable_video_setting == 1) ? true : false),
												'class' => 'form-check-input'
											));	?>
											<?php echo get_msg('is_enable_video_setting'); ?>
										</label>
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<div class="form-check">
										<label class="form-check-label">
											<?php echo form_checkbox(array(
												'name' => 'show_user_profile',
												'id' => 'show_user_profile',
												'value' => 'accept',
												'checked' => set_checkbox('show_user_profile', 1, (@$app->show_user_profile == 1) ? true : false),
												'class' => 'form-check-input'
											));	?>
											<?php echo get_msg('show_user_profile'); ?>
										</label>
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<div class="form-check">
										<label class="form-check-label">
											<?php echo form_checkbox(array(
												'name' => 'no_filter_with_location_on_map',
												'id' => 'no_filter_with_location_on_map',
												'value' => 'accept',
												'checked' => set_checkbox('no_filter_with_location_on_map', 1, (@$app->no_filter_with_location_on_map == 1) ? true : false),
												'class' => 'form-check-input'
											));	?>
											<?php echo get_msg('no_filter_with_location_on_map'); ?>
										</label>
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<div class="form-check">
										<label class="form-check-label">
											<?php echo form_checkbox(array(
												'name' => 'enable_notification',
												'id' => 'enable_notification',
												'value' => 'accept',
												'checked' => set_checkbox('enable_notification', 1, (@$app->enable_notification == 1) ? true : false),
												'class' => 'form-check-input'
											));	?>
											<?php echo get_msg('enable_notification'); ?>
										</label>
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<div class="form-check">
										<label class="form-check-label">
											<?php echo form_checkbox(array(
												'name' => 'google_setting',
												'id' => 'google_setting',
												'value' => 'accept',
												'checked' => set_checkbox('google_setting', 1, (@$app->google_setting == 1) ? true : false),
												'class' => 'form-check-input'
											));	?>
											<?php echo get_msg('google_setting'); ?>
										</label>
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<div class="form-check">
										<label class="form-check-label">
											<?php echo form_checkbox(array(
												'name' => 'app_store_setting',
												'id' => 'app_store_setting',
												'value' => 'accept',
												'checked' => set_checkbox('app_store_setting', 1, (@$app->app_store_setting == 1) ? true : false),
												'class' => 'form-check-input'
											));	?>
											<?php echo get_msg('app_store_setting'); ?>
										</label>
									</div>
								</div>
							</div>

						</div>
					</div>
					
					<hr width="100%" class="my-5">
					<legend class="mx-3 mb-4 font-weight-bold"><?php echo get_msg('default_map_section') ?></legend>
					<div class="col-md-6">
						<div class="form-group">
							<div class="form-check">
								<input type="radio" name="default_map" value="google_map" 
									id="default_map" 
									<?php $google_map = $app->google_map; 
										if ($google_map == 1) echo "checked"; ?>
								>
								<?php echo get_msg('google_map'); ?>
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<div class="form-check">
								<input type="radio" name="default_map" value="open_street_map" 
									id="default_map" 
									<?php $open_street_map = $app->open_street_map; 
										if ($open_street_map == 1) echo "checked"; ?>
								>
								<?php echo get_msg('open_street_map'); ?>
							</div>
						</div>
					</div>
					
					<hr width="100%" class="my-5">
					<legend class="mx-3 mb-4 font-weight-bold"><?php echo get_msg('item_upload_ui_section') ?></legend>
					<div class="col-md-6">
						<div class="form-group">
							<div class="form-check">
								<input type="radio" name="item_upload_ui" value="item_upload_ui1" 
									id="item_upload_ui" 
									<?php $item_upload_ui1 = $app->item_upload_ui1; 
										if ($item_upload_ui1 == 1) echo "checked"; ?>
								>
								<?php echo get_msg('item_upload_ui1'); ?>
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<div class="form-check">
								<input type="radio" name="item_upload_ui" value="item_upload_ui2" 
									id="item_upload_ui" 
									<?php $item_upload_ui2 = $app->item_upload_ui2; 
										if ($item_upload_ui2 == 1) echo "checked"; ?>
								>
								<?php echo get_msg('item_upload_ui2'); ?>
							</div>
						</div>
					</div>
					
					<hr width="100%" class="my-5">
					<legend class="mx-3 mb-4 font-weight-bold"><?php echo get_msg('lang_section') ?></legend>
					<div class="col-md-6">
						<div class="form-group">
							<label><?php echo get_msg('default_language') ?>
								<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('default_language') ?>">
									<span class='glyphicon glyphicon-info-sign menu-icon'>
								</a>
							</label><br>

							<?php
							$options[0] = get_msg('default_lang_select');
							foreach ($languages as $language) {
								$options[$language['language_code']] = $language['name'];
							}
							echo form_dropdown(
								'default_language',
								$options,
								set_value('default_language', show_data(@$app->default_language), false),
								'class="form-control form-control-sm mr-3" id="default_language"'
							);
							?>
						</div>
					</div>
					<div class="col-12 mt-3">
						<div class="form-group">
							<label><?php echo get_msg('exclude_language') ?>
								<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('exclude_language') ?>">
									<span class='glyphicon glyphicon-info-sign menu-icon'>
								</a>
							</label><br><?php echo get_msg('exclude_lang_desc') ?>
						</div>

						<div class="row">
							<?php
							$exclude_language = explode(',', trim($app->exclude_language));
							foreach ($languages as $language) : ?>
								<div class="col-6">
									<div class="form-group">
										<div class="form-check">
											<label class="form-check-label">
												<?php echo form_checkbox(array(
													'name' => $language['language_code'],
													'id' => $language['language_code'],
													'value' => 'accept',
													'checked' => set_checkbox($language['language_code'], 1, (in_array($language['language_code'], $exclude_language)) ? false : true),
													'class' => 'form-check-input'
												));	?>
												<?php echo $language['name'] . "( " . $language['language_code'] . '_' . $language['country_code'] . " )"; ?>
											</label>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>

					<hr width="100%" class="my-5">

					<legend class="mx-3 mb-4 font-weight-bold"><?php echo get_msg('promote_section') ?></legend>

					<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label><?php echo get_msg('promote_first_choice_day') ?>
								<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('promote_first_choice_day') ?>">
									<span class='glyphicon glyphicon-info-sign menu-icon'>
								</a>
							</label><br>
							<?php
							echo form_input(array(
								'type' => 'text',
								'name' => 'promote_first_choice_day',
								'id' => 'promote_first_choice_day',
								'class' => 'form-control',
								'placeholder' => get_msg('promote_first_choice_day'),
								'value' =>  set_value('promote_first_choice_day', show_data(@$app->promote_first_choice_day), false),
							));
							?>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label><?php echo get_msg('promote_second_choice_day') ?>
								<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('promote_second_choice_day') ?>">
									<span class='glyphicon glyphicon-info-sign menu-icon'>
								</a>
							</label><br>
							<?php
							echo form_input(array(
								'type' => 'text',
								'name' => 'promote_second_choice_day',
								'id' => 'promote_second_choice_day',
								'class' => 'form-control',
								'placeholder' => get_msg('promote_second_choice_day'),
								'value' =>  set_value('promote_second_choice_day', show_data(@$app->promote_second_choice_day), false),
							));
							?>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label><?php echo get_msg('promote_third_choice_day') ?>
								<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('promote_third_choice_day') ?>">
									<span class='glyphicon glyphicon-info-sign menu-icon'>
								</a>
							</label><br>
							<?php
							echo form_input(array(
								'type' => 'text',
								'name' => 'promote_third_choice_day',
								'id' => 'promote_third_choice_day',
								'class' => 'form-control',
								'placeholder' => get_msg('promote_third_choice_day'),
								'value' =>  set_value('promote_third_choice_day', show_data(@$app->promote_third_choice_day), false),
							));
							?>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label><?php echo get_msg('promote_fourth_choice_day') ?>
								<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('promote_fourth_choice_day') ?>">
									<span class='glyphicon glyphicon-info-sign menu-icon'>
								</a>
							</label><br>
							<?php
							echo form_input(array(
								'type' => 'text',
								'name' => 'promote_fourth_choice_day',
								'id' => 'promote_fourth_choice_day',
								'class' => 'form-control',
								'placeholder' => get_msg('promote_fourth_choice_day'),
								'value' =>  set_value('promote_fourth_choice_day', show_data(@$app->promote_fourth_choice_day), false),
							));
							?>
						</div>
					</div>
					</div>

				</div></div>
				<!-- /.card-body -->
				<div class="card-footer">
					<button type="submit" name="save" class="btn btn-sm btn-primary">
						<?php echo get_msg('btn_save') ?>
					</button>

					<a href="<?php echo $module_site_url; ?>" class="btn btn-sm btn-primary">
						<?php echo get_msg('btn_cancel') ?>
					</a>
				</div>
				<!-- /.card footer-->

			</div>
		</div>
	</div>

	<?php echo form_close(); ?>