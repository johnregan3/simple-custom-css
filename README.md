# Simple Custom CSS Plugin

Contributors: johnregan3  
Donate Link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=BAG2XC69ZYADQ  
Tags: css, styles, custom css, custom, code, editor, customizer  
Requires at least: 3.0.1  
Tested up to: 5.8.1  
Stable tag: trunk  
License: GPLv2 or later  
License URI: http://www.gnu.org/licenses/gpl-2.0.html  

## Description

Add Custom CSS to your WordPress site without any hassles.

An easy-to-use WordPress Plugin to add custom CSS styles that override Plugin and Theme default styles. This plugin is designed to meet the needs of administrators who would like to add their own CSS to their WordPress website.  Styles created with this plugin will render even if the theme is changed.

**New in Version 4.0.5**

* AMP Support Added!
* Tested for WP version 5.8.1

**About AMP Support**

This plugin no longer enqueues your saved styles in a "pseudo-file", but rather prints the styles directly into the `<head>` element.  This allows for better caching, and also processing by AMP plugins.

### Features

* AMP Support
* Customizer Control (live preview)
* Useful Code Syntax Highlighter
* Code linting (error checking)
* No configuration needed
* Simple interface built on native WordPress UI
* Virtually no impact on site performance
* No complicated database queries
* Thorough documentation
* Allows Administrator access on WP Networks (Multisite)

## Installation

Install Simple Custom CSS just as you would any other WP Plugin:

1. [Download Simple Custom CSS](http://wordpress.org/plugins/simple-custom-css/ "Download Simple Custom CSS") from WordPress.org.

2. Unzip the .zip file.

3. Upload the Plugin folder (simple-custom-css/) to the wp-content/plugins folder.

4. Go to [Plugins Admin Panel](http://codex.wordpress.org/Administration_Panels#Plugins "Plugins Admin Panel") and find the newly uploaded Plugin, "Simple Custom CSS" in the list.

5. Click "Activate Plugin."

[More help installing Plugins](http://codex.wordpress.org/Managing_Plugins#Installing_Plugins "WordPress Codex: Installing Plugins")

## Screenshots

### Settings Page

<img src="https://raw.githubusercontent.com/johnregan3/simple-custom-css/master/assets/screenshot-1.png" width="700px" />

### Customizer Section

<img src="https://raw.githubusercontent.com/johnregan3/simple-custom-css/master/assets/screenshot-2.png" width="300px" />

## Usage

1.  Navigate to Appearance > Custom CSS in the Admin Menu

2.  Enter in valid CSS styles

3.  Click "Update Custom CSS"

4.  View your changes in the Front End of your website


## Help

[Simple Custom CSS Wiki](https://github.com/johnregan3/simple-custom-css/wiki "Simple Custom CSS Wiki")

[Support Forum](http://wordpress.org/support/plugin/simple-custom-css "Support Forum")

## Changelog

***4.0.5***
* AMP Support. Thanks, @westonruter!
* Tested for compatibility with WP version 5.8.1

***4.0.4***
* Tested for compatibility with WP version 5.4.1

***4.0.3***
* Tested for compatibility with WP version 5.3

***4.0.2***
* Use WP's CodeMirror on settings page
* Tested for compatibility with WP version 5.1.1
* Tested for compatibility with PHP version 7.2

***4.0.1***
* Fixed bug with broken editor styles on older versions of WP.

***4.0***
* New Customizer Control (still compatible with older WP versions)
* Added colors and linting to the Settings Page
* Updated hooks to replace hyphens with underscores
* Tested for WPCS compliance
* Tested for compatibility with WP version 4.9.4

***3.3***
* Added support for https://
* Added base support for Danish language.  Thanks @ThomasDK81!
* Tested for compatibility with WP version 4.4.1

***3.2***
* Tested for compatibility with WP 4.1
* Improved architecture to reduce the number of queries.  Thanks @dannyvankooten!

***3.0.1***
* Tested for compatibility with WP 3.9.1
* Sidebar "Update CSS" button added

***3.0***
* Added Sytnax Highlighter
* Removed Need for "Allow Quotation Marks" checkbox
* Removed plugin attribution text
* Minor styling changes.  Thanks @kucrut!

***2.5***
* Fixed issue with WP installs in subdirectories.  Thanks @lopo!
* Tested for compatibility with WP 3.8.1

***2.0***
* Added option to allow Double Quotes in CSS
* Tested for compatibility with WP 3.8

***1.2.1***
* Tested for compatibility with WP 3.7.1
* Code update to conform fully with WP coding standards

***1.2***
* Give Admins (not just Super Admins) access to the plugin
* Correcting Credit error
* Minor Bugfixes

***1.1.1***
* Allowing the ">" direct child selector.

***1.1***
* Removed unneeded hidden input
* Added Action Hooks
* Added cleanup on deletion
* Added author attribution option
* Added a more elegant method for adding CSS to the page:

Instead of using print_scripts() to insert the CSS directly into the HEAD, CSS styles are generated within simple-custom-css.php, then added via wp_enqueue_scripts, so now it will appear in the HEAD as:

		<link rel="stylesheet" href="http://yoursite.com/?sccss=1" />

...even though no css file is actually generated.

***1.0***  
* Initial Release


## Upgrade Notice

***4.0.5***  
Added AMP Support. Tested for compatibility with WP 5.4.1.

***4.0.4***  
Tested for compatibility with WP 5.4.1.

***4.0.2***  
Tested for compatibility with WP 5.1.1/PHP 7.2.  Use native WP CodeMirror.

***4.0.1***  
Settings page style fixes for older versions of WP.

***4.0***  
Tested for compatibility with WP 4.9.4.  Added Customizer support.

***3.3***  
Tested for compatibility with WP 4.4.1.  Added support for http://.

***3.2***  
Tested for compatibility with WP 4.1.  Improved architecture to reduce the number of queries

***3.0.1***  
Tested for compatibility with WP 3.9.1.  Sidebar "Update CSS" button added.

***3.0***  
Added new Syntax highlighter, removed attribution text and need for "Allow Quotation Marks" option.

***2.5***  
Fixed issue with WP installs in subdirectories.  Thanks @lopo!

***2.0***  
Now SCCSS gives you the option to allow Double Quotes!

***1.2.1***  
Compatibility with WP 3.7.1, code update to conform with WP coding standards.

***1.2***  
Give Admins (not just Super Admins) access to the plugin & Correcting Credit error.

***1.1.1***  
Allowing the ">" direct child selector.

***1.1***  
Changed method for inserting CSS, added support for cleanup on deletion, other minor changes.

***1.0***  
Inital Release

