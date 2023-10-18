<?php
  // Retrieve the XML data from the POST request
  $xmlData = file_get_contents('php://input');

  // Specify the path and filename where you want to save the XML file
  $xmlFile = 'loggedIn.xml';

  // Save the XML data to the specified file
  file_put_contents($xmlFile, $xmlData);
?>
