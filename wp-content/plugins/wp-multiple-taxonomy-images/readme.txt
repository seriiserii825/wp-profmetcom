=== WP Multiple Taxonomy Images ===
Contributors: Otto Bibartiu
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=ZPAVLC9SMUVXW
Tags: Multiple Taxonomy Images, Multi Images Categories, Multiple Taxonomy Image,  Multiple Tax Images, Category Image, Category Images, Categories Images, taxonomy image, taxonomy images, taxonomies images, category icon, categories icons, category logo, categories logos, admin, wp-admin, category image plugin, categories images plugin, category featured image, categories featured images, feature image for category, multiple category image
Requires at least: 4.0.1
Tested up to: 4.5.3
Stable tag: 0.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

The WP Multiple Taxonomy Images Plugin allows you to add multiple images to a term. 
It supports category, tags and custom taxonomies.

== Description ==

The WP Multiple Taxonomy Images Plugin allows you to add multiple images to a term. 
It supports category, tags and custom taxonomies. Terms can have a different number 
of images.

* Works with custom categories, tags, and custom taxonomies.
* Multiple images per term.
* Number of images can be changed individually for each term.
* Thumbnails overview in the term list.
* Images can be changed when editing terms.
* A simple settings page allows you to exclude certain taxonomies.

== Usage ==

1. Use `<?php if (function_exists('get_tax_image_urls')) $img_urls = get_tax_image_urls($term_id ,'full'); ?>` to get an array of all image URLs.  
2. Use `<?php if (function_exists('get_tax_images')) $img_html = get_tax_images($term_id ,'full'); ?>` to get all images as HTML img-tags.
3. Use `<?php if (function_exists('get_tax_image_metadata')) $img_html = get_tax_image_metadata($term_id); ?>` to get an array of every image metadata. 
   Each array entry has an object, which corresponds to the return value of `wp_get_attachment_metadata()` for each single image.  

If you do not know the `$term_id` of the current term in your category/taxonomy template, then you 
can query it with the following command: 
`$tax_obj = get_queried_object();`
`$term_id = $tax_obj->term_id;`


== Installation ==

You can install WP Multiple Taxonomy Images from the WordPress admin panel:

1. Visit the Plugins > Add New and search for 'WP Multiple Taxonomy Images'.
2. Click to install.
3. Once installed, activate and it is functional.
	
OR

Manual Installation:

1. Download the plugin, then extract it.
2. Upload `wp-multiple-taxonomy-images` extracted folder to the `/wp-content/plugins/` directory
3. Activate the plugin through the 'Plugins' menu in WordPress
	

== Screenshots ==

1. Images can be added via the media box when creating a new tag/category (custom term).
2. You can add or remove as many images you want per term.
3. All images are shown as thumbnails.
4. When editing the terms, one can still change images or the number of images.
5. A simple settings page allows you to exclude taxonomies.

== Changelog ==
= 0.3 =
Fix warnings in post view.

= 0.2 =
Update text in readme.txt. 

= 0.1 =
Release of WP Multiple Taxonomy Images.

== Frequently Asked Questions == 

No questions yet. Please feel free to ask questions.

== Upgrade Notice ==

Frist release, there are no upgrade notice.
