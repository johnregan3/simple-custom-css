=== Plugin Name ===
Contributors: johnregan3
Tags: css, styles, custom css, custom,
Requires at least: 3.0.1
Tested up to: 3.6
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Here is a short description of the plugin.  This should be no more than 150 characters.  No markup here.

== Description ==

An easy-to-use WordPress Plugin to add custom CSS styles that override Plugin and Theme default styles.

**Features**

- Simple but effective interface built on WordPress UI
- Virtually no impact on site performance
- No javascript files or complicated PHP requests
- Generates no CSS files
- Extremely small filesize (~3KB)

A few notes about the sections above:

== Installation ==

Install Simple Custom CSS just as you would any other WP Plugin:

1.  Upload the Plugin folder (simple-custom-css/) to the wp-content/plugins folder.

2. Go to [Plugins Admin Panel](http://codex.wordpress.org/Administration_Panels#Plugins "Plugins Admin Panel") and find the newly uploaded Plugin, "Simple Custom CSS" in the list.

3. Click Activate Plugin to activate it.

[More help installing Plugins](http://codex.wordpress.org/Managing_Plugins#Installing_Plugins "WordPress Codex: Installing Plugins")

== Frequently Asked Questions ==

= Will this Plugin work on my WordPress.com website? =

Sorry, this plugin is available for use only on self-hosted ( WordPress.org) websites.

= My Custom CSS isn't showing up =

There are several reasons this could be happening:

* Your CSS is targeting the wrong selector.

* Your CSS selectors aren't specific enough.

For instace, you may have:

	a {
		color: #f00;
	}

When you need:

	#content a {
		color: #f00;
	}

The specificity you need depends upon the CSS rules you are attempting to override.

* Your CSS isn't valid.  Please check your CSS at the [W3C CSS Validation Service](http://jigsaw.w3.org/css-validator/#validate_by_input+with_options" "W3C CSS Validation Service").



== Screenshots ==

1. The Simple Custom CSS Administration Screen

== Changelog ==

= 1.0 =
* Inital Release
