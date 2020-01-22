<?php 
  $content = $_POST['total'];  
 $myfile = file_put_contents('BGLEntries.txt', $content.PHP_EOL , FILE_APPEND | LOCK_EX);
 print('<a href="http://bbsn.ca/BGLEntries.txt"> View Entries </a><br><a href="http://bbsn.ca/bgltest.html"> Go Back </a>');
?>
