<?php

// Start XML file, create parent node
$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);
// Opens a connection to a MySQL server
$connection = new PDO('mysql:dbname=maps;host=localhost', 'root', '');
// Set the active MySQL database
$query = $connection->prepare("SELECT *FROM map");

$query->execute();
   
while ($row = $query->fetch()){
  // Add to XML document node
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("id",$row['id']);
  $newnode->setAttribute("name",$row['name']);
  $newnode->setAttribute("address", $row['place_Location']);
  $newnode->setAttribute("lat", $row['place_Lat']);
  $newnode->setAttribute("lng", $row['place_Lng']);
}

echo $dom->saveXML(); 

?>