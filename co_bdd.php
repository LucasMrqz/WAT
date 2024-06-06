<?php
try{
//$lien = new PDO('mysql:host=localhost;dbname=ticket','root','');
$lien = new PDO('mysql:host=mysql-wat.alwaysdata.net;dbname=wat_wat','wat','Lm13013*mrs');
$lien->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e)
{
  die("Une érreur a été trouvé : " . $e->getMessage());
}

?>

