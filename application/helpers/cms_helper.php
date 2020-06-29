<?php 

function dump($d, $name = '', $dump = false){
	echo '<pre style="padding:5px; background-color:#ececec; margin: 20px; 0">';
	if(!empty($name)) echo "<h3 style='color:blue;'><strong>$name</strong></h3>";
	if($dump){var_dump($d);}else{print_r($d);}
	echo '</pre>';
}
