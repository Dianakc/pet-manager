=== Pet Manager ===
Contributors: Dianakc
Tags: animals, pet, pet shelters, animal shelters
Requires at least: 3.0
Tested up to: 3.5
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Pet Manager is a WordPress plugin that help you to run an animal shelter website. The goal is keep the management as easy as possible.

== Description ==

* **Zero settings page and panels!** - I will try to keep this plugin as simpler as possible, not provinding a lot of settings and panels.
* **Animals as posts** - every animal is kept as a post type, add a pet is like to add blog posts or pages.
* **Search form** - a complete search form for pets, visitors can search pets within all the specific pet infos.
* **Especial info** - add specific info for every pet such type, age, size, colors, breed etc.
* **Contact form** (Jetpack is required) - Display a contact form so vistors can send a contact email to the post author.
* **Display Google Maps** - lost pet posts can display a static Google Map.
* **Back and Front end publishing** - Let users to post animals.

== Screenshots ==
1. Adopt a pet single post, visitors send email to the post author
2. A Lost pet, you can display a Google Map if provide a area or address
3. Widgets  displaying last added pets, pets byt type, status etc and a search form

== Installation ==

1. Install Pet Manager either via the WordPress.org plugin directory or by uploading the files to your server
1. Go to *Pets ? Options* & About to add categorias such gender, age, etc
1. That's it.  You're ready to go!

== Frequently Asked Questions ==

= How to allow users to post pets? =

In order to allow users to post in your site, firstly visit WordPress panel *Settings > General*, check the item *Membership - Anyone can register* and select an user role in *New User Default Role*, to at least `Contributor`.
The Pet Manager autocreate a *Add a pet* page where users can add pets only if the user is logged in, if not, a log in form is displayed. Any pet post submitted by non-editor/admins will be held for moderation.

Note that users will access default register page, but you can use any other plugin to create frontend forms, or even BuddyPress to keep users connect.

= How the contact form works? =

Every pet post can display a contact form (you can turn off this on every post), so visitors can contact the post author. To avoid spam, is highly recommended to use [Akismet](http://akismet.com).

=  =

== Advanced Info ==
Custom post type: pet

* **Taxonomies**: `pet-type`, `pet-status`, `pet-color`, `pet-gender`, `pet-age`, `pet-breed`, `pet-size`, `pet-coat` and `pet-pattern`

* **Metadata**: `_data_pet_vaccines`, `_data_pet_desex`, `_data_pet_needs`, `_data_pet_address`, `_data_pet_email_option`, `_data_pet_control`

== Version log ==

= 1.0 =
* First release


