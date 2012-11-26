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
<a href="https://github.com/Dianakc/pet-manager/blob/master/inc/extend.php">/inc/extend.php line 252 to 255</a>
</p>

<p>
<strong>Front end publishing</strong> - The front end form works by placing a shortcode to a page. Right now, is out of date because som
 info was changed from metadatas to taxonomies. Bot form and action page are outdate currently. Form comes with simples jquery check.
Files <a href="https://github.com/Dianakc/pet-manager/blob/master/inc/form-action.php">/inc/form-action.php</a>
 and <a href="https://github.com/Dianakc/pet-manager/blob/master/inc/form.php">/inc/form.php</a>
</p>
