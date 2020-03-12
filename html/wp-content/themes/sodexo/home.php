<?php
/**
 * Template Name: Home
 *
 * It's the route file of the client solutions.
 *
 * @package underscore
 */
get_header();

$post_id             = get_the_ID();
$context['title']    = get_field( 'title', $post_id );
$context['subtitle'] = get_field( 'subtitle', $post_id );
$context['image']    = get_field( 'image', $post_id );

var_dump( $context );

get_footer();
