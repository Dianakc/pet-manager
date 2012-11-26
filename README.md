<h2>Pet Manager</h2>
<p><em>A WordPress plugin for animal shelters</em></p>

<p>Pet Manager is a free WordPress plugin that help you to run an animal shelter website. The goal is keep the management as easy as possible. 
<strong>Please note, this plugin is still in development!</strong></p>

<h3>Features</h3>
<ul>
<li>Zero settings page and panels! - I will try to keep this plugin as simpler as possible, not provinding a lot of settings and panels.</li>
<li>Works with any well written theme - this plugin do not need theme file editing as long the theme is well written.</li>
<li>Animals as posts - every animal is kept as a post type, add a pet is like to add blog posts or pages.</li>
<li>Search form - a complete search form for pets, visitors can search pets within all the specific pet infos.</li>
<li>Especial info - add specific info for every pet such type, age, size, colors, breed etc.</li>
<li>Contact form (Jetpack is required) - You can display a contact form for every pet, with specif contact info. e.g. if you post a lost pet, you can add the owner email</li>
<li>Display Google Maps - lost pet posts can display a static Google Map.</li>
<li>Front end publishing - Let users to post animals.</li>
</ul>

<h3 style= "color:#FD4747">Fix needed</h3>
<p>As I said: this plugin is still in development! Some features are not working properly or need better testing.
The following thigs need some fix:</p>

<p><strong>Search Form</strong> - Mostly offers drop-downs for infos, while is needed to provide checkboxes for some itens such animal gender.
<a target="_blank" href="https://github.com/Dianakc/pet-manager/blob/master/inc/extend.php">/inc/extend.php line 252 to 255</a>
</p>

<p>
<strong>Front end publishing</strong> - The front end form works by placing a shortcode to a page. Right now, is out of date because som
 info was changed from metadatas to taxonomies. Bot form and action page are outdate currently. Form comes with simples jquery check.
Files <a target="_blank" href="https://github.com/Dianakc/pet-manager/blob/master/inc/form-action.php">/inc/form-action.php</a>
 and <a target="_blank" href="https://github.com/Dianakc/pet-manager/blob/master/inc/form.php">/inc/form.php</a>
</p>

<p><b>Verify if Jetpack is available or not</b> - Pet manager rely on Jetpack forms, so it should test if the plugin is available before print out shortcodes.</p>

<h3>Some Technical Aspects</h3>

<p><b>Custom post type:</b> <code>pet</code></p>
<p><b>Taxonomies:</b> <code>pet-type</code>, <code>pet-status</code>, <code>pet-color</code>, <code>pet-gender</code>,
 <code>pet-ages</code>, <code>pet-breeds</code>, <code>pet-size</code>, <code>pet-coat</code> and <code>pet-pattern</code></p>
<p><b>Metadata:</b> <code>_data_pet_vaccines</code>, <code>_data_pet_address</code>, <code>_data_pet_geocode</code>, 
<code>_data_text_date_timestamp</code>, <code>_data_text_time</code>, <code>_data_pet_email_option</code>, <code>_data_pet_another_email</code>,
<code>_data_pet_control</code> and <code>_data_pet_fee</code></p>

<h4>Plugins</h4>
<p><b><a target="_blank" href="https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress">Custom Metaboxes and Fields for WordPress</a></b></p>
<p><b><a target="_blank" href="jetpack.me">Jetpack by WordPress</a></b></p>