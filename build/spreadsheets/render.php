<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

$block_content  = '<div ' . get_block_wrapper_attributes() . '>';
$block_content .= '<h3 class="wp-block-heading">' . esc_html( $attributes['heading'] ) . '</h3>';
$block_content .= '<ul class="wp-block-list">';

$url_path = sprintf('/spreadsheets/%s/', $attributes['folder']);
$full_path = ABSPATH . $url_path;
$list = [];

/**
 * Genarate an array of filenames (will be in alpabetical order)
 */
if (is_dir($full_path)) {
    foreach (new DirectoryIterator($full_path) as $file) {
        if ($file->isDot()) continue; // ignore . and ..
        if (substr($file->getFilename(), 0, 1) == '.') continue; // ignore hidden files
        if (is_file($full_path . $file->getFilename())) {
            $list[] = $file->getFilename();
        }
    }
}

if (count($list) == 0) {
    /**
     * No files to show
     */
    $block_content .= '<li>Enter folder name in the block properties</li>';
} else {
    /**
     * Reverse the sort order
     */
    rsort($list);

    /**
     * Map each filename to it's html representation
     */
    $list = array_map(function ($filename) use ($url_path) {
        $parts = explode(" ", $filename);
        array_shift($parts);
        $display_name = implode(" ", $parts);
        return sprintf(
            '<li><a href="%s" download="%s">%s</a></li>',
            $url_path . urlencode($filename),
            htmlspecialchars($display_name),
            htmlspecialchars($display_name)
        );
    }, $list);

    /**
     * Add to the content
     */
    $block_content .= implode("\n", $list);
}
$block_content .= '</ul>';
$block_content .= '</div>';

echo $block_content;

?>

