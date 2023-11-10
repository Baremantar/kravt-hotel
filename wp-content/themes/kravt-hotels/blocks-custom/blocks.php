<?php

function gutenberg_register_custom_blocks()
{
    if (!function_exists('register_block_type')) {
        return;
    }

    $custom_blocks = array(
        array('name' => 'block'),
        array('name' => 'section'),
        array('name' => 'section-1'),
        array('name' => 'section-city'),
        array('name' => 'section-hotel-services'),
        array('name' => 'link'),
        array('name' => 'span'),
        array('name' => 'content-item-1'),
        array('name' => 'content-span-p'),
        array('name' => 'content-p-span'),
        array('name' => 'content-p-span-multiple'),
        array('name' => 'room'),
        array('name' => 'room-type'),
        array('name' => 'hotel-type'),
        array('name' => 'restaraunt-type'),
        array('name' => 'slider-item'),
        array('name' => 'slider-item-1'),
        array('name' => 'slider-content-p-span-multiple'),
        array('name' => 'award'),
        array('name' => 'news-block'),
        array('name' => 'big-block-hotel-number'),
        array('name' => 'mini-block-hotel-number'),
        array('name' => 'beside-block'),
    );

    foreach ($custom_blocks as $block) {
        $script_name = 'gutenberg-custom-block-script-' . $block['name'];
        $style_name = 'gutenberg-custom-block-style-' . $block['name'];

        wp_register_script(
            $script_name,
            get_template_directory_uri() . '/blocks-custom/blocks/' . $block['name'] . '/index.js',
            array('wp-blocks', 'wp-element', 'wp-block-editor'),
            '1.3'
        );

        register_block_type('custom/' . $block['name'], array(
            'editor_script' => $script_name,
            'style' => $style_name,
        ));
    }
}

add_theme_support('editor-styles');
function gutenberg_setup_theme()
{
    add_editor_style(get_template_directory_uri() . '/blocks-custom/blocks.css');
}
add_action('admin_init', 'gutenberg_setup_theme');
add_action('afer_setup_theme', 'gutenberg_setup_theme');

add_action('init', 'gutenberg_register_custom_blocks');
