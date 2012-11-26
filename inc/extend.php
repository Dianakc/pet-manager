<?php

function wph_right_now_content_table_pet() {
 $args = array(
  'public' => true ,
  '_builtin' => false
 );
 $output = 'object';
 $operator = 'and';
 $post_types = get_post_types( $args , $output , $operator );
 foreach( $post_types as $post_type ) {
  $num_posts = wp_count_posts( $post_type->name );
  $num = number_format_i18n( $num_posts->publish );
  $text = _n( $post_type->labels->singular_name, $post_type->labels->name , intval( $num_posts->publish ) );
  if ( current_user_can( 'edit_posts' ) ) {
   $num = "<a href='edit.php?post_type=$post_type->name'>$num</a>";
   $text = "<a href='edit.php?post_type=$post_type->name'>$text</a>";
  }
  echo '<tr><td class="first b b-' . $post_type->name . '">' . $num . '</td>';
  echo '<td class="t ' . $post_type->name . '">' . $text . '</td></tr>';
 }

}
add_action( 'right_now_content_table_end' , 'wph_right_now_content_table_pet' );




/* Add pet status column*/
    function add_columns_on_persons_transcult($defaults) {
        $defaults['pet_column'] = __('Pet Info','wp_pet');
        return $defaults;
    }

    function pet_column_trancult($column_name, $post_ID) {

          if ($column_name == 'pet_column') {
            $term_list = wp_get_post_terms($post_ID, 'pet-status');
            foreach ($term_list as $term)
            print '<p><strong>'.__('Status','wp_pet').':</strong> <a title="See all pets in '.$term->name.'" href="edit.php?occupation='.$term->slug.'&post_type=person" >'.$term->name.'</a></p>';
            }
    }
    add_filter('manage_pet_posts_columns', 'add_columns_on_persons_transcult', 10);
    add_action('manage_pet_posts_custom_column', 'pet_column_trancult', 10, 2);


/* Add pet category column*/
    function add_columns_category_for_pets($defaults) {
        $defaults['pet_column'] = __('Pet Info','wp_pet');
        return $defaults;
    }

    function pet_category_column($column_name, $post_ID) {

          if ($column_name == 'pet_column') {
            $term_list = wp_get_post_terms($post_ID, 'pet-category');

            foreach ($term_list as $term)
            print '<p><strong>'.__('Category','wp_pet').':</strong> <a title="'.__('See all pets in','wp_pet').' '.$term->name.'" href="edit.php?occupation='.$term->slug.'&post_type=person" >'.$term->name.'</a></p>';
            }
    }
    add_filter('manage_pet_posts_columns', 'add_columns_category_for_pets', 10);
    add_action('manage_pet_posts_custom_column', 'pet_category_column', 10, 2);


/* Display Pet picture*/
    function ST4_get_featured_image($post_ID) {
        $post_thumbnail_id = get_post_thumbnail_id($post_ID);
        if ($post_thumbnail_id) {
            $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'pet_mini');
            return $post_thumbnail_img[0];
        }
    }

    function pet_picture_columns($defaults) {
        $defaults['featured_image'] = __('Picture','wp_pet');
        return $defaults;
    }
    function pet_img_content_only($column_name, $post_ID) {
        if ($column_name == 'featured_image') {
                   if ($column_name == 'featured_image') {
                $post_featured_image = ST4_get_featured_image($post_ID);
                if ((!empty($post_featured_image))) {
                    echo '<div style="padding:3px;overflow:hidden;border:1px solid #ccc;width:40px;height:40px;display:block"><img style="width:100%;height:auto;" src="' . $post_featured_image . '" alt="" title="'.get_the_title().'" /></div>';
                } else { echo '<a class="thickbox" id="set-post-thumbnail" href="http://localhost/wp3/wp-admin/media-upload.php?post_id='.get_the_ID().'&type=image&TB_iframe=1">'.__('Set picture','wp_pet').'</a>';}
            }
        }
    }

add_filter('manage_pet_posts_columns', 'pet_picture_columns', 10);
add_action('manage_pet_posts_custom_column', 'pet_img_content_only', 10, 2);

/* Add pet control column*/
    function add_columns_control_for_pets($defaults) {
        $defaults['pet_column_control'] = __('Control #','wp_pet');
        return $defaults;
    }

    function pet_control_column($column_name, $post_ID) {

          if ($column_name == 'pet_column_control') {
            $control = get_post_meta( get_the_ID(), '_data_pet_control');

            if (!empty($control)) print '<p>'.$control[0].'</p>';
            }
    }
    add_filter('manage_pet_posts_columns', 'add_columns_control_for_pets', 10);
    add_action('manage_pet_posts_custom_column', 'pet_control_column', 10, 2);

//Functions for auto place content

//Check metadatas
function test_if_meta( $arr, $key, $before = '', $after = '' ) {
         if( $text = $arr[$key][0] )
             return $before . $text . $after;
    }

//Place content
add_filter( 'the_content', 'place_special_pet_content', 20 );
function place_special_pet_content( $content ) {
    global $posts, $wpbd, $post;

    $postid = get_the_ID();

    $status = wp_get_post_terms( $postid, 'pet-status',array("fields" => "all"));
    $category = wp_get_post_terms( $postid, 'pet-category',array("fields" => "all"));

    //all postmeta is here:
    $petinfo = get_post_custom(get_the_ID());
    //print_r($petinfo); //uncomment to see all post meta in everypost

    if ( 'pet' == get_post_type() && is_single()){


    $special .= '<div class="pet_info pet_'.get_the_id().'" >'.
                '<figure>'.get_the_post_thumbnail($postid,'pet_img').'<figcaption><span class="icon '.$status[0]->slug.'" ></span>'.$status[0]->name.'</figcaption></figure>'.
                '<ul>'.
                '<li><span>'.__('Gender','wp_pet').'</span> '.get_the_term_list( $post->ID, 'pet-gender', '', ', ', '' ).'</li>'.
                '<li><span>'.__('Size','wp_pet').'</span> '.get_the_term_list( $post->ID, 'pet-size', '', ', ', '' ).'</li>'.
                '<li><span>'.__('Age','wp_pet').'</span> '.get_the_term_list( $post->ID, 'pet-ages', '', ', ', '' ).'</li>'.
                '<li><span>'.__('Colors','wp_pet').'</span> '.get_the_term_list( $post->ID, 'pet-color', '', ', ', '' ).'</li>'.
                '<li><span>'.__('Breed','wp_pet').'</span> '.get_the_term_list( $post->ID, 'pet-breeds', '', ', ', '' ).'</li>'.
                '</ul>'.

                '<ul>'.
                test_if_meta( $petinfo, '_data_pet_vaccines', '<li><span>'.__('Vaccines','wp_pet').':</span> ', '</li>').
                '<li><span>'.__('Coat','wp_pet').'</span> '.get_the_term_list( $post->ID, 'pet-coat', '', ', ', '' ).'</li>'.
                '<li><span>'.__('Pattern','wp_pet').'</span> '.get_the_term_list( $post->ID, 'pet-pattern', '', ', ', '' ).'</li>'.
                test_if_meta( $petinfo, '_data_pet_fee', '<li><span>'.__('Fee','wp_pet').':</span> ', '</li>').
                '</ul>'.
                '</div>';


     $special .= '<div class="clear"></div><p><strong>'.__('Published','wp_pet').'</strong> '.get_the_date().' '.
                  '<strong>'.__('Modified','wp_pet').'</strong> '.get_the_modified_date(). '</p>';


     if(!empty($petinfo['_data_pet_address'][0])) {
     $extrapet .= '<h3>'.__('Address','wp_pet').'</h3><p>'.$petinfo['_data_pet_address'][0].'</p>';
     };

     if(!empty($petinfo['_data_pet_date'][0])) {
        $extrapet .= '<p>'.date_i18n( get_option('date_format'), $petinfo['_data_pet_date'][0]);

        if(!empty($petinfo['_data_pet_time'][0])) {
        $extrapet .= ' '.__('at','wp_pet').' '.date(get_option('time_format'), strtotime($petinfo['_data_pet_time'][0]));
        };

        $extrapet .= '</p>';
     };

     if(!empty($petinfo['_data_pet_geocode'][0])) {
     $extrapet .= '<div class="map_image"><img src="http://maps.google.com/maps/api/staticmap?size=600x300&zoom=16&markers=icon:http://chart.apis.google.com/chart?chst=d_map_pin_icon%26chld=glyphish_dogpaw%257CFF6357%7C'.$petinfo['_data_pet_geocode'][0].'&sensor=false" /></div>';
     };


     if($petinfo['_data_pet_email_option'][0]!='not_email') {
     if($petinfo['_data_pet_email_option'][0]=='a_email') {
           $extrapet .= '<h3>'.__('Contact us about ','wp_pet').get_the_title().'</h3>'.do_shortcode('[contact-form subject="'.test_if_meta( $petinfo, '_data_pet_control', '#', ' - ').get_the_title().'" to="'.get_option('admin_email').'"] [contact-field label="'.__('Name','wp_pet').'" type="name" required="true" /] [contact-field label="'.__('Email','wp_pet').'" type="email" required="true" /] [contact-field label="'.__('Phone','wp_pet').'" type="text" /] [contact-field label="'.__('Message','wp_pet').'" type="textarea" required="true" /] [/contact-form]');
     };

     if($petinfo['_data_pet_email_option'][0]=='t_email') {
           $extrapet .= '<h3>'.__('Contact about ','wp_pet').get_the_title().'</h3>'.do_shortcode('[contact-form subject="'.get_bloginfo('title').' - '.get_the_title().'" to="'.$petinfo['_data_pet_another_email'][0].'"] [contact-field label="'.__('Name','wp_pet').'" type="name" required="true" /] [contact-field label="'.__('Email','wp_pet').'" type="email" required="true" /] [contact-field label="'.__('Phone','wp_pet').'" type="text" /] [contact-field label="'.__('Message','wp_pet').'" type="textarea" required="true" /] [/contact-form]');
     };
     }


     $content = $special.$content.$extrapet;

   }

    if ( 'pet' == get_post_type() && is_archive()){ //the same thing above but it prints things instead
        print   '<div class="pet_info pet_'.$post->ID.'" ><figure>'.get_the_post_thumbnail($post->ID,'pet_img').'<figcaption><span class="icon '.$status[0]->slug.'" ></span>'.$status[0]->name.'</figcaption></figure>';
        print   '<ul>'.
                '<li><span>'.__('Gender','wp_pet').'</span> '.get_the_term_list( $post->ID, 'pet-gender', '', ', ', '' ).'</li>'.
                '<li><span>'.__('Size','wp_pet').'</span> '.get_the_term_list( $post->ID, 'pet-size', '', ', ', '' ).'</li>'.
                '<li><span>'.__('Age','wp_pet').'</span> '.get_the_term_list( $post->ID, 'pet-ages', '', ', ', '' ).'</li>'.
                '<li><span>'.__('Colors','wp_pet').'</span> '.get_the_term_list( $post->ID, 'pet-color', '', ', ', '' ).'</li>'.
                '<li><span>'.__('Breed','wp_pet').'</span> '.get_the_term_list( $post->ID, 'pet-breeds', '', ', ', '' ).'</li>'.
                '</ul>'.

                '<ul>'.
                test_if_meta( $petinfo, '_data_pet_vaccines', '<li><span>'.__('Vaccines','wp_pet').':</span> ', '</li>').
                '<li><span>'.__('Coat','wp_pet').'</span> '.get_the_term_list( $post->ID, 'pet-coat', '', ', ', '' ).'</li>'.
                '<li><span>'.__('Pattern','wp_pet').'</span> '.get_the_term_list( $post->ID, 'pet-pattern', '', ', ', '' ).'</li>'.
                test_if_meta( $petinfo, '_data_pet_fee', '<li><span>'.__('Fee','wp_pet').':</span> ', '</li>').
                '</ul>'.

                '</div>';
    }

    return $content;
}

//Special content for Pet Page
add_filter( 'the_content', 'place_special_pet_content_in_pets', 20 );

function place_special_pet_content_in_pets( $content ) {

    $page = __('pet-list','wp_pet');

    if( is_page($page) ) {

      $data .= '<h3>'.__('Browse Pets by Status','wp_pet').'</h3><ul>'.wp_list_categories('echo=0&show_count=1&taxonomy=pet-status&title_li=').'</ul>'.
               '<h3>'.__('Browse Pets by Category','wp_pet').'</h3><ul>'.wp_list_categories('echo=0&show_count=1&taxonomy=pet-category&title_li=').'</ul>'.

               '<h3>'.__('Search Pets','wp_pet').'</h3><form method="get" id="pet_search" action="'. home_url() . '/">'.
               '<input type="hidden" name="post_type" value="pet" />';

      $data.=  '<label>'.__('Status','wp_pet').'</label><select name="pet-status" id="drop-status">';
      $terms = get_terms('pet-status', array('hide_empty' => 1 ));

      $data .= '<option value=""></option>';
       foreach ($terms as $term) {
        $data .= "<option value='$term->slug'" . selected($term->slug, true, false) . ">$term->name</option>";
       }
      $data .= '</select>';


      $data.=  '<br /><label>'.__('Type','wp_pet').'</label><select name="pet-category" id="pet-category">';
      $terms = get_terms('pet-category', array('hide_empty' => 1 ));

      $data .= '<option value=""></option>';
        foreach ($terms as $term) {
          $data .= "<option value='$term->slug'" . selected($term->slug, true, false) . ">$term->name</option>";
        }
      $data .= '</select>';

//      $data.=  '<br /><label>'.__('Gender','wp_pet').'</label>';
      $terms = get_terms('pet-gender', array('hide_empty' => 1 ));

      $data .= '<option value=""></option>';
        foreach ($terms as $term) {
          $data .= "<input type='checkbox' name='pet-gender' value='$term->slug'[]" . ">$term->name";
        }
      $data .= '</select>';

      $data.=  '<br /><label>'.__('Size','wp_pet').'</label><select name="pet-size" id="pet-size">';
      $terms = get_terms('pet-size', array('hide_empty' => 1 ));

      $data .= '<option value=""></option>';
        foreach ($terms as $term) {
          $data .= "<option value='$term->slug'" . selected($term->slug, true, false) . ">$term->name</option>";
        }
      $data .= '</select>';

      $data.=  '<br /><label>'.__('Age','wp_pet').'</label><select name="pet-ages" id="pet-age">';
      $terms = get_terms('pet-ages', array('hide_empty' => 1 ));

      $data .= '<option value=""></option>';
        foreach ($terms as $term) {
          $data .= "<option value='$term->slug'" . selected($term->slug, true, false) . ">$term->name</option>";
        }
      $data .= '</select>';

      $data.=  '<br /><label>'.__('Coat','wp_pet').'</label><select name="pet-coat" id="pet-coat">';
      $terms = get_terms('pet-coat', array('hide_empty' => 1 ));

      $data .= '<option value=""></option>';
        foreach ($terms as $term) {
          $data .= "<option value='$term->slug'" . selected($term->slug, true, false) . ">$term->name</option>";
        }
      $data .= '</select>';

      $data.= '<br /><input id="ada_search_submit" type="submit" value="'. __('Go','wp_pet') . '"/>';
      $data.= '</form>';
    }

    return $content.$data;
}


//print performance
function performance( $visible = false ) {

    $stat = sprintf(  '%d queries in %.3f seconds, using %.2fMB memory',
        get_num_queries(),
        timer_stop( 0, 3 ),
        memory_get_peak_usage() / 1024 / 1024
        );

    echo $visible ? $stat : "<!-- {$stat} -->" ;
}
 add_action( 'wp_footer', 'performance', 20 );


function pet_change_default_title( $title ){
     $screen = get_current_screen();

     if  ( 'pet' == $screen->post_type ) {
          $title = __('Enter pet name here','wp_pet');
     }

     return $title;
}

add_filter( 'enter_title_here', 'pet_change_default_title' );



add_filter( 'the_content', 'place_special_content_387fbvbb', 20 );

function place_special_content_387fbvbb( $content ) {

    if (is_preview() && 'pet' == get_post_type())
    $note = '<div class="note">'.__('This post is still waiting for moderation.','wp_pet').'</div>';

    return $content.$note;
}


function pet_search_form($content) {


$types = get_terms('pet-category', array('hide_empty' => 1 ));
foreach ($types as $type) {
  $pet_types .= "<option value='$type->slug'" . selected($type->slug, true, false) . ">$type->name"."&nbsp;("."$type->count".")"."</option>";
}

$statuses = get_terms('pet-status', array('hide_empty' => 1 ));
foreach ($statuses as $status) {
  $pet_status .= "<option value='$status->slug'" . selected($status->slug, true, false) . ">$status->name"."&nbsp;("."$status->count".")"."</option>";
}



  $searchform .= '<form action="'.get_home_url().'/" method="get" id="searchpetform">'.
                 '<label for="pet_gender">'.__('Gender','wp_pet').'</label><select id="pet_gender" name="meta_value">'.
                 '<option value=""></option>'.
                 '<option value="'.__('Female','wp_pet').'">'.__('Female','wp_pet').'</option>'.
                 '<option value="'.__('Male','wp_pet').'">'.__('Male','wp_pet').'</option>'.
                 '</select><br />'.
                 '<label for="pet_category">'.__('Category','wp_pet').'</label><select id="pet_category" name="pet-category">'.
                 '<option value="0"></option>'.
                 $pet_types.
                 '</select><br />'.
                 '<label for="pet_status">'.__('Status','wp_pet').'</label><select id="pet_status" name="pet-status">'.
                 '<option value="0"></option>'.
                 $pet_status.
                 '</select>'.
                 '<input type="hidden" name="post_type" value="pet" />'.
                 '<br /><input type="submit" id="searchpet" name="search" value="'.__('Search pet','wp_pet').'">'.
                 ''.
                 ''.
                 '</form>';

  return $searchform;
}

?>