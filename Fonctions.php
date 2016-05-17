<?php
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
        header ('location: http://localhost/Appli_web/Accueil.php');
    }
}

function deconnexion ()
{
    session_unset ();
    session_destroy();
    echo '<script language="Javascript">document.location.replace("http://localhost/Appli_web/index.php");</script>';
}

function deleteLigne($idTableau, $idLigne, $bd)
{
    $query= ("DELETE FROM $idTableau WHERE ID = $idLigne");
    $req= $bd->query($query);
    echo '<script language="Javascript">document.location.replace("http://localhost/Appli_web/Accueil.php");</script>';
}

function editLigne($idTableau, $idLigne, $libelle, $bd)
{
    $query= ("UPDATE $idTableau SET LIBELLE = '$libelle' WHERE ID = $idLigne");
    $req= $bd->query($query);
    echo '<script language="Javascript">document.location.replace("http://localhost/Appli_web/Accueil.php");</script>';
}

function AddLigne($idTableau, $libelle, $bd)
{
    $query=("INSERT INTO $idTableau(ID, LIBELLE) VALUES ('', '$libelle')");
    $req= $bd->query($query);
    echo '<script language="Javascript">document.location.replace("http://localhost/Appli_web/Accueil.php");</script>';
}

function AddLigneTarif($idTableau, $carburant2, $puissance2, $prix, $bd)
{
    while ($row = $carburant2->fetch(PDO::FETCH_ASSOC))
    {
        $idCarburant = $row['ID']; 
    }

    while ($row = $puissance2->fetch(PDO::FETCH_ASSOC))
    {
        $idPuissance = $row['ID']; 
    }

    $query=("INSERT INTO $idTableau(ID, PRIX, IDCARBURANT, IDPUISSANCE) VALUES ('', '$prix', '$idCarburant', '$idPuissance')");
    $req= $bd->query($query);
    echo '<script language="Javascript">document.location.replace("http://localhost/Appli_web/Accueil.php");</script>';
}
?>