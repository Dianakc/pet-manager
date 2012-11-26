<div id="ada-form">

<?php if(is_user_logged_in()): ?>  <!-- Check if is logged -->
    <div id="add-job">


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
            email: {
                required: true,
                email: true,
                minlength: 5
            },
        },
        messages: {
            petname: {
                required: "<?php _e('Enter the pet name here', 'wp_pet'); ?>",
                minlength: "<?php _e('Pet name must be at least 3 letters long', 'wp_pet'); ?>"
            },
            email: {
                required: "<?php _e('Enter your email address', 'wp_pet'); ?>",
                email: "<?php _e('Enter a valid email address', 'wp_pet'); ?>"
            },

        },
    });

});
</script>

    <form id="new_post" name="new_post" method="post" action="new_pet" class="wpcf7-form" enctype="multipart/form-data"> <!-- Form starts -->


        <fieldset name="pet-info">
        <h2><?php _e('Quick Add', 'wp_pet'); ?></h2>
        <p><?php _e('Fill the pet information here, you can add and change all info anytime.', 'wp_pet'); ?></p>


				  <label for="petname"><?php _e('Pet name', 'wp_pet'); ?></label>
				  <input type="text" id="petname" tabindex="6" name="petname" width="200" class="required" /><br />

        <?php
             $set = array(
             'wpautop' => true,
             'media_buttons' => true,
             'textarea_rows' => 8,
             'editor_class'=> 'required',
             'tinymce' => array(
                 'theme_advanced_buttons1' => 'formatselect,underline,bold,italic,underline,forecolor,|,undo,redo,|,link,unlink,underline,wp_help',
                 'theme_advanced_buttons2' => '',
                 'theme_advanced_buttons3' => '',
                 'theme_advanced_buttons4' => ''
             ),
             'quicktags' => array('buttons' => 'strong,em,link,img,ul,ol,li,close')
            );
           wp_editor('', 'description',$set );?>

          <fieldset name="pet-info">


          <span class="field"><label for="pet-category"><?php _e('Category', 'wp_pet'); ?></label>
          <select name="pet_category" id="pet_category" tabindex="9" class="required">
            <?php
              $terms = get_terms('pet-category', array('hide_empty' => 0));
              foreach ($terms as $term) {echo "<option id='pet_category' value='$term->slug'>$term->name</option>"; }
              ?>
          </select>
          </span>



          <span class="field">
          <label for="pet-status"><?php _e('Status', 'wp_pet'); ?></label>
          <select name="pet_status" id="pet_status" tabindex="9" >
            <?php
              $terms = get_terms('pet-status', array('hide_empty' => 0));
              foreach ($terms as $term) {echo "<option id='pet_status' value='$term->slug'>$term->name</option>"; }
              ?>
          </select></span><br />

          <span class="field"> <label for="petgender"><?php _e('Gender', 'wp_pet'); ?></label>
            <input type="radio" tabindex="17"  name="petgender"  value="<?php _e('Male', 'wp_pet'); ?>" checked="checked"/><span class="petgender"><?php _e('Male', 'wp_pet'); ?></span>
            <input type="radio" tabindex="18"  name="petgender"  value="<?php _e('Female', 'wp_pet'); ?>" /><span class="petgender"><?php _e('Female', 'wp_pet'); ?></span>
          </span>

          <span class="field"><label for="petage"><?php _e('Age', 'wp_pet'); ?></label>
            <select tabindex="20" name="petage" id="petage">
             <option value="<?php _e('Baby (Under 1 year)', 'wp_pet'); ?>"><?php _e('Baby (Under 1 year)', 'wp_pet'); ?></option>
             <option value="<?php _e('Adult (2 to 9 years)', 'wp_pet'); ?>"><?php _e('Adult (2 to 9 years)', 'wp_pet'); ?></option>
             <option value="<?php _e('Senior (More than 10 years)', 'wp_pet'); ?>"><?php _e('Senior (More than 10 years)', 'wp_pet'); ?></option>
            </select></span><br />

          <span class="fieldt"><label for="petbreed"><?php _e('Breed(s)', 'wp_pet'); ?></label>
            <input type="text" value="" id="petbreed" tabindex="21" name="petbreed" style="text-transform:capitalize"/>
            <br /><?php _e('One or more breeds separated by commas. Example: Poodle, Unknown', 'wp_pet'); ?>
          </span>

          <span class="fieldt"><label for="petvac"><?php _e('Vaccines', 'wp_pet'); ?></label>
            <input type="radio" tabindex="24" name="petvac"  value="<?php _e('Vaccinated', 'wp_pet'); ?>" /><span class="petvac"><?php _e('Vaccinated', 'wp_pet'); ?></span>
            <input type="radio" tabindex="25" name="petvac"  value="<?php _e('Dose Interval', 'wp_pet'); ?>" /><span class="petvac"><?php _e('Dose Interval', 'wp_pet'); ?></span>
            <input type="radio" tabindex="23"  name="petvac"  value="<?php _e('Unknown', 'wp_pet'); ?>" /><span class="petvac"><?php _e('Unknown', 'wp_pet'); ?></span>
          </span>

          <span class="field"><label for="petsize"><?php _e('Size', 'wp_pet'); ?></label>
            <select tabindex="26" name="petsize" id="petsize">
             <option value="<?php _e('Newborn (Imprecise)', 'wp_pet'); ?>"><?php _e('Newborn (Imprecise)', 'wp_pet'); ?></option>
             <option value="<?php _e('Mini', 'wp_pet'); ?>"><?php _e('Mini', 'wp_pet'); ?></option>
             <option value="<?php _e('Small', 'wp_pet'); ?>"><?php _e('Small', 'wp_pet'); ?></option>
             <option value="<?php _e('Medium', 'wp_pet'); ?>"><?php _e('Medium', 'wp_pet'); ?></option>
             <option value="<?php _e('Large', 'wp_pet'); ?>"><?php _e('Large', 'wp_pet'); ?></option>
             <option value="<?php _e('Huge', 'wp_pet'); ?>"><?php _e('Huge', 'wp_pet'); ?></option>
            </select></span>

          <span class="field"><label for="pethair"><?php _e('Coat', 'wp_pet'); ?></label>
            <select tabindex="27" name="pethair" id="pethair">
             <option value="<?php _e('None', 'wp_pet'); ?>"><?php _e('None', 'wp_pet'); ?></option>
             <option value="<?php _e('Short', 'wp_pet'); ?>"><?php _e('Short', 'wp_pet'); ?></option>
             <option value="<?php _e('Long', 'wp_pet'); ?>"><?php _e('Long', 'wp_pet'); ?></option>
             <option value="<?php _e('Mixed', 'wp_pet'); ?>"><?php _e('Mixed', 'wp_pet'); ?></option>
             <option value="<?php _e('Wired', 'wp_pet'); ?>"><?php _e('Wired', 'wp_pet'); ?></option>
             <option value="<?php _e('Curly', 'wp_pet'); ?>"><?php _e('Curly', 'wp_pet'); ?></option>
            </select></span>

          <span class="fieldt checkboxes"><label class="petcolor" for="petcolor"><?php _e('Colors', 'wp_pet'); ?></label>
            <?php
              $terms = get_terms('pet-color', array('hide_empty' => 0));
              foreach ($terms as $term) {echo "<label for='$term->slug'><input type='checkbox'  id='post_tags' name='post_tags[]' value='$term->slug'><span>$term->name</span></label>"; }
            ?></span>
        </fieldset>

      <fieldset name="site-image" class="site-image">
        <input type="file" name="image" class="file_input_hidden site-image file_upload" onchange="javascript: document.getElementById('fileName').value = this.value" />
        <br /><?php _e('Pet image should be squared, 200 width x 200 height at last', 'wp_pet'); ?>
      </fieldset>

        <fieldset name="submit">
        <label for="user-email"><?php _e('Contact e-mail', 'wp_pet'); ?></label>
				<input type="text" value="" id="user-email" class="required email" tabindex="3" name="email" class="required email" /><br />
        </fieldset>

        <fieldset name="submit">
  				<input type="submit" value="<?php _e('Submit'); ?>" tabindex="40" id="submit" name="submit" />
      	</fieldset>

		  	<input type="hidden" name="action" value="new_post" />

        <?php wp_nonce_field('new_pet'); ?>


</form> <!-- Form ends -->

    </div>

<?php else: ?>

    <div id="caixa-registro">
    <h2>Registrar-se</h2>
    <p><strong><a title="Clique para registra-se" href="<?php echo home_url(); ?>/wp-login.php?action=register">Registre-se</a></strong> para anunciar oportunidades no site.</p>
    </div>

    <div id="ouline"><span>OU</span></div>

    <div id="caixa-login">
    <h2>Fazer Login</h2>
    <?php wp_login_form(array( 'value_remember'=> true )); ?>
    </div>

<?php endif; ?>

      </div>
