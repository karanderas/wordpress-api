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
?>
<img src="https://a.slack-edge.com/80588/img/services/jenkins-ci_512.png" style="width: 100px; height: 100px;"alt="">

<script>
var fetchModule = (function() {
    let img = document.getElementsByTagName('img')[0];
    let url = 'http://localhost:8080/wp-json/acf/v3/pages/19/';
    async function fetchUrl() {
        const resp = await fetch(url);
        const data = await resp.json();
        img.src = data['acf']['image']['url'];
    }
    fetchUrl();
})()
</script>
<?php
get_footer();
