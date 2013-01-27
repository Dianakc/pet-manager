<?php
/*
Plugin Name: Pet Manager
Text Domain: wp_pet
Domain Path: /lang
Plugin URI: http://dianakcury.com/dev/pet-manager
Description: Pet manager helps you keep pets for adoptions or lost pets database with special info for every pet.
Version: 1.0
Author: Diana K. Cury
Author URI: http://dianakcury.com/
*/


  /*Definitions*/
		if ( !defined('WP_CONTENT_URL') )
		    define( 'WP_CONTENT_URL', get_option('siteurl') . '/wp-content');
		if ( !defined('WP_CONTENT_DIR') )
		    define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );

		if (!defined('PLUGIN_URL'))
		    define('PLUGIN_URL', WP_CONTENT_URL . '/plugins');
		if (!defined('PLUGIN_PATH'))
		    define('PLUGIN_PATH', WP_CONTENT_DIR . '/plugins');

		define('TC_FILE_PATH', dirname(__FILE__));
		define('TC_DIR_NAME', basename(TC_FILE_PATH));

    //include the main class file
    require_once PLUGIN_PATH .'/'.TC_DIR_NAME . '/inc/cpt-pets.php';
    require_once PLUGIN_PATH .'/'.TC_DIR_NAME . '/inc/extend.php';
    require_once PLUGIN_PATH .'/'.TC_DIR_NAME . '/inc/metabox/boxes.php';

    define( 'CMB_META_BOX_URL', PLUGIN_URL.'/'.TC_DIR_NAME . '/inc/metabox/' );





class PET_MANAGER {
	function __construct() {
		$this->PET_MANAGER();
	}

	function PET_MANAGER() {
		global $wp_version;

    add_theme_support( 'post-thumbnails' );
    add_image_size( 'pet_img', 200, 200, true );
    add_image_size( 'pet_mini', 50, 50, true );

	  }
  }


  //Starts everything
  add_action( 'init', 'petmanager_setup',1 );

  function petmanager_setup(){
    //Load the text domain, first of all
    load_plugin_textdomain('wp_pet', true, dirname( plugin_basename( __FILE__ ) ) . '/lang' );

    //pet_add_pages();

    //Enables Pet and Lost Types
    $PETPostType = new PETPostType();

		//Register the post type
		add_action('init', array($PETPostType,'register'),3 );

    add_action( 'init', 'pet_add_pages');

    //Register pet type taxonomies
    add_action( 'init', 'create_pet_category_taxonomy');
    add_action( 'init', 'create_pet_color_taxonomy');
    add_action( 'init', 'create_pet_status_taxonomy');
    add_action( 'init', 'create_pet_genre_taxonomy');
    add_action( 'init', 'create_pet_age_taxonomy');
    add_action( 'init', 'create_pet_breed_taxonomy');
    add_action( 'init', 'create_pet_size_taxonomy');
    add_action( 'init', 'create_pet_coat_taxonomy');
    add_action( 'init', 'create_pet_pattern_taxonomy');

    add_action( 'init', 'remove_pets_support');
    add_action( 'admin_menu' , 'remove_taxonomies_boxes' );
    add_shortcode( 'pet_shortcode', 'pet_shortcode_form' );
    add_shortcode( 'pet_search', 'pet_search_form' );
    add_filter('widget_text', 'do_shortcode');

  }

    function especial_queries(){
        global $wp;
        $wp->add_query_var('meta_key');
        $wp->add_query_var('meta_value');
        $wp->add_query_var('meta_compare');
    }

  	function remove_pets_support() {
  		remove_post_type_support( 'pet', 'excerpt' );
  		remove_post_type_support( 'pet', 'comments' );
  	}


    function pet_shortcode_form($content) {
      do_action('wp_head','pet_form');
      include('inc/form.php');
    }

  function pet_form() {
    include('inc/form-action.php');
  }
  add_filter('get_header','pet_form');


    // Add needed scripts
    function pet_manager_scripts() {
        if( is_page(__('Add a pet','wp_pet'))){
        wp_register_script( 'custom_js', get_template_directory_uri() . '/js/jquery.custom.js', array( 'jquery' ), '1.0', TRUE );
        wp_enqueue_script( 'custom_js' );
        // validation
        wp_register_script( 'validation', 'http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js', array( 'jquery' ) );
        wp_enqueue_script( 'validation' );
    }
    }
    add_action( 'wp_enqueue_scripts', 'pet_manager_scripts' );


    add_action( 'wp_enqueue_scripts', 'pet_manager_stylesheet' );

    function pet_manager_stylesheet() {
        // Respects SSL, Style.css is relative to the current file
        wp_register_style( 'prefix-style', plugins_url('/inc/pet_styles.css', __FILE__) );
        if( is_single() && 'pet' == get_post_type() || is_archive() || is_page(__('Add a pet','wp_pet'))){wp_enqueue_style( 'prefix-style' );}
    }

    function insert_attachment($file_handler,$post_id,$setthumb='false') {
    	// check to make sure its a successful upload
    	if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK) __return_false();

    	require_once(ABSPATH . "wp-admin" . '/includes/image.php');
    	require_once(ABSPATH . "wp-admin" . '/includes/file.php');
    	require_once(ABSPATH . "wp-admin" . '/includes/media.php');

    	$attach_id = media_handle_upload( $file_handler, $post_id );

    	if ($setthumb) update_post_meta($post_id,'_thumbnail_id',$attach_id);
    	return $attach_id;
    }


    /* Create some pages such Pets and Add a pet */
    function pet_add_pages(){

        if( get_page_by_title(__('Pets','wp_pet')) == false )
        $pets = array(
        'post_title' => __('Pets','wp_pet'),
        'post_name' => __('pet-list','wp_pet'),
        'post_type' => 'page',
        'post_status' =>'publish',
        'comment_status' => 'closed',
        );
        wp_insert_post( $pets );

        if( get_page_by_title(__('Add a pet','wp_pet')) == false )
        $addpet = array(
        'post_title' => __('Add a pet','wp_pet'),
        'post_type' => 'page',
        'post_content' => '[pet_shortcode]',
        'post_status' =>'publish',
        'comment_status' => 'closed',
        );
        wp_insert_post( $addpet );
    }


$PET_MANAGER = new PET_MANAGER();


?>
