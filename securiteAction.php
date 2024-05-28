<?php
session_start(); // Démarre une nouvelle session ou reprend une session existante
// Vérifie si l'utilisateur est connecté, sinon redirige vers la page de connexion
if(!isset($_SESSION['auth'])){
    header('Location: https://localhost/ForumSite/connexion/connexion.php');
}
?>