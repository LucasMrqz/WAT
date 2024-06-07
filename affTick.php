<?php       
   require_once './co_bdd.php';
      $query = $lien->prepare("SELECT numTicket, categorieticket.idCat , titre, description, dateCreation, utilisateur.idUtilisateur FROM ticket INNER JOIN utilisateur ON utilisateur.idUtilisateur = ticket.idUtilisateur INNER JOIN categorieticket ON categorieticket.idCat = ticket.idCat");
      $query->execute();
      $resultats = $query->fetchAll(PDO::FETCH_ASSOC);

      echo json_encode($resultats);
?> 