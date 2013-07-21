<?php
$filteredData=substr($GLOBALS['HTTP_RAW_POST_DATA'], strpos($GLOBALS['HTTP_RAW_POST_DATA'], ",")+1);

// Need to decode before saving since the data we received is already base64 encoded
$decodedData=base64_decode($filteredData);
$filename = $_GET['id'];

$fp = fopen( 'images/' . $filename . '.png', 'wb' );
fwrite( $fp, $decodedData);
fclose( $fp );
?>