<?php

include('./array2hash.php');
$array = array(array("Pierre","30"), array("Mary","28"), array("adam", "25"), array("franco", "60"));
print_r ( array2hash($array) );

?>