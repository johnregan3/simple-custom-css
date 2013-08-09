Simple Custom CSS Plugin
=================

An easy-to-use WordPress Plugin to add custom CSS styles that override Plugin and Theme default styles.  This plugin is designed to meet the needs of administrators who would like to add custom CSS to their WordPress website.

**Features**

- No configuration needed
- Simple interface built on WordPress UI
- Virtually no impact on site performance
- No javascript files or complicated PHP requests
- Generates no CSS files
- Extremely lightweight (~5KB)
- Thorough Documentation

### Installation

Install Simple Custom CSS just as you would any other WP Plugin:

1.  [Download Simple Custom CSS](http://wordpress.org/plugins/simple-custom-css/ "Download Simple Custom CSS") from WordPress.org.

2.  Unzip the .zip file.

3.  Upload the Plugin folder (simple-custom-css/) to the wp-content/plugins folder.

4. Go to [Plugins Admin Panel](http://codex.wordpress.org/Administration_Panels#Plugins "Plugins Admin Panel") and find the newly uploaded Plugin, "Simple Custom CSS" in the list.

5. Click "Activate Plugin."

[More help installing Plugins](http://codex.wordpress.org/Managing_Plugins#Installing_Plugins "WordPress Codex: Installing Plugins")

### Use

1.  Navigate to Appearance > Custom CSS

2.  Enter in valid CSS styles

3.  Click "Update Custom CSS"

4.  View your changes in the Front End of your website

### Help

[Simple Custom CSS Wiki](https://github.com/johnregan3/simple-custom-css/wiki "Simple Custom CSS Wiki")

[Support Forum](http://wordpress.org/support/plugin/simple-custom-css "Support Forum")

###Changelog

***1.1***
* Removed unneeded hidden input
* Added Action Hooks
* Added cleanup on deletion
* Added author attribution option
* Changed method for adding CSS into the page:

Instead of using print_scripts to insert the CSS directly into the HEAD, CSS styles are generated within simple-custom-css.php (the sole file for this plugin), then added via enqueue_scripts, so now it will appear in the HEAD as

		<link rel="stylesheet" href="scss-style.css" />

...even though no css file is actually generated.

***1.0***
* Inital Release
