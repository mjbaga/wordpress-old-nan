<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * This class extends default template loader from gamajo
 *
 * @author mjdbaga@gmail.com
 */
class NaN_Search_Common_Templater extends Gamajo_Template_Loader {

  /**
   * Prefix for filter names.
   *
   * @since 1.0.0
   * @type string
   */
  protected $filter_prefix = 'nan';

  /**
   * Directory name where custom templates for this plugin should be found in the theme.
   *
   * @since 1.0.0
   * @type string
   */
  protected $theme_template_directory = 'templates';

  /**
   * Reference to the root directory path of this plugin.
   *
   * @since 1.0.0
   * @type string
   */
  protected $plugin_directory = NAN_SEARCH_PLUGIN_DIR;

}
