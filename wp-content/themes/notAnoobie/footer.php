<?php

/**
 * The template for displaying the footer
 *
 * @package WordPress
 * @subpackage Arcc Offices
 * @since 0.1.0
 */
?>

<?php
        $footer_data = NaNThemeComponents\Shared\Footer::get_data();
        nan_theme_render( 'templates/content', 'footer', $footer_data );
        wp_footer(); 
?>

</body>
</html>