<?php
$attributes = array('id' => 'sitemap-form','enctype' => 'multipart/form-data');
echo form_open( '', $attributes);
?>

<section class="content animated fadeInRight">
	<div class="col-md-6">
		<div class="card card-info">
			<div class="card-header">
		        <h3 class="card-title"><?php echo get_msg('sitemap_generator_label')?></h3>
		    </div>

			<div class="card-body">
		        <div class="row">
					<div class="font-weight-bold mb-3"><?php echo get_msg('sitemap_generate_desc')?><br></div>
		        	<button type="submit" name="save" class="btn btn-primary mt-2">
						<?php echo get_msg('btn_create_sitemap')?>
					</button>
					<?php if(isset($sitemap)) : ?>
						<?php if(file_exists($sitemap->sitemap_path)): ?>
							<div class="col-12 my-3">
								<div class="row my-2"><?php echo get_msg('sitemap_info') . '&nbsp; <b>' . $sitemap->added_date . '</b>';?></div>
								<b><?php
									echo get_msg('sitemap_url_here') . '<br>';
									echo $sitemap->sitemap_path . '<br>';
								?>
								</b>
								<div class="font-weight-bold mt-3"><a href="<?php echo $domain_name . 'getsitemap.php?filename=' . str_replace('\\', '/', $sitemap->sitemap_path); ?>" target="_blank"><?php echo get_msg('copy_sitemap_to_fe')?></a></div>
							</div>
						<?php endif; ?>
					<?php endif; ?>
		        </div>
		    </div>
		</div>
	</div>
</section>

<?php echo form_close(); ?>