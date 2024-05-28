<!DOCTYPE html>
<html lang="fr">
    
    <!-- La ligne suivante est inutile car vous n'utilisez pas de PHP ici. 
    <?php 
        require_once './inscriptionAction.php'; 
    ?> 
    -->
<head>
  
  <link rel="stylesheet" href="../styleconnexion.css"/>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Inscription</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
</head>
<body>
    <form method="POST">    
    <h1>Inscription</h1> 
    
    <div class="inputs">
      <input type="text" name="nom" placeholder="Nom" required style="text-align: center;">
      <input type="text" name="prenom" placeholder="Prenom" required style="text-align: center;">
      <input type="email" id="mail" name="mail" placeholder="Adresse Mail (ex : exemple@exemple.fr)" required style="text-align: center;">
      <input type="tel" id="TelephoneUti" name="TelephoneUti" placeholder="Entrez votre numéro de téléphone (ex : 06-12-34-56-78)" pattern="[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}" required style="text-align: center;"/>
      <input type="password" name="motdepasse" minlength="8" placeholder="Mot de passe" required style="text-align: center;">
    </div>
    <?php if(!empty($errorMsg)) { echo '<p class="error">' . $errorMsg . '</p>'; } ?>
    <p class="inscription">J'ai déjà un <span>compte</span>. Je me <span><a id="lieninscription" href="connexion.php">connecte.</a></span></p>

    <div>
      <button type="submit" name="boutonInscription">S'inscrire</button>
    </div>
  </form>
</body>
</html>
