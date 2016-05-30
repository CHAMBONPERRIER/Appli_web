<?php
function connexion($identifiant,$motdepasse,$bd)
{
    $query= ("SELECT mdp FROM user WHERE login  = :identifiant");        
    $statement = $bd->prepare($query);
    $statement->execute(array('identifiant'=>$identifiant)); 
    $data = $statement->fetch(PDO::FETCH_ASSOC);

    if ($data['mdp'] !=$motdepasse) 
    {
        echo "Erreur de connection, v&eacute;rifiez votre syntaxe";
    }
    else {
        $_SESSION['login']= $identifiant;

        $queryMetier = ("SELECT METIER FROM user WHERE login = :login");
        $statementMetier = $bd->prepare($queryMetier);
        $statementMetier->execute(array('login'=>$_SESSION['login']));
        $dataMetier = $statementMetier->fetch(PDO::FETCH_ASSOC);

        $_SESSION['metier'] = $dataMetier['METIER'];


        if ($_SESSION['metier'] == "comptable")
        {
            echo '<script language="Javascript">document.location.replace("http://172.16.9.54/Appli_web/Accueil.php");</script>';
        }
        else
        {
            echo '<script language="Javascript">document.location.replace("http://172.16.9.54/Appli_web/Telechargement.php");</script>';
        }

    }
}

function deconnexion ()
{
    session_unset ();
    session_destroy();
    echo '<script language="Javascript">document.location.replace("http://172.16.9.54/Appli_web/index.php");</script>';
}
?>