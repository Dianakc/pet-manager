<?php




if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "new_post") {
  global  $wpdb;

    $petname =  $_POST['petname'];
    $description = $_POST['description'];
    $tags = $_POST['post_tags'];
    $post_cat = $_POST['cat'];

    $useremail = $_POST['user-email'];
    $usercontact = $_POST['user-contact'];

    $petgender = $_POST['petgender'];
    $petage = $_POST['petage'];
    $petbreed = $_POST['petbreed'];
    $petvac = $_POST['petvac'];
    $petsize = $_POST['petsize'];
    $pethair = $_POST['pethair'];
    $petpatt = $_POST['petpatt'];
    $petnotes = $_POST['petnotes'];
    $petdate = $_POST['petdate'];
    $pettime = $_POST['pettime'];
    $petplace = $_POST['petplace'];


    // ADD THE FORM INPUT TO $new_post ARRAY
    $new_post = array(
    'post_title'    =>   $petname,
    'post_content'  =>   $description,
    'post_category' =>   array($_POST['cat'],$_POST['pet_status'],$_POST['pet_category']),
    'post_status'   =>   'pending',
    'post_type'     =>   'pet',
    'tags_input'    =>   $tags,

    'user-email'	=>	$useremail,
    'user-contact'	=>	$usercontact,

    'petgender'	=>	$petgender,
    'petage'	=>	$petage,
    'petbreed'	=>	$petbreed,
    'petvac'	=>	$petvac,
    'petsize'	=>	$petsize,
    'pethair'	=>	$pethair,
    'petpatt'	=>	$petpatt,
    'petnotes'	=>	$petnotes,
    'petdate'	=>	$petdate,
    'pettime'	=>	$pettime,
    'petplace'	=>	$petplace,

    );

    //SAVE THE POST
    $pid = wp_insert_post($new_post);

    // save taxonomies: post ID, form name, taxonomy name, if it appends(true) or rewrite(false)
//    wp_set_post_terms($pid,array($_POST['cat']),'pet-category',true);
//    wp_set_post_terms($pid,array($_POST['pet_state']),'state',true);
    wp_set_post_terms($pid,array($_POST['pet_status']),'pet-status',true);
    wp_set_post_terms($pid,array($_POST['pet_category']),'pet-category',true);
    wp_set_post_terms($pid,$_POST['post_tags'],'pet-color',true);

    //REDIRECT TO THE NEW POST ON SAVE
    $link = get_permalink( $pid );
    wp_redirect( $link );

    //ADD OUR CUSTOM FIELDS
  	add_post_meta($pid, '_data_pet_gender', $petgender, true);
  	add_post_meta($pid, '_data_pet_age', $petage, true);
  	add_post_meta($pid, '_data_pet_breed', $petbreed, true);
    add_post_meta($pid, '_data_pet_vaccines', $petvac, true);
  	add_post_meta($pid, '_data_pet_size', $petsize, true);
  	add_post_meta($pid, '_data_pet_coat', $pethair, true);
  	add_post_meta($pid, '_data_pet_pattern', $petpatt, true);

  	add_post_meta($pid, '_data_notes', $petnotes, true);
  	add_post_meta($pid, '_data_date', $petdate, true);
  	add_post_meta($pid, '_data_time', $pettime, true);
  	add_post_meta($pid, '_data_place', $petplace, true);

    add_post_meta($pid, '_data_mail', $useremail, true);
    add_post_meta($pid, '_data_contact', $usercontact, true);

  if ($_FILES) {
  foreach ($_FILES as $file => $array) {
  $newupload = insert_attachment($file,$pid);
  // $newupload returns the attachment id of the file that
  // was just uploaded. Do whatever you want with that now.
  }
}


} // END THE IF STATEMENT THAT STARTED THE WHOLE FORM

    //POST THE POST
    do_action('wp_insert_post', 'wp_insert_post');


?>