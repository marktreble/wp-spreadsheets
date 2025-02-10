<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

$block_content  = '<div ' . get_block_wrapper_attributes() . '>';
$block_content .= '<h3 class="wp-block-heading">' . esc_html( $attributes['heading'] ) . '</h3>';
$block_content .= '<ul class="wp-block-list">';

$url_path = sprintf('/spreadsheets/%s/', $attributes['folder']);
$full_path = ABSPATH . $url_path;
$got_files = false;

if (is_dir($full_path)) {
    foreach (new DirectoryIterator($full_path) as $file) {
        if($file->isDot()) continue;
        if (is_file($full_path . $file->getFilename())) {
            $block_content .= '<li><a href="' . $url_path . $file->getFilename() . '">' . $file->getFilename() . '</a></li>';
            $got_files = true;
        }
    }
}

if (!$got_files) {
    $block_content .= '<li>Enter folder name in the block properties</li>';
}
$block_content .= '</ul>';
$block_content .= '</div>';

echo wp_kses_post( $block_content );

?>

