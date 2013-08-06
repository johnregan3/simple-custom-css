=== Simple Custom CSS ===
Contributors: johnregan3
Donate Link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=BAG2XC69ZYADQ
Tags: css, styles, custom css, custom,
Requires at least: 3.0.1
Tested up to: 3.6
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add Custom CSS to your WordPress site without any hassles.

== Description ==

An easy-to-use WordPress Plugin to add custom CSS styles that override Plugin and Theme default styles. This plugin is designed to meet the needs of administrators who would like to add their own CSS to their WordPress website.

**Features**

- No configuration needed
- Simple interface built on WordPress UI
- Virtually no impact on site performance
- No javascript files or complicated PHP requests
- Generates no CSS files
- Extremely lightweight (~4KB)

A few notes about the sections above:

== Installation ==

Install Simple Custom CSS just as you would any other WP Plugin:

1.  Download Simple Custom CSS from WordPress.org.

2.  Unzip the .zip file.

3.  Upload the Plugin folder (simple-custom-css/) to the wp-content/plugins folder.

4. Go to [Plugins Admin Panel](http://codex.wordpress.org/Administration_Panels#Plugins "Plugins Admin Panel") and find the newly uploaded Plugin, "Simple Custom CSS" in the list.

5. Click Activate Plugin to activate it.

[More help installing Plugins](http://codex.wordpress.org/Managing_Plugins#Installing_Plugins "WordPress Codex: Installing Plugins")

== Frequently Asked Questions ==

Find more help at the [Simple Custom CSS Wiki](https://github.com/johnregan3/simple-custom-css/wiki "Simple Custom CSS Wiki")

= Will this Plugin work on my WordPress.com website? =

Sorry, this plugin is available for use only on self-hosted (WordPress.org) websites.

= My Custom CSS isn't showing up =

There are several reasons this could be happening:

* Your CSS is targeting the wrong selector.

* Your CSS selectors aren't specific enough.

For instance, you may have:

	a {
		color: #f00;
	}

When you need:

	#content a {
		color: #f00;
	}

The specificity you need depends upon the CSS rules you are attempting to override.

* Your CSS isn't valid.

Please check your CSS at the [W3C CSS Validation Service](http://jigsaw.w3.org/css-validator/#validate_by_input+with_options" "W3C CSS Validation Service").

== Screenshots ==

1. The Simple Custom CSS Administration Screen

== Changelog ==

= 1.0 =
* Inital Release

== Upgrade Notice ==

Initial Release