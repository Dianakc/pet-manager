<div id="ada-form">

<?php if(is_user_logged_in()): ?>  <!-- Check if is logged -->
    <div id="add-pet-form">


<script>
jQuery(document).ready(function() {
    jQuery("#new_post").validate(

{

errorClass: "invalid",
validClass: "success",

        rules: {
            petname:{
                required: true,
                email: false,
                minlength: 2
            },
            pet_status:{
                required: true,
            },
            pet_category:{
                required: true,
            },
            pet_size:{
                required: true,
            },
            pet_gender:{
                required: true,
            },
            pet_age: "required",
            pet_vaccines: "required",
            pet_email_option: "required"
        },
        messages: {
            petname: {
                required: "<?php _e('Required field &#9650;', 'wp_pet'); ?>",
                minlength: "<?php _e('Pet name must be at least 3 letters long', 'wp_pet'); ?>"
            },
            pet_status: {
                required: "<?php _e('Required field &#9658;', 'wp_pet'); ?>",
            },
            pet_category: {
                required: "<?php _e('Required field &#9658;', 'wp_pet'); ?>",
            },
            pet_size: {
                required: "<?php _e('Required field &#9658;', 'wp_pet'); ?>",
            },
            pet_gender: {
                required: "<?php _e(' Required field &#9658;', 'wp_pet'); ?>",
            },
            pet_age: {
                required: "<?php _e('Required field &#9658;', 'wp_pet'); ?>",
            },
            pet_vaccines: "<?php _e('Required field &#9658;', 'wp_pet'); ?>",
            pet_email_option: "<?php _e('Required field', 'wp_pet'); ?>"

        },

    });

});
</script>

    <form id="new_post" name="new_post" method="post" action="new_pet" class="wpcf7-form" enctype="multipart/form-data"> <!-- Form starts -->

        <p><?php _e('Fill the pet information here, you can add and change all info anytime. Required fields are marked *', 'wp_pet'); ?></p>

          <fieldset>
				  <label for="petname"><?php _e('Pet name', 'wp_pet'); ?>*</label>
				  <input type="text" id="petname" tabindex="6" name="petname" class="required" style="width:98%"/><br /><br />

        <label for="pet-description"><?php _e('Description', 'wp_pet'); ?>*</label>
        <?php
             $set = array(
             'wpautop' => true,
             'media_buttons' => true,
             'textarea_rows' => 8,
             'editor_id'=> 'petdescription',
             'tinymce' => array(
                 'theme_advanced_buttons1' => 'formatselect,underline,bold,italic,underline,forecolor,|,undo,redo,|,link,unlink,underline,wp_help',
                 'theme_advanced_buttons2' => '',
                 'theme_advanced_buttons3' => '',
                 'theme_advanced_buttons4' => ''
             ),
             'quicktags' => array('buttons' => 'strong,em,link,img,ul,ol,li,close')
            );
           wp_editor('', 'description',$set );?>

          </fieldset>

          <fieldset name="pet-info">

          <ol class="listpetinfo">
                <li>
                <label for="pet-status"><?php _e('Status', 'wp_pet'); ?>*</label>
                <select name="pet_status" id="pet_status" tabindex="9" class="required">
                <option value=""></option>
                  <?php
                    $terms = get_terms('pet-status', array('hide_empty' => 0));
                    foreach ($terms as $term) {echo "<option id='pet_status' value='$term->slug'>$term->name</option>"; }
                    ?>
                </select>
                </li>


                <li>
                <label for="pet-category"><?php _e('Category', 'wp_pet'); ?>*</label>
                <select name="pet_category" id="pet_category" tabindex="9" class="required">
                <option value=""></option>
                  <?php
                    $terms = get_terms('pet-category', array('hide_empty' => 0));
                    foreach ($terms as $term) {echo "<option id='pet_category' value='$term->slug'>$term->name</option>"; }
                    ?>
                </select>
                </li>

                <li>
                <label for="pet-gender"><?php _e('Gender', 'wp_pet'); ?>*</label>
                <select name="pet_gender" id="pet_gender" tabindex="9" class="required">
                <option value=""></option>
                  <?php
                    $terms = get_terms('pet-gender', array('hide_empty' => 0));
                    foreach ($terms as $term) {echo "<option id='pet_gender' value='$term->slug'>$term->name</option>"; }
                    ?>
                </select>
                </li>

                <li>
                <label for="pet-size"><?php _e('Size', 'wp_pet'); ?>*</label>
                <select name="pet_size" id="pet_size" tabindex="9" class="required">
                <option value=""></option>
                  <?php
                    $terms = get_terms('pet-size', array('hide_empty' => 0));
                    foreach ($terms as $term) {echo "<option id='pet_size' value='$term->slug'>$term->name</option>"; }
                    ?>
                </select>
                </li>

                <li>
                <label for="pet-age"><?php _e('Age', 'wp_pet'); ?>*</label>
                <select name="pet_age" id="pet_age" tabindex="9" class="required">
                <option value=""></option>
                  <?php
                    $terms = get_terms('pet-age', array('hide_empty' => 0));
                    foreach ($terms as $term) {echo "<option id='pet_age' value='$term->slug'>$term->name</option>"; }
                    ?>
                </select>
                </li>
          </ol>
        </fieldset>

        <fieldset>
          <label for="pet-breed"><?php _e('Pet breeds', 'wp_pet'); ?></label><br />
          <ul class="list_color">
          <?php
            $breeds = get_terms('pet-breed', 'orderby=id&hide_empty=0');
            $counter = 0;
              foreach ($breeds as $breed) {
                $counter++;
                  $option = '<li><input type="checkbox" name="pet_breed[]" id="'.$breed->slug.'" value="'.$breed->slug.'">'.$breed->name.'</li>';
                  echo $option;
              }
          ?>
          </ul>
          </fieldset>

        <fieldset>
          <label for="pet-colors"><?php _e('Pet colors', 'wp_pet'); ?></label><br />
          <ul class="list_color">
          <?php
            $colors = get_terms('pet-color', 'orderby=id&hide_empty=0');
            $counter = 0;
              foreach ($colors as $color) {
                $counter++;
                  $option = '<li><input type="checkbox" name="pet_color[]" id="'.$color->slug.'" value="'.$color->slug.'">'.$color->name.'</li>';
                  echo $option;
              }
          ?>
          </ul>
          </fieldset>

          <fieldset>
          <label for="pet-coat"><?php _e('Pet coat', 'wp_pet'); ?></label><br />
          <ul class="list_coats">
          <?php
            $coats = get_terms('pet-coat', 'orderby=id&hide_empty=0');
            $counter = 0;
              foreach ($coats as $coat) {
                $counter++;
                  $option = '<li><input type="checkbox" name="pet_coat[]" id="'.$coat->slug.'" value="'.$coat->slug.'">'.$coat->name.'</li>';
                  echo $option;
              }
          ?>
          </ul>
          </fieldset>

        <fieldset>
          <label for="pet-pattern" class="s_label"><?php _e('Pattern', 'wp_pet'); ?></label>
            <select name="pet_pattern" id="pet_gender" tabindex="9">
                <option value=""></option>
                  <?php
                    $terms = get_terms('pet-pattern', array('hide_empty' => FALSE));
                    foreach ($terms as $term) {echo "<option id='pet_pattern' value='$term->slug'>$term->name</option>"; }
                    ?>
            </select>
        </fieldset>

        <fieldset>
        <ol class="listpetinfo">

          <li>
            <label for="pet_vaccines"><?php _e('Vaccines', 'wp_pet'); ?></label>
            <select name="pet_vaccines" id="pet_vaccines" tabindex="9">
            <option value=""></option>
            <option tabindex="23" name="pet_vaccines"  value="<?php _e('Vaccinated', 'wp_pet'); ?>" /><?php _e('Vaccinated', 'wp_pet'); ?></option>
            <option tabindex="24" name="pet_vaccines"  value="<?php _e('Dose Interval', 'wp_pet'); ?>" /><?php _e('Dose Interval', 'wp_pet'); ?></option>
            <option tabindex="25" name="pet_vaccines"  value="<?php _e('Unknown', 'wp_pet'); ?>" /><?php _e('Unknown', 'wp_pet'); ?></option>
            </select>
          </li>

          <li>
          <label for="pet-desex"><?php _e('Desexed', 'wp_pet'); ?></label>
            <select name="pet_desex" id="pet_desex" tabindex="9">
                <option value=""></option>
                <option value="<?php _e('Desexed', 'wp_pet'); ?>"><?php _e('Desexed', 'wp_pet'); ?></option>
                <option value="<?php _e('No desexed', 'wp_pet'); ?>"><?php _e('No desexed', 'wp_pet'); ?></option>
            </select>
          </li>

          <li>
          <label for="pet-needs"><?php _e('Special needs', 'wp_pet'); ?></label>
            <select name="pet_needs" id="pet_needs" tabindex="9">
                <option value=""></option>
                <option value="<?php _e('Special needs', 'wp_pet'); ?>"><?php _e('Special needs', 'wp_pet'); ?></option>
                <option value="<?php _e('No special needs', 'wp_pet'); ?>"><?php _e('No special needs', 'wp_pet'); ?></option>
            </select>
            </li>
          </ol>
        </fieldset>

        <fieldset>
          <span class="fieldt"><label for="pet_email_option"><?php _e('Contact', 'wp_pet'); ?>*</label>
            <p><?php _e('Set to display or not the contact form on this pet page so users can contact you by email.', 'wp_pet'); ?></p>
            <input class="required" type="radio"  tabindex="24" name="pet_email_option"  value="yes" /><span class="pet_email_option"><?php _e('Yes', 'wp_pet'); ?>&nbsp;&nbsp;</span>
            <input type="radio" tabindex="25" name="pet_email_option"  value="no" /><span class="pet_email_option"><?php _e('No', 'wp_pet'); ?>&nbsp;&nbsp;</span>
          </span>
        </fieldset>

      <fieldset name="site-image" class="site-image">
        <input type="file" name="image" class="file_input_hidden site-image file_upload" onchange="javascript: document.getElementById('fileName').value = this.value" />
        <br /><?php _e('200 width x 200 height at least', 'wp_pet'); ?>
      </fieldset>

      <fieldset>
        <h3><?php _e('Lost & Found Information','wp_pet');?></h3>
        <p><?php _e('Add an address here to display a map if your lost or found a wondering pet.','wp_pet');?></p>
        <label for="pet_address"><?php _e('Address', 'wp_pet'); ?></label>
				<input type="text" value="" id="pet_address" tabindex="3" name="pet_address" style="width:98%"/><br />
      </fieldset>

        <fieldset name="submit">
  				<input type="submit" value="<?php _e('Submit pet'); ?>" tabindex="40" id="submit" name="submit" />
      	</fieldset>

		  	<input type="hidden" name="action" value="new_post" />

        <?php wp_nonce_field('new_pet'); ?>


</form> <!-- Form ends -->

    </div>

<?php else: ?>

    <div id="register_box">
    <h2><?php _e('Register'); ?></h2>
    <p><?php _e('You must be logged in order to add pets, please login or'); ?> <strong><a title="<?php _e('Click to register'); ?>" href="<?php echo home_url(); ?>/wp-login.php?action=register"><?php _e('Register'); ?></a></strong></p>
    </div>

    <div id="login_box">
    <h2><?php _e('Login'); ?></h2>
    <?php wp_login_form(array( 'value_remember'=> true )); ?>
    </div>

<?php endif; ?>

      </div>
