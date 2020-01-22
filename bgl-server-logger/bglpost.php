<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<body>
<?php 
  $content = $_POST['total'];
  $contstr = strlen($content); 
  if ($constr > '160') {
    echo $content;
} else {
    $myfile = file_put_contents('BGLLog.html', $content.PHP_EOL , FILE_APPEND | LOCK_EX);
    print('<a href="BGLLog.html"> View Entries </a><br><a href="/"> Go Back </a>');
}

?>
</body>
</head>
</html>
