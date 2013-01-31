<?php


// Widget for search form //
class PET_Widget_Searchform extends WP_Widget {

	function PET_Widget_Searchform() {
		$widget_ops = array('classname' => 'PET_Widget_Searchform', 'description' => __( 'Let visitors search for pets in your site','wp_pet') );
		$this->WP_Widget('PET_Widget_Searchform', __('Pet Search','wp_pet'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		if ( !empty($instance['title']) ) {
			$title = $instance['title'];
		} else {
			if ( 'pet_search_widget') {
				$title = __('Pet Search','wp_pet');
			} else {

				$title = $tax->labels->name;
			}
		}
		$title = apply_filters('widget_title', $title, $instance, $this->id_base);

		echo $before_widget;
		if ( $title )
		echo $before_title . $title . $after_title;
    echo do_shortcode('[pet_search]');
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance['title'] = strip_tags(stripslashes($new_instance['title']));
		return $instance;
	}

	function form( $instance ) {
?>
	<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title') ?></label>
	<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php if (isset ( $instance['title'])) {echo esc_attr( $instance['title'] );} ?>" /></p>
	<?php
	}
}

/**
 * PET_Widget_Display Class
 */
class PET_Widget_Display extends WP_Widget {

    /** constructor */
    function PET_Widget_Display() {
        parent::WP_Widget(false, $name = 'AdaPet', $widget_options = array('name' => __('Pet Display', 'wp_pet'),'description' => _x('Display pets by category or status, recent pets, etc','widget pet','wp_pet')));;
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {
        extract( $args );
        $title = apply_filters('widget_title', empty($instance['title']) ? '&nbsp;' : $instance['title'], $instance, $this->id_base);
        $text = apply_filters( 'widget_text', $instance['text'], $instance );
        $sortby = empty( $instance['sortby'] ) ? 'comment_count' : $instance['sortby'];
        $r = $instance['rss'] ? '1' : '0';
        $status = isset($instance['pet-status']) ? $instance['pet-status'] : false;
        $number = isset($instance['number']) ? $instance['number'] : false;
        $category = isset($instance['pet-category']) ? $instance['pet-category'] : false;
        $q = new WP_Query(array('post_type'=>'pet', 'posts_per_page'=>$number, 'orderby'=>$sortby, 'pet-status' => $status,'pet-category' => $category));
        ?>

        <?php echo $before_widget; ?>
        <?php if ( $title ) echo $before_title . $title . $after_title; ?>


         <?php echo '<div>'.$instance['filter'].'</div>' ? wpautop($text) : $text; ?>

         <?php if ( $r ) {  ?>
		     <p><a href="<?php echo home_url(); ?>/?feed=rss2&amp;post_type=pet"><span class="pet_rss">RSS</span></a></p>
         <?php } ?>

     		  <?php  while ($q->have_posts()) : $q->the_post(); ?>

          <ul class="pet_info">
            <li><figure class="pet_image"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('pet_img'); ?></a></figure></li>
            <li class="pet_name"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
            <li><span><?php _e('In', 'wp_pet'); ?></span>: <?php echo get_the_term_list( get_the_ID(), 'pet-category' , " " ) ?></li>
            <li><span><?php _e('Gender', 'wp_pet'); ?></span>: <?php  $pd=get_the_ID(); $taxo = wp_get_object_terms($pd, 'pet-gender') ; echo $taxo[0]->name ; ?></li>
            <li class="pet_btn">
             <a href="<?php the_permalink() ?>" title="<?php _e('Read about', 'wp_pet'); ?> <?php the_title(); ?>">
             <span class="icon <?php  $pd=get_the_ID(); $taxo = wp_get_object_terms($pd, 'pet-status') ; echo $taxo[0]->slug ; ?>"></span><?php  $pd=get_the_ID(); $taxo = wp_get_object_terms($pd, 'pet-status') ; echo $taxo[0]->name ; ?>
             </a>
            </li>
          </ul>


            <div class="clear"></div>
     		  <?php endwhile; ?>



		<?php echo $after_widget; ?>

    <?php
   		// Reset the global $the_post as this query will have stomped on it
   		wp_reset_postdata();
   		$cache[$args['widget_id']] = ob_get_flush();
   		wp_cache_set('widget_recent_posts', $cache, 'widget');
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {
    	$instance = $old_instance;
      $instance['title'] = strip_tags($new_instance['title']);
      $instance['number'] = ($new_instance['number']);
      $instance['pet-status'] = ($new_instance['pet-status']);
      $instance['pet-category'] = ($new_instance['pet-category']);
      $instance['rss'] = !empty($new_instance['rss']) ? 1 : 0;

	 		if ( current_user_can('unfiltered_html') )
			  $instance['text'] =  $new_instance['text'];
		  else
			  $instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed
		    $instance['filter'] = isset($new_instance['filter']);
    	if ( in_array( $new_instance['sortby'], array( 'title', 'date', 'author', 'ID', 'rand', 'modified', 'comment_count' ) ) ) {
			  $instance['sortby'] = $new_instance['sortby']; }
      else {
			$instance['sortby'] = 'comment_count';
	    	}
     return $instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {
        $title = apply_filters('widget_title', empty($instance['title']) ? '&nbsp;' : $instance['title'], $instance, $this->id_base);
        $instance = wp_parse_args( (array) $instance, array(  'text' => '', 'sortby' => 'comment_count','pet-category' => false,'pet-status' => false, 'number'=> false ) );
        $text = esc_textarea($instance['text']);
        $rss = isset($instance['rss']) ? (bool) $instance['rss'] :false;
        $link_cats = get_terms('pet-category', array('hide_empty' => 1));
        $lost_sts = get_terms('pet-status', array('hide_empty' => 1));
        $items = array('1','2','3','4','5');
    ?>
        <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>

         <p>
          <label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Arbitrary text or HTML'); ?></label>
	      	<textarea class="widefat" rows="6" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>
         </p>

	      <p>
          <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('How many items would you like to display?'); ?></label>

          <select id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>">
        	<?php
          	foreach ( $items as $item ) {
        		echo '<option value="' . $item . '"'
        				 .( $item == $instance['number'] ? ' selected="selected"' : '' )
        			   . '>' . $item . "</option>\n"; } ?>
        	</select>
        </p>

    		<p>
    			<label for="<?php echo $this->get_field_id('sortby'); ?>"><?php _e( 'Sort by:' ); ?></label>
    			<select name="<?php echo $this->get_field_name('sortby'); ?>" id="<?php echo $this->get_field_id('sortby'); ?>" class="widefat">
    				<option value="title"<?php selected( $instance['sortby'], 'title' ); ?>><?php _e('Post title','wp_pet'); ?></option>
    				<option value="date"<?php selected( $instance['sortby'], 'date' ); ?>><?php _e('Post data','wp_pet'); ?></option>
    				<option value="author"<?php selected( $instance['sortby'], 'author' ); ?>><?php _e( 'Post author','wp_pet'); ?></option>
    				<option value="ID"<?php selected( $instance['sortby'], 'ID' ); ?>><?php _e( 'Post ID','wp_pet'); ?></option>
    				<option value="rand"<?php selected( $instance['sortby'], 'rand' ); ?>><?php _e( 'Random' ); ?></option>
    				<option value="modified"<?php selected( $instance['sortby'], 'modified' ); ?>><?php _e( 'Modified date','wp_pet'); ?></option>
    				<option value="comment_count"<?php selected( $instance['sortby'], 'comment_count' ); ?>><?php _e( 'Popularity','wp_pet'); ?></option>
    			</select>
    		</p>

      	<p>
          <label for="<?php echo $this->get_field_id('pet-category'); ?>"><?php _e('Category'); ?>:</label>
      		<select class="widefat" id="<?php echo $this->get_field_id('pet-category'); ?>" name="<?php echo $this->get_field_name('pet-category'); ?>">
          <option value=""><?php _e('All','wp_pet'); ?></option>
       		<?php
       		foreach ( $link_cats as $link_cat ) {
       			echo '<option value="' . ($link_cat->slug) . '"'
       				. ( $link_cat->slug == $instance['pet-category'] ? ' selected="selected"' : '' )
       				. '>' . $link_cat->name ." (". $link_cat->count .")"."</option>\n";  } ?>
      	 </select>
        </p>

      	<p>
          <label for="<?php echo $this->get_field_id('pet-status'); ?>"><?php _e('Pet Status','wp_pet'); ?>:</label>
      		<select class="widefat" id="<?php echo $this->get_field_id('pet-status'); ?>" name="<?php echo $this->get_field_name('pet-status'); ?>">
      		<option value=""><?php _e('All','wp_pet'); ?></option>
      	 	<?php
      		  foreach ( $lost_sts as $lost_st ) {
      			echo '<option value="' . ($lost_st->slug) . '"'
      				.( $lost_st->slug == $instance['pet-status'] ? ' selected="selected"' : '' )
      				.'>' . $lost_st->name ." (". $lost_st->count .")"."</option>\n";
      		}
      		?>
      		</select>
        </p>

    <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('rss'); ?>" name="<?php echo $this->get_field_name('rss'); ?>"<?php checked( $rss ); ?> />
		<label for="<?php echo $this->get_field_id('rss'); ?>"><?php _e( 'Show RSS link','wp_pet' ); ?></label><br />
        <?php
    }

} // class PET_Widget_Display




?>
