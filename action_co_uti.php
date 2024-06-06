<?php
require_once './co_bdd.php';

if (isset($_POST['boutonConnexion'])) {
    if (!empty($_POST['mail']) && !empty($_POST['motdepasse'])) {
        $utilisateur_mail = htmlspecialchars($_POST['mail']);
        $mdp = htmlspecialchars($_POST['motdepasse']);
        $mdpHash = hash('sha256',$mdp);
        
        // Requête SQL pour récupérer l'utilisateur par email
        $utilisateurExistant = $lien->prepare('SELECT * FROM utilisateur WHERE email = ?');
        $utilisateurExistant->execute(array($utilisateur_mail));
        
        // Vérifier que l'utilisateur existe
        if ($utilisateurExistant->rowCount() > 0) {
            $infosUtilisateur = $utilisateurExistant->fetch();
           
            // Vérification du mot de passe
            if ($mdpHash == $infosUtilisateur['mdp']) {
                $_SESSION['auth'] = true;
                $_SESSION['id'] = $infosUtilisateur['idUtilisateur'];
                $_SESSION['nom'] = $infosUtilisateur['nom'];
                $_SESSION['prenom'] = $infosUtilisateur['prenom'];
                $_SESSION['mail'] = $infosUtilisateur['email'];
                
                // Rediriger vers la page d'accueil
                //header('Location: http://localhost:8080/#/');
                header('Location: https://wat.alwaysdata.net/#/');
                exit();
                
            } else {
                $errorMsg = "Votre mot de passe est incorrect";
            }
        } else {
            $errorMsg = "Votre email est incorrect";
        }
    } else {
        $errorMsg = "Veuillez compléter tous les champs";
    }
}
?>
