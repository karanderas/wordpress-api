<?php
/**
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

get_header();
$post_id = get_the_ID();
$context = get_field( 'test', $post_id );

$request = new WP_REST_Request( 'GET', '/wp/v2/pages/2' );
$request->set_query_params( array( 'per_page' => 12 ) );

$response = rest_do_request( $request );
$server   = rest_get_server();
$data     = $server->response_to_data( $response, false );
$json     = wp_json_encode( $data );

echo '<p>' . $data['content']['rendered'] . '</p>';
?>

<main id="site-content" role="main">

	<?php

	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );
		}
	}

	?>

</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
