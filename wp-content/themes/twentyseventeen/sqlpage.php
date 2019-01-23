<?php
/*
Template Name: sqlpage
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

<form method="GET" action="sqlpage">  
 Username: <input type="text" name="search" value="">
  <br>
  Password: <input type="text" name ="password" value ="">
  <br>
    <input type="submit" name="submit" value="Submit"> 
	<br>
</form>
			
<?php

print_r($_GET['search']);
echo '<br/>start test page!<br/>';
global $wpdb;
$tablename = "wp_liveshoutbox";
echo "<br/>";
$statement = "SELECT * FROM wp_secrets WHERE Username = '$search' AND password = %s";
$sql = $wpdb->prepare( $statement, $_GET['password']);
echo '<br/>'.$sql.'<br/>';
$results = $wpdb->get_results( $sql , ARRAY_A );
echo 'results: <br/>';
echo count($results);
if( count($results) > 0){
foreach ( $results as $page )
{
print_r($page).'<br/>';

}}
echo "<br/>";


?>
<!--
		</main>
	</div>
</div>
 -->
<?php get_footer();
?>
