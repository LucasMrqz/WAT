<!DOCTYPE html>
    <?php 
        require_once './co_bdd.php';
    ?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Accueil tikcets</title>
    </head>
    <body>
        <input type="text">
        <?php
            $query = $lien->prepare("SELECT * FROM ticket");
            $query->execute();

            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>"
                    ."<td> {$row['numTicket']} </td>
                    <td> {$row['titre']} </td>
                    <td> {$row['description']} </td>
                    <td> {$row['dateCreation']} </td>
                    <td><a href='delete_enseignant.php?id=".$row['id_ticket']."' id='btn1'>Supprimer</a></td>
                    </tr>\n";
            }
            echo "</table>";
        ?>
    </body>
</html>