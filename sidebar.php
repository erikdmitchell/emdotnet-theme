<?php
/**
 * Displays the sidebar
 *
 * @package WordPress
 * @subpackage emdotnet
 * @since emdotnet 1.0.0
 */

?>

<?php
if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar() ) :
    ?>
    <?php
endif;
