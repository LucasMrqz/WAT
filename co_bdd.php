<?php
try{
$lien = new PDO('mysql:host=localhost;dbname=ticket','root','');
$lien->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e)
{
  die("Une érreur a été trouvé : " . $e->getMessage());
}

?>

