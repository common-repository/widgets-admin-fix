<?php
/**
 * Plugin Name: Widget Admin Fix
 * Plugin URI: http://ptahdunbar.com/plugins/widget-admin-fix/
 * Description: Adds the ability to link to specific sidebars in the widgets admin page and have them open automatically for the user.
 * Version: 0.2
 * Author: Ptah Dunbar
 * Author URI: http://ptahdunbar.com
 * License: GNU General Public License 2.0 (GPL) http://www.gnu.org/licenses/gpl.html
 *
 *	Copyright 2010 Ptah Dunbar (http://ptahdunbar.com/contact)
 *
 *	    This program is free software; you can redistribute it and/or modify
 *	    it under the terms of the GNU General Public License, version 2, as 
 *	    published by the Free Software Foundation.
 *
 *	    This program is distributed in the hope that it will be useful,
 *	    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *	    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *	    GNU General Public License for more details.
 *
 * @package Widget_Admin_Fix
 */


add_action( 'load-widgets.php', 'waf_load_jquery' );
add_action( 'admin_head-widgets.php', 'widget_admin_fix' );

/**
 * Loads jQuery onto the page.
 *
 * @since 0.1
 */
function waf_load_jquery() {
	wp_enqueue_script( 'jquery' );
}

/**
 * Helper function for linking to the Widgets Admin page
 * with sidebars set in $widget_areas to open automatically.
 *
 * @since 0.1
 *
 * @param string $widget_areas Comma seperated list of sidebar IDs.
 * @param string $text Text for the link.
 */
function waf_widgets_link( $widget_areas = null, $text = 'Add Widgets' ) {
	if ( $widget_areas ) {
		if ( is_array($widget_areas) ) {
			$widget_areas = join( ',', $widget_areas );
		}		
		$link = '<a href="'. admin_url('widgets.php') .'?sidebar='. esc_attr($widget_areas) .'">'. esc_html($text) .'</a>';
		return $link;
	}
}

/**
 * Widget Admin Fix
 *
 * @since 0.1
 */
function widget_admin_fix() {
	?>
	<script type="text/javascript">
		//<![CDATA[
		jQuery(document).ready(function($) {
			close_all_widget_areas();
//			open_saved_widget_areas();
			<?php
			if ( isset($_REQUEST['sidebar']) ) {
				$sidebars =	explode( ',', $_REQUEST['sidebar'] );
				foreach ( $sidebars as $key => $sidebar_id ) { ?>
					open_widget_area( '<?php echo $sidebar_id; ?>' );
					<?php
				};
				unset($sidebars); // we don't need this variable anymore.
			};
			
			if ( isset($_REQUEST['close_sidebar']) ) {
				$sidebars =	explode( ',', $_REQUEST['close_sidebar'] );
				foreach ( $sidebars as $key => $sidebar_id ) { ?>
					close_widget_area( '<?php echo $sidebar_id; ?>' );
					<?php
				};
				unset($sidebars); // we don't need this variable anymore.
			};
			?>
			
			// Closes all sidebars
			function close_all_widget_areas() {
				$('.widget-liquid-right .widgets-holder-wrap').addClass('closed');
				$('.widget-liquid-right .widgets-holder-wrap').children('.sidebar-name').next().attr({
					'aria-disabled': "false",
					'class': "widgets-sortables ui-sortable ui-sortable-disabled ui-state-disabled",
				});
			}
			
			// Opens all sidebars
			function open_all_widget_areas() {
				$('.widget-liquid-right .widgets-holder-wrap').removeClass('closed');
				$('.widget-liquid-right .widgets-holder-wrap').children('.sidebar-name').next().attr({
					'aria-disabled': "true",
					'class': "widgets-sortables ui-sortable",
				});
			}
			
			// Open a sidebar by their sidebar-id
			function open_widget_area( id ) {
				$( '.widgets-holder-wrap #' + id ).parent('.widgets-holder-wrap').removeClass('closed');
				$( '.widgets-holder-wrap #' + id ).attr({
					'aria-disabled': "true",
					'class': "widgets-sortables ui-sortable",
				});
			}
			
			// Close a sidebar by their sidebar-id
			function close_widget_area( id ) {
				$( '.widgets-holder-wrap #' + id ).parent('.widgets-holder-wrap').addClass('closed');
				$( '.widgets-holder-wrap #' + id ).attr({
					'aria-disabled': "false",
					'class': "widgets-sortables ui-sortable ui-sortable-disabled ui-state-disabled",
				});
			}
		});
		//]]>
	</script>
	<?php
}
?>