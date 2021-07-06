<?php
$dsn='mysql:host=localhost;dbname=fpo';
$connectingdb=new PDO($dsn,'root','');
//with this $connectingdb VARIABLE we can do CRUD methods

if ($connectingdb) {
  //echo "connected successfully to fpo db";
  // code...
}else {
  die("not connectedn".mysql_connect_error());
}

 ?>
