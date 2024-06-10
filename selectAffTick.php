<?php
require_once './co_bdd.php';

if (isset($_POST['valider'])){
    if (isset($_POST['cat'])){
            $idCat = $_POST['cat'];
        
            $selectCat = $lien->prepare("SELECT * FROM categorieTicket WHERE idCat = ?");
            $selectCat->execute(array($idCat));
            $ok = $selectCat->fetch();

            $selectTicket = $lien->prepare("SELECT * FROM ticket INNER JOIN categorieticket ON ticket.idCat = categorieticket.idCat WHERE categorieticket.idCat = ?");
            $selectTicket->execute(array($idCat));

            header('Location: http://localhost:8080/#/affTickAdmin');
            //header('Location: https://wat.alwaysdata.net/#/affTickAdmin');
    }
}
?>