<?php

function register_cpt_pet() {
  $labels = array(
    'name' => __('Pets','wp_pet'),
    'singular_name' => __('Pet','wp_pet'),
    'add_new' => __('Add new Pet','wp_pet'),
    'add_new_item' => __('Adding new Pet','wp_pet'),
    'edit_item' => __('Edit','wp_pet'),
    'new_item' => __('New Pet','wp_pet'),
    'all_items' => __('All Pets','wp_pet'),
    'view_item' => __('View Pet','wp_pet'),
    'search_items' => __('Search for Pets','wp_pet'),
    'not_found' =>  __('Not found!','wp_pet'),
    'menu_name' => __('Pets','wp_pet'),

  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'pet/%pet-category%','with_front' => false),
    'capability_type' => 'post',
    'has_archive' => true,
    'hierarchical' => false,
    'menu_position' => null,
    'menu_icon'=> get_stylesheet_directory_uri('').'/img/pets.png',
    'supports' => array( 'title', 'editor', 'author', 'thumbnail')
  );
  register_post_type('pet',$args);
}


//create two taxonomies, gender and writers for the post type "book"
function create_pet_taxonomy()
{
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name' => 'Types',
    'singular_name' => __('Pet Category','wp_pet'),
    'search_items' =>  __('Search Pet category','wp_pet'),
    'all_items' => __('All categories','wp_pet'),
    'update_item' => __('Update','wp_pet'),
    'add_new_item' => __('Add a new Pet category','wp_pet'),
    'new_item_name' => __('New Pet category','wp_pet'),
    'menu_name' => __('Categories','wp_pet'),
  );

  register_taxonomy('pet-category',array('pet'), array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'pets','hierarchical' => true, 'with_front' =>true),
  ));
}

//Add pet genre and popluate it
function create_pet_status_taxonomy()
{
	if (!taxonomy_exists('pet-status')) {

    $labels = array('name' => _x( 'Status','wp-pet'),'menu_name' => __( 'Statuses','wp-pet'), );
		register_taxonomy( 'pet-status', 'pet', array( 'hierarchical' => false, 'labels' => $labels, 'query_var' => 'pet-status', 'rewrite' => array( 'slug' => __('status','wp-pet'), 'hierarchical' => false,'with_front' => FALSE ) ) );

		wp_insert_term(__('Adopt','wp-pet'), 'pet-status');
		wp_insert_term(__('Adopted','wp-pet'), 'pet-status');
		wp_insert_term(__('Lost','wp-pet'), 'pet-status');
		wp_insert_term(__('Found','wp-pet'), 'pet-status');
		wp_insert_term(__('Deceased','wp-pet'), 'pet-status');
	}
}


//Add pet genre and popluate it
function create_pet_genre_taxonomy()
{
	if (!taxonomy_exists('pet-gender')) {

    $labels = array('name' => _x( 'Gender','wp-pet'),'menu_name' => __( 'Genders','wp-pet'), );
		register_taxonomy( 'pet-gender', 'pet', array( 'hierarchical' => false, 'labels' => $labels, 'query_var' => 'pet-gender', 'rewrite' => array( 'slug' => __('genre','wp-pet'), 'hierarchical' => false,'with_front' => FALSE ) ) );

		wp_insert_term(__('Male','wp-pet'), 'pet-gender');
		wp_insert_term(__('Female','wp-pet'), 'pet-gender');
	}
}

//Add pet age and populate it
function create_pet_age_taxonomy()
{
	if (!taxonomy_exists('pet-ages')) {

    $labels = array('name' => _x( 'Age','wp-pet'),'menu_name' => __( 'Ages','wp-pet'), );
		register_taxonomy( 'pet-ages', 'pet', array( 'hierarchical' => false, 'labels' => $labels, 'query_var' => 'pet-ages', 'rewrite' => array( 'slug' => __('age','wp-pet'), 'hierarchical' => false,'with_front' => FALSE ) ) );

		wp_insert_term(__('Baby (Under 1 year)','wp-pet'), 'pet-ages');
		wp_insert_term(__('Adult (2 to 9 years)','wp-pet'), 'pet-ages');
		wp_insert_term(__('Senior (More than 10 years)','wp-pet'), 'pet-ages');
	}
}

//Add pet breed and populate it
function create_pet_breed_taxonomy()
{
	if (!taxonomy_exists('pet-breeds')) {

    $labels = array('name' => _x( 'Breeds','wp-pet'),'menu_name' => __( 'Breeds','wp-pet'), );
		register_taxonomy( 'pet-breeds', 'pet', array( 'hierarchical' => false, 'labels' => $labels, 'query_var' => 'pet-breeds','rewrite' => array( 'slug' => __('breed','wp-pet'), 'hierarchical' => false,'with_front' => FALSE ) ) );

		wp_insert_term(__('Mixed','wp-pet'), 'pet-breeds');
		wp_insert_term(__('Labrador Retriever','wp-pet'), 'pet-breeds');
		wp_insert_term(__('Cocker Spaniel','wp-pet'), 'pet-breeds');
		wp_insert_term(__('German Shepherd','wp-pet'), 'pet-breeds');
		wp_insert_term(__('Boxer','wp-pet'), 'pet-breeds');
		wp_insert_term(__('Beagle','wp-pet'), 'pet-breeds');
		wp_insert_term(__('Dachshund','wp-pet'), 'pet-breeds');
		wp_insert_term(__('Poodle','wp-pet'), 'pet-breeds');
		wp_insert_term(__('Rottweiler','wp-pet'), 'pet-breeds');
	}
}

//Add pet size and populate it
function create_pet_size_taxonomy()
{
	if (!taxonomy_exists('pet-size')) {

    $labels = array('name' => _x( 'Size','wp-pet'),'menu_name' => __( 'Sizes','wp-pet'), );
		register_taxonomy( 'pet-size', 'pet', array( 'hierarchical' => false, 'labels' => $labels, 'query_var' => 'pet-size', 'rewrite' => array( 'slug' => __('size','wp-pet'), 'hierarchical' => false,'with_front' => FALSE ) ) );

		wp_insert_term(__('Newborn (Imprecise)','wp-pet'), 'pet-size');
		wp_insert_term(__('Mini','wp-pet'), 'pet-size');
		wp_insert_term(__('Small','wp-pet'), 'pet-size');
		wp_insert_term(__('Medium','wp-pet'), 'pet-size');
		wp_insert_term(__('Large','wp-pet'), 'pet-size');
		wp_insert_term(__('Huge','wp-pet'), 'pet-size');
	}
}

//Add pet coat and populate it
function create_pet_coat_taxonomy()
{
	if (!taxonomy_exists('pet-coat')) {

    $labels = array('name' => _x( 'Coat','wp-pet'),'menu_name' => __( 'Coats','wp-pet'), );
		register_taxonomy( 'pet-coat', 'pet', array( 'hierarchical' => false, 'labels' => $labels, 'query_var' => 'pet-coat','rewrite' => array( 'slug' => __('coat','wp-pet'), 'hierarchical' => false,'with_front' => FALSE ) ) );

		wp_insert_term(__('None','wp-pet'), 'pet-coat');
		wp_insert_term(__('Short','wp-pet'), 'pet-coat');
		wp_insert_term(__('Long','wp-pet'), 'pet-coat');
		wp_insert_term(__('Mixed','wp-pet'), 'pet-coat');
		wp_insert_term(__('Wired','wp-pet'), 'pet-coat');
		wp_insert_term(__('Curly','wp-pet'), 'pet-coat');
	}
}

//Add pet pattern and populate it
function create_pet_pattern_taxonomy()
{
	if (!taxonomy_exists('pet-pattern')) {

    $labels = array('name' => _x( 'Pattern','wp-pet'),'menu_name' => __( 'Patterns','wp-pet'), );
		register_taxonomy( 'pet-pattern', 'pet', array( 'hierarchical' => false, 'labels' => $labels, 'query_var' => 'pet-pattern', 'rewrite' => array( 'slug' => __('pattern','wp-pet'), 'hierarchical' => false,'with_front' => FALSE ) ) );

		wp_insert_term(__('Solid','wp-pet'), 'pet-pattern');
		wp_insert_term(__('Bicolor','wp-pet'), 'pet-pattern');
		wp_insert_term(__('Tricolor','wp-pet'), 'pet-pattern');
		wp_insert_term(__('Merle','wp-pet'), 'pet-pattern');
		wp_insert_term(__('Tuxedo','wp-pet'), 'pet-pattern');
		wp_insert_term(__('Harlequin','wp-pet'), 'pet-pattern');
		wp_insert_term(__('Spotted','wp-pet'), 'pet-pattern');
		wp_insert_term(__('Flecked','wp-pet'), 'pet-pattern');
		wp_insert_term(__('Brindle','wp-pet'), 'pet-pattern');
		wp_insert_term(__('Saddle','wp-pet'), 'pet-pattern');
		wp_insert_term(__('Sable','wp-pet'), 'pet-pattern');
	}
}

//Add pet coat and populate it
function create_pet_color_taxonomy()
{
	if (!taxonomy_exists('pet-color')) {

    $labels = array('name' => _x( 'Color','wp-pet'),'menu_name' => __( 'Colors','wp-pet'), );
		register_taxonomy( 'pet-color', 'pet', array( 'hierarchical' => false, 'labels' => $labels, 'query_var' => 'pet-color', 'rewrite' => array( 'slug' => __('color','wp-pet'), 'hierarchical' => false,'with_front' => FALSE ) ) );

		wp_insert_term(__('Black','wp-pet'), 'pet-color');
		wp_insert_term(__('Brown','wp-pet'), 'pet-color');
		wp_insert_term(__('Grey','wp-pet'), 'pet-color');
		wp_insert_term(__('White','wp-pet'), 'pet-color');
		wp_insert_term(__('Chocolate','wp-pet'), 'pet-color');
		wp_insert_term(__('Gold','wp-pet'), 'pet-color');
		wp_insert_term(__('Red','wp-pet'), 'pet-color');
		wp_insert_term(__('Cream','wp-pet'), 'pet-color');
		wp_insert_term(__('Bronze','wp-pet'), 'pet-color');
	}
}


add_filter('post_link', 'pettype_permalink', 10, 3);
add_filter('post_type_link', 'pettype_permalink', 10, 3);

function pettype_permalink($permalink, $post_id, $leavename) {
	if (strpos($permalink, '%pet-category%') === FALSE) return $permalink;

        // Get post
        $post = get_post($post_id);
        if (!$post) return $permalink;

        // Get taxonomy terms
        $terms = wp_get_object_terms($post->ID, 'pet-category','orderby=term_order');
        if (!is_wp_error($terms) && !empty($terms) && is_object($terms[0])) $taxonomy_slug = $terms[0]->slug;
        else $taxonomy_slug = __('no-pet-category','wp_pet');

	return str_replace('%pet-category%', $taxonomy_slug, $permalink);
}


function remove_taxonomies_boxes() {
      remove_meta_box( 'tagsdiv-pet-category', 'pet', 'side' );
      remove_meta_box( 'tagsdiv-pet-color', 'pet', 'side' );
      remove_meta_box( 'tagsdiv-pet-status', 'pet', 'side' );
      remove_meta_box( 'tagsdiv-pet-pattern', 'pet', 'side' );
      remove_meta_box( 'tagsdiv-pet-coat', 'pet', 'side' );
      remove_meta_box( 'tagsdiv-pet-gender', 'pet', 'side' );
      remove_meta_box( 'tagsdiv-pet-size', 'pet', 'side' );
      remove_meta_box( 'tagsdiv-pet-breeds', 'pet', 'side' );
      remove_meta_box( 'tagsdiv-pet-ages', 'pet', 'side' );
    }


?>