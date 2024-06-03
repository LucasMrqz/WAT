<?php       
   require_once './co_bdd.php';
   $query = $lien->prepare("SELECT numTicket ,idCat , titre, description, dateCreation ,idUtilisateur FROM ticket INNER JOIN utilisateur ON utilisateur.idUtilisateur = ticket.idUtilisateur INNER JOIN categorieticket ON categorieticket.idCat = ticket.idCat");
   $query->execute();
?> 