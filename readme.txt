=== Metabox Area ===
Stable tag: trunk
Requires at least: 3.8
Tested up to: 4.5.2
Contributors: Tkama

Tags: admin, edit post, more columns, third column, expand

Adds a third column and two columns after content editor to the page/post edit page. You can add metaboxes to these containers.

== Description ==

Add the option for a third column on the Edit Post/Page/Custom post type screens. This is useful if you have a lot of boxes on your edit screen, from custom taxonomies and plugins.

Also adds a pair of mini columns underneath the content editor, giving you space for more small boxes.

P.S. It's remake of the not working "Third Column" plugin by Marcus Downing.


== Installation ==

1. Upload the `third-column` folder to the `/wp-content/plugins/` directory.
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Edit any post
1. Drag boxes to the third column


== Screenshots ==

1. The option to show all new columns



== Frequently Asked Questions ==

= Do I need to modify my installation of WordPress to enable this third column? =

No, you don't need to modify WordPress at all.


= Can I have different layouts? =

The layout of boxes is specific to the post type, so you can have one layout for Posts, one for Pages, and one for each custom post type.


= Why don't I see the third column? =

Open up the "Screen Options" panel in the top-right. Under the "Screen Layout" section, set the "Number of Columns" option to 3.

If that doesn't work, make sure you have Javascript turned on.


= What happens when I switch the plugin off? =

The boxes should all jump back to the second column.

If it doesn't work - if your boxes disappear - try turning the plugin on again, then back off.


== Changelog ==

= 1.3 =
* ADD: bottom left-right metabox areas to main column. Like after post content.
* FIX: some important fixes

= 1.2 =
* ADD: remove third column on window resize when window less than 1300px

= 1.1 =
* FIX: disable on not public post types

= 1.0 =
* release