=== Pet Manager ===
Contributors: Dianakc
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=dianakac%40gmail%2ecom&lc=BR&item_name=Diana%20K%2e%20C&item_number=Pet%20Manager%20%2d%20A%20WordPress%20plugin%20for%20animal%20shelters&no_note=0&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHostedGuest
Tags: animals, pet, pet shelters, animal shelters, BuddyPress
Requires at least: 3.0
Tested up to: 3.5
Stable tag: 1.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Pet Manager is a WordPress plugin that help you to run an animal shelter website. The goal is keep the management as easy as possible.

== Description ==

* **Animals as posts** - every animal is kept as a post type, add a pet is like to add blog posts or pages.
* **Especial info** - add specific info for every pet such type, age, size, colors, breed etc.
* **Frontend post** - Let users to post animals from a page in your site.
* **Display Widget** - display pets by category, status etc anywhere on your theme.
* **Search form Widget** - a simple search form for pets.
* **Contact form** (Jetpack or SlimJetpack is required) - Display a contact form so vistors can send an email to the post author.
* **Display Google Maps** - display a static Google Map just by provinding an address.
* **Fully localized** - ready to display info in your language.
* **Your own special info** - you do't need to stick to the info, e.g. you can use only the special you need such *Status*.
* **Works on BuddyPress** - added BuddyPress suport so pet posts are aso listed in Activity Stream.

**Please note** though Pet Manager share some data with old ADA plugin, Pet Manager is not a update. If you need some help on migrating to this new plugin let me know in [Pet Manager Suport Forum](http://wordpress.org/support/plugin/pet-manager).

== Screenshots ==

1. A pet for adoption, single post view
2. A Lost pet,  single post view, you can display a Google Map by providing an area or address
3. Widgets displaying last added pets, pets byt type, status etc and the search form
4. Pet post table in backend

== Installation ==

1. Install Pet Manager either via the WordPress.org plugin directory or by uploading the files to your server
1. Go to *Pets ? Options* & About to add categories such gender, age, etc
1. Verify the auto created pages in Pages: *Add a Pet* and *Pets* (titles can vary if you're using translastion)
1. That's it.  You're ready to go!

== Frequently Asked Questions ==

= How to allow users to post pets? =

In order to allow users to post in your site, firstly visit WordPress panel *Settings > General*, check the item *Membership - Anyone can register* and select an user role in *New User Default Role*, to at least `Contributor`.
The Pet Manager autocreate a *Add a pet* page where users can add pets only if the user is logged in, if not, a log in form is displayed. Any pet post submitted by non-editor/admins will be held for moderation.

Note that users will access default register page, but you can use any other plugin to create frontend forms, or even BuddyPress to keep users connect.

= How the contact form works? =

Every pet post can display a contact form (you can turn off this on every post), so visitors can contact the post author. You must use either [Jetpack](http://wordpress.org/extend/plugins/jetpack/) or [SlimJetpack](http://wordpress.org/extend/plugins/slimjetpack/) in order to use this feature.
Also, to avoid spam, is highly recommended to use [Akismet](http://akismet.com).

= What Add a Pet and Pets pages are for? =

These page are auto generated to provide a place in your site to search and add pets, you can delete these pages if not wanting to use these features.

= How to change/adjust the style =

You can copy the plugin stylesheet at `wp-content/plugins/pet-manager/inc/pet_styles.css` into your own theme stylesheet.
In order to prevent plugin stylesheet from loading also, add the following to your `functions.php`:

`add_action( 'wp_print_styles', 'my_deregister_styles', 100 );
function my_deregister_styles() {
	wp_deregister_style( 'pet-style' ); //Pet Manager

}`

== Advanced Info ==
Custom post type: pet

* **Taxonomies**: `pet-type`, `pet-status`, `pet-color`, `pet-gender`, `pet-age`, `pet-breed`, `pet-size`, `pet-coat` and `pet-pattern`

* **Metadata**: `_data_pet_vaccines`, `_data_pet_desex`, `_data_pet_needs`, `_data_pet_address`, `_data_pet_email_option`

== Upgrade Notice ==


== Changelog ==

= 1.2 =
* Solved an issue with PHP 5.4

= 1.1 =
* Added BuddyPress suport
* Some strings cleaning
* Some naming conventions change

= 1.0 =
* First release
