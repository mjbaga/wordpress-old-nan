# Code Structure
All the functionalities are created in plugins and are used in themes via widgets or shortcodes. 

# Disclaimer 
This project is for reference purposes only.

### Plugins
All the plugins follow the following structure:
- psr-4 implementation of classes
- assets: FE assets copied from prototype. Have to be copied manually.
- admin: contain functions to create settings in cms
- api: all functions that are used by other folders in this plugin are defined here. Implementation is in other folders.
- common: implementation of functions that are shared across the plugin. 
- includes: all configs for this plugin. defines constants for this plugin.
- posts: declares all the post types declared for this plugin and registers fields for them. Fields are all exported via acf plugin and the acf json object used to export the fields is also stored.
- post_templates: all the single.php files defined for the post types. Actual templating still in templates.
- pages: registeration of functions to create page templates via plugin
- page-templates: all the page templates defined by the plugin. Actual templating still in templates.
- shortcodes: defines all the shortcodes for this plugin
- templates: defines all the templates used by functions in this plugin
- vendor: all the third party code used for this plugin. Will be maintained in plugin's composer.json file.
- views: implementation of functions to get data from wordpress
- widgets: contains functionalities for all the widgets defined for this plugin
 
The templates are called using render function defined in the api for that plugin which accepts template name and data array as arguement. The data is rendered in actual template using data object. All the templates defined in templates folder can be overwritten in themes.

Run composer in the plugin directory before using it in the site.
# Setup
1. Pull everything for git
2. Run composer install in webroot.
3. Run composer install in all the custom plugins.
4. Copy FE assets for all the widgets from prototype and put them in respective plugins assets directories.
6. Create wp-config.php based on wordpress\wp-config-sample.php
