<?php
require_once './co_bdd.php';

// Validation du Formulaire
if (isset($_POST['boutonInscription'])) {
    // Vérifier si l'utilisateur a bien complété tous les champs
    if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['mail']) && !empty($_POST['motdepasse'])&& !empty($_POST['tel'])) {
        echo 'brj';
        // Les données de l'utilisateur
        $utilisateur_nom = json_decode(htmlspecialchars($_POST['nom']), true);
        $utilisateur_prenom = json_decode(htmlspecialchars($_POST['prenom']), true);
        $utilisateur_mail = json_decode(htmlspecialchars($_POST['mail']), true);
        $utilisateur_tel = json_decode(htmlspecialchars($_POST['tel']), true);
        $mdp = json_decode(htmlspecialchars($_POST['motdepasse']), true);
        $mdpHash = hash('sha256',$mdp);
        
        try {
        echo 'slt';
            // Vérifier si l'utilisateur existe déjà sur le site
            $utilisateurExistant = $bdd->prepare('SELECT email FROM utilisateur WHERE email = ?');
            $utilisateurExistant->execute([$utilisateur_mail]);
            
            if ($utilisateurExistant->rowCount() == 0) {
        echo 'suce';
                // Insérer l'utilisateur dans la bdd
                $creerUtilisateur = $bdd->prepare('INSERT INTO utilisateur (nom, prenom, email, telephone,  mdp) VALUES (?, ?, ?, ?, ?)');
                $creerUtilisateur->execute([$utilisateur_nom, $utilisateur_prenom, $utilisateur_mail, $utilisateur_tel, $mdpHash]);
                
                // Récupérer les informations de l'utilisateur
                $obtenirinfoUtilisateur = $bdd->prepare('SELECT * FROM utilisateur WHERE email = ?');
                $obtenirinfoUtilisateur->execute([$utilisateur_mail]);
                $infosUtilisateur = $obtenirinfoUtilisateur->fetch();
                
                if ($infosUtilisateur) {
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
        } catch (PDOException $e) {
            $errorMsg = "Erreur lors de la connexion à la base de données : " . $e->getMessage();
        }
    } else {
        $errorMsg = "Veuillez compléter tous les champs.";
    }
}
?>
