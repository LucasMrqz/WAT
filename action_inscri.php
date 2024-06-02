<?php
require_once './co_bdd.php';

// Validation du Formulaire
if (isset($_POST['boutonInscription'])) {
    // Vérifier si l'utilisateur a bien complété tous les champs
    if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['mail']) && isset($_POST['motdepasse']) && isset($_POST['tel'])) {
        echo 'brj';
        // Les données de l'utilisateur
        $utilisateur_nom = json_decode(htmlspecialchars($_POST['nom']), true);
        $utilisateur_prenom = json_decode(htmlspecialchars($_POST['prenom']), true);
        $utilisateur_mail = json_decode(htmlspecialchars($_POST['mail']), true);
        $utilisateur_tel = json_decode(htmlspecialchars($_POST['tel']), true);
        $mdp = json_decode(htmlspecialchars($_POST['motdepasse']), true);
        $mdpHash = hash('sha256',$mdp);
        
        echo 'slt';
            // Vérifier si l'utilisateur existe déjà sur le site
            $utilisateurExistant = $lien->prepare('SELECT email FROM utilisateur WHERE email = ?');
            $utilisateurExistant->execute(array($utilisateur_mail));
            
            if ($utilisateurExistant->rowCount() == 0) {
        echo 'cc';
                // Insérer l'utilisateur dans la bdd
                $creerUtilisateur = $lien->prepare('INSERT INTO utilisateur (nom, prenom, email, telephone, mdp) VALUES (?, ?, ?, ?, ?)');
                $creerUtilisateur->execute(array($utilisateur_nom, $utilisateur_prenom, $utilisateur_mail, $utilisateur_tel, $mdpHash));
                
                // Récupérer les informations de l'utilisateur
                $obtenirinfoUtilisateur = $lien->prepare('SELECT * FROM utilisateur WHERE email = ?');
                $obtenirinfoUtilisateur->execute(array($utilisateur_mail));
                $infosUtilisateur = $obtenirinfoUtilisateur->fetch();
        echo 'toi aussi';
                    // Authentifier l'utilisateur sur le site et récupérer ses données dans des sessions
                    $_SESSION['auth'] = true;
                    $_SESSION['id'] = $infosUtilisateur['idUtilisateur'];
                    $_SESSION['nom'] = $infosUtilisateur['nom'];
                    $_SESSION['prenom'] = $infosUtilisateur['prenom'];
                    $_SESSION['mail'] = $infosUtilisateur['email'];
                    $_SESSION['tel'] = $infosUtilisateur['telephone'];
                    
                    // Redirige l'utilisateur vers la page de connexion
                    //header('Location: http://localhost:8080/#/connexion');
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
