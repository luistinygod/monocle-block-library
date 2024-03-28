<?php
/**
 * Plugin Name:       Monocle Blocks Library
 * Description:       Example of plugin that loads a set of custom blocks
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            Luis Godinho
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       monocle-block-library
 *
 * @package           create-block
 */

defined( 'ABSPATH' ) || exit;

require_once __DIR__ . '/utils/related-query.php';


\add_action( 'init', 'monocle_block_library_init' );
\add_filter( 'block_categories_all', 'monocle_block_library_register_block_categories', 10, 2 );

/**
 * Register plugin Block Type.
 */
function monocle_block_library_init(): void {
	foreach ( glob( __DIR__ . '/build/*/block.json' ) as $file ) {
		\register_block_type( str_replace( '/block.json', '', $file ) );
	}
}

function monocle_block_library_register_block_categories( array $block_categories, object $editor_context ): array {
	if ( ! empty( $editor_context->post ) ) {
		\array_unshift(
			$block_categories,
			[
				'slug'  => 'monocle-sections',
				'title' => \esc_html_x( 'Sections', 'Block pattern category', 'monocle-block-library' ),
				'icon'  => null,
			]
		);
	}
	return $block_categories;
}