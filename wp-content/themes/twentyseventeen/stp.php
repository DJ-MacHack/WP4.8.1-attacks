<?php
global $wpdb;
$tablename = "wp_liveshoutbox";
if (empty($_POST["search"])) {
    echo "search is empty";
  } else { 
echo $search;
echo "<br/>";
$sql = $wpdb->prepare( "SELECT * FROM wp_liveshoutbox WHERE name = %s", $search );
$results = $wpdb->get_results( $sql , ARRAY_A );
echo count($results);
echo "<br/>";
foreach ( $results as $page )
{
print_r($page).'<br/>';
#echo $page[0];
   #echo $page[0]->text.'<br/>';
   #echo $page[0]->name.'<br/>';
}
  }
#register_activation_hook( __FILE__, 'jal_install' );
#register_activation_hook( __FILE__, 'jal_install_data' );
#jal_install();
#jal_install_data();
?>