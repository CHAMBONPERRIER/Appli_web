<html>
<?php

session_start();
include 'Fonctions.php';



connexion($identifiant,$motdepasse,$bd);

if (isset($_SESSION['login']) && isset ($_SESSION['password']))
{
    header('Location: http://localhost/frais_kilometriques/Accueil.php');
    exit();
}
else {
    echo "Pas de session";
        
    
}
?>
</html>