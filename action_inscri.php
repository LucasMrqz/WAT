<?php
session_start();
require_once './co_bdd.php';

// Validation du Formulaire
if (isset($_POST['boutonInscription'])) {
    // Vérifier si l'utilisateur a bien complété tous les champs
    if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['mail']) && isset($_POST['motdepasse']) && isset($_POST['tel'])) {
        // Les données de l'utilisateur
        $utilisateur_nom = htmlspecialchars($_POST['nom']);
        $utilisateur_prenom = htmlspecialchars($_POST['prenom']);
        $utilisateur_mail = htmlspecialchars($_POST['mail']);
        $utilisateur_tel = htmlspecialchars($_POST['tel']);
        $mdp = htmlspecialchars($_POST['motdepasse']);
        $mdpHash = hash('sha256',$mdp);
        
        
            // Vérifier si l'utilisateur existe déjà sur le site
            $utilisateurExistant = $lien->prepare('SELECT email FROM technicien WHERE email = ?');
            $utilisateurExistant->execute(array($utilisateur_mail));
            
            if ($utilisateurExistant->rowCount() == 0) {
        echo 'cc';
                // Insérer l'utilisateur dans la bdd
                $creerUtilisateur = $lien->prepare('INSERT INTO technicien (nom, prenom, email, telephone, mdp) VALUES (?, ?, ?, ?, ?)');
                $creerUtilisateur->execute(array($utilisateur_nom, $utilisateur_prenom, $utilisateur_mail, $utilisateur_tel, $mdpHash));
                
                // Récupérer les informations de l'utilisateur
                $obtenirinfoUtilisateur = $lien->prepare('SELECT * FROM technicien WHERE email = ?');
                $obtenirinfoUtilisateur->execute(array($utilisateur_mail));
                $infosUtilisateur = $obtenirinfoUtilisateur->fetch();
        echo 'toi aussi';
                    // Authentifier l'utilisateur sur le site et récupérer ses données dans des sessions
                    $_SESSION['auth'] = true;
                    $_SESSION['id'] = $infosUtilisateur['idTechnicien'];
                    $_SESSION['nom'] = $infosUtilisateur['nom'];
                    $_SESSION['prenom'] = $infosUtilisateur['prenom'];
                    $_SESSION['mail'] = $infosUtilisateur['email'];
                    $_SESSION['tel'] = $infosUtilisateur['telephone'];
                    
                    // Redirige l'utilisateur vers la page de connexion
                    header('Location: http://localhost:8080/#/connexion');
                    //header('Location: https://wat.alwaysdata.net/#/connexion');
                    exit();
                } else {
                    $errorMsg = "Erreur lors de la récupération des informations utilisateur.";
                }
            } else {
                $errorMsg = "L'utilisateur existe déjà avec cet e-mail.";
            }
    } else {
        $errorMsg = "Veuillez compléter tous les champs.";
    }
?>
