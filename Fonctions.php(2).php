<html>
<?php

$bd = new PDO('mysql:host=localhost;dbname=gsb', 'root','');

function connexion($identifiant,$motdepasse,$bd)
{
    $query= ("SELECT amdp FROM user WHERE login='$identifiant'");
    $result = $bd->query($query);
    $data = $result->fetch(PDO::FETCH_ASSOC);

    if ($data['amdp'] !=$motdepasse) 
    {
        echo "Erreur de connection, v&eacute;rifiez votre syntaxe";
    }
    else {
        $_SESSION['login']= $identifiant;
        $_SESSION['password']=$motdepasse;
        header ('location: http://localhost/frais_kilometriques/Accueil.php');
    }

}

function deconnexion ()
{
    session_unset ();
    session_destroy();
    header ('location: http://localhost/frais_kilometriques/Connexion.php');
}



?>
</html>