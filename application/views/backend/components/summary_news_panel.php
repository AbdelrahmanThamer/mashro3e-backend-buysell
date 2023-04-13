<div class="ibox float-e-margins">

    <div class="ibox-title">
        <h5><?php echo $panel_title; ?></h5>

        <div class="ibox-tools">
            <span class="badge label-warning-light">
            <?php echo get_msg('total_label') ?> : <?php echo $total_count; ?>
           	</span>

        </div>
    </div>
			    
    
    <div class="ibox-content">
		
        <div class="row">
            <div class="col-lg-11">
                <table class="table table-hover margin bottom">
                    <thead>
                    <tr>
                        <th><?php echo get_msg('title') ?></th>
                        <th><?php echo get_msg('item_desc') ?></th>
                        <th class="text-center"><?php echo get_msg('category') ?></th>
                        <th class="text-center"><?php echo get_msg('added') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                    	if ( ! empty( $data )):
	                    	foreach($data as $new)
	                    		echo '<tr>'.
	                        			 
	                        			 '<td>'. read_more($new->news_title, 100) .'</td>'.
	                        			 '<td><span class="label label-primary">'. read_more($new->news_desc, 150). '</span></td>'.
	                        			 '<td class="text-center">'. $this->Category->get_one( $new->cat_id )->cat_name .'</td>'.
	                        			 '<td class="text-center small"><span class="label label-primary">'.ago($new->added_date).'</span></td>'.
	                    		     '</tr>';
                    	endif;
                    ?>
                   
                    </tbody>
                </table>
            </div>
            
    	</div>
	</div>

</div>


