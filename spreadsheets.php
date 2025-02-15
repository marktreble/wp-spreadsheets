<?php
/**
 * Plugin Name:       Spreadsheets
 * Description:       Display archive of links to spreadsheets
 * Version:           0.2.0
 * Requires at least: 6.7
 * Requires PHP:      7.4
 * Author:            Mark Treble
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       spreadsheets
 *
 * @package Spreadsheets
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function gbsra_spreadsheets_block_init() {
	register_block_type( __DIR__ . '/build/spreadsheets' );
}
add_action( 'init', 'gbsra_spreadsheets_block_init' );
