<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );



/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_sample_metaboxes( array $meta_boxes ) {


	// Start with an underscore to hide fields from custom fields list
	$prefix = '_data_';

	$meta_boxes[] = array(
		'id'         => 'pet_profile',
		'title'      => 'Pet Manager',
		'pages'      => array( 'pet' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(

			array(
				'name' => __('Pet Profile','wp_pet'),
				'desc' => __('Fill the pet information here, you can add and change all info anytime.','wp_pet'),
				'id'   => $prefix . 'pet_title_2',
				'type' => 'title',
			),
     array(
     	'name' => __('Category','wp_pet'),
     	'id' => $prefix . 'pet_category',
     	'taxonomy' => 'pet-category',
     	'type' => 'taxonomy_select',
     ),
			array(
				'name'    => __('Status','wp_pet'),
				'desc'    => 'field description (optional)',
				'id'      => $prefix . 'pet_status',
				'type'    => 'taxonomy_select',
				'taxonomy'    => 'pet-status'
			),
			array(
       	'name' => __('Gender','wp_pet'),
       	'id' => $prefix . 'pet_gender',
       	'taxonomy' => 'pet-gender',
       	'type' => 'taxonomy_select',
			),
			array(
       	'name' => __('Age','wp_pet'),
       	'id' => $prefix . 'pet_age',
       	'taxonomy' => 'pet-age',
       	'type' => 'taxonomy_select',
			),
			array(
				'name' => __('Breed','wp_pet'),
				'id'   => $prefix . 'pet_breed',
        'taxonomy' => 'pet-breed',
				'type' => 'taxonomy_multicheck',
			),
			array(
       	'name' => __('Size','wp_pet'),
       	'id' => $prefix . 'pet_size',
       	'taxonomy' => 'pet-size',
       	'type' => 'taxonomy_select',
			),
      array(
      	'name' => __('Coat','wp_pet'),
      	'id' => $prefix . 'pet_coat',
      	'taxonomy' => 'pet-coat',
      	'type' => 'taxonomy_multicheck',
      ),
      array(
      	'name' => __('Pattern','wp_pet'),
      	'id' => $prefix . 'pet_pattern',
      	'taxonomy' => 'pet-pattern',
      	'type' => 'taxonomy_select',
      ),
      array(
      	'name' => __('Colors','wp_pet'),
      	'id' => $prefix . 'pet_color',
      	'taxonomy' => 'pet-color',
      	'type' => 'taxonomy_multicheck',
      ),
			array(
				'name'    => __('Vaccines','wp_pet'),
				'id'      => $prefix . 'pet_vaccines',
				'type'    => 'radio_inline',
				'options' => array(
					array( 'name' => __('Vacinated','wp_pet'), 'value' => __('Vacinated','wp_pet'), ),
					array( 'name' => __('Dose Interval','wp_pet'), 'value' => __('Dose Interval','wp_pet'), ),
					array( 'name' => __('Unknown','wp_pet'), 'value' => __('Unknown','wp_pet'), ),
				),
			),
			array(
				'name'    => __('Desexed','wp_pet'),
				'id'      => $prefix . 'pet_desex',
				'type'    => 'select',
				'options' => array(
					array( 'name' => '', 'value' => '', ),
					array( 'name' => __('Desexed','wp_pet'), 'value' => __('Desexed','wp_pet'), ),
					array( 'name' => __('No desexed','wp_pet'), 'value' => __('No desexed','wp_pet'), ),
				),
			),

			array(
				'name'    => __('Special needs','wp_pet'),
				'id'      => $prefix . 'pet_needs',
				'type'    => 'select',
				'options' => array(
          array( 'name' => '', 'value' => '', ),
					array( 'name' => __('Special needs','wp_pet'), 'value' => __('Special needs','wp_pet'), ),
					array( 'name' => __('No special needs','wp_pet'), 'value' => __('No special needs','wp_pet'), ),
				),
			),
			array(
				'name'    => __('Contact','wp_pet'),
				'desc'    => __('Set to display or not the contact form on this pet page so users can contact you by email.','wp_pet'),
				'id'      => $prefix . 'pet_email_option',
				'type'    => 'radio',
				'options' => array(
					array( 'name' => __('Yes','wp_pet'), 'value' => 'yes', ),
					array( 'name' => __('No','wp_pet'), 'value' => 'no', ),
				),
			),
			array(
				'name' => __('Lost & Found Information','wp_pet'),
				'desc' => __('Add an address here to display a map if your lost or found a wondering pet.','wp_pet'),
				'id'   => $prefix . 'pet_title_3',
				'type' => 'title',
			),
			array(
				'name' => __('Address','wp_pet'),
				'desc' => __('Address or place reference','wp_pet'),
				'id'   => $prefix . 'pet_address',
				'type' => 'text_medium',
			),
/*			array(
				'name' => __('Date','wp_pet'),
				'desc' => '',
				'id'   => $prefix . 'pet_date',
				'type' => 'text_date_timestamp',
			),
			array(
	            'name' => __('Time','wp_pet'),
	            'desc' => '',
	            'id'   => $prefix . 'pet_time',
	            'type' => 'text_time',
	        ),
			array(
				'name' => __('Contact','wp_pet'),
				'desc' => __('Inform a e-mail address so people can contact you.','wp_pet'),
				'id'   => $prefix . 'pet_title_3',
				'type' => 'title',
			),*/

/*		array(
				'name' => __('Contact e-mail','wp_pet'),
				'desc' => '',
				'id'   => $prefix . 'pet_another_email',
				'type' => 'text_medium',
			),*/
		),
	);



	// Add other metaboxes as needed

	return $meta_boxes;
}

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'init.php';

}