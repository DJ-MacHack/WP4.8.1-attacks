<?php
/*
Template Name: testpage
*/
?>
<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>
<!--
<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
-->
			<?php
			echo 'start test page!';
global $wpdb;
$tablename = $wpdb->prefix . "wp_parts";
$sql = $wpdb->prepare( "SELECT * FROM %s ORDER BY id DESC",$tablename );
$results = $wpdb->get_results( $sql , ARRAY_A );
echo sizeof($results);
echo count($results);
echo $results[0];
?>
<!--
		</main>
	</div>
</div>
 -->
<?php get_footer();
