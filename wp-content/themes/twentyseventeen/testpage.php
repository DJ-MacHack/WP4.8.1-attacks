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

<form method="post" action="">  
 Suche: <input type="text" name="search" value="">
  <br>
    <input type="submit" name="submit" value="Submit">  <br>
</form>
			<?php

global $jal_db_version;
$jal_db_version = '1.0';

function jal_install() {
	global $wpdb;
	global $jal_db_version;

	$table_name = $wpdb->prefix . 'liveshoutbox';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		name tinytext NOT NULL,
		text text NOT NULL,
		url varchar(55) DEFAULT '' NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

	add_option( 'jal_db_version', $jal_db_version );
}

function jal_install_data() {
	global $wpdb;
	
	$welcome_name = 'Mr. WordPress';
	$welcome_text = 'Congratulations, you just completed the installation!';
	
	$table_name = $wpdb->prefix . 'liveshoutbox';
	
	$wpdb->insert( 
		$table_name, 
		array( 
			'time' => current_time( 'mysql' ), 
			'name' => $welcome_name, 
			'text' => $welcome_text, 
		) 
	);
}
?>
			<?php
if (empty($_POST["search"])) {
    echo "search is empty";
  } else { 
echo $search;
echo '<br/>start test page!<br/>';
global $wpdb;
$tablename = "wp_liveshoutbox";
#$test = "testuser";
#echo $test;
echo "<br/>";
$sql = $wpdb->prepare( "SELECT * FROM wp_liveshoutbox WHERE name like %s", $search );
echo '<br/>'.$sql.'<br/>';
$results = $wpdb->get_results( $sql , ARRAY_A );
echo 'results: <br/>';
echo count($results);
echo "<br/>";
if( count($results) > 0){
foreach ( $results as $page )
{
print_r($page).'<br/>';
#echo $page[0];
   #echo $page[0]->text.'<br/>';
   #echo $page[0]->name.'<br/>';
}}}
#register_activation_hook( __FILE__, 'jal_install' );
#register_activation_hook( __FILE__, 'jal_install_data' );
#jal_install();
#jal_install_data();
?>
<!--
		</main>
	</div>
</div>
 -->
<?php get_footer();
?>