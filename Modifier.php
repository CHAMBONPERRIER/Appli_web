<link href="style/css/bootstrap.css" rel="stylesheet" />

<?php
session_start();
include 'Fonctions.php';
$bd = new PDO('mysql:host=localhost;dbname=gsb', 'root','');



// *****************************************************Affichage du tableau puissance***************************************************** 
$query = "SELECT * FROM puissance";
$result = $bd->query($query);
?>

<table class="table">
    <caption>Puissance</caption>
    <tr>
        <th><p class="text-error">Id</p></th>
        <th><p class="text-error">Libelle</p></th>
        <th><p class="text-error">Modifier</p></th>
        <th><p class="text-error">Supprimer</p></th>
    </tr>

    <?php
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {?>
        <tr>
             <td><?php echo $row['ID']; ?></td>

            <!-- Si l'id de la ligne à afficher ne correspond pas à l'ID de la ligne que l'on souhaite modifier, on laisse l'affichage opérer -->
            <?php
            if ($row['ID'] != $_GET["id"] || $_GET["idTableau"] == "carburant")
            {
                echo "<td>";
                echo $row['LIBELLE'];
                echo '<td><a href="Modifier.php?idTableau=puissance&id='.$row['ID'].'">Modifier</a></td>';
                echo "</td>";
            }

            // Sinon, on affiche à la place le formulaire de modification directement à la place de la ligne
            else { ?>
                <td>
                    <form method="post">   
                        <div class="form-group">
                            <input type="text" placeholder="Libelle" class="form-control" required="" aria-required="true" name="libelleModif">
                </td>  
                <td>
                            <button type="submit" class="btn btn-info" name="submitEdit"></span>&nbsp;Valider&nbsp;&nbsp;<span class="glyphicon glyphicon-chevron-right" ></span></button>
                        </div>
                </td>
                    </form>
            <?php } ?>

            <td><?php echo '<a href="Accueil.php?action=delete&table=puissance&id='.$row['ID'].'">Supprimer</a>'; ?></td> 
    <?php } ?>                                    
        </tr>
</table>


<form method="post">
    <div class="form-group">
        <input type="text" placeholder="Libelle" class="form-control" required="" aria-required="true" name="libellePuissance">
        <button type="submit" class="btn btn-info" name="submitPuissance"></span>&nbsp;Ajouter&nbsp;&nbsp;<span class="glyphicon glyphicon-chevron-right" ></span></button>
    </div>
</form><br/>

<!-- *****************************************************Affichage du tableau carburant***************************************************** -->

<?php
$query = "SELECT * FROM carburant";
$result = $bd->query($query);
?>

<table class="table">
    <caption>Carburant</caption>
    <tr>
        <th><p class="text-error">Id</p></th>
        <th><p class="text-error">Libelle</p></th>
        <th><p class="text-error">Modifier</p></th>
        <th><p class="text-error">Supprimer</p></th>
    </tr>
    <?php

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>";
        echo $row['ID'];
        echo "</td>";

        if ($row['ID'] != $_GET["id"] || $_GET["idTableau"] == "puissance")
        {
            echo "<td>";
            echo $row['LIBELLE'];
            echo '<td><a href="Modifier.php?idTableau=carburant&id='.$row['ID'].'">Modifier</a></td>';
            echo "</td>";
        }
        else
        { ?>                
            <td>
                <form method="post">   
                    <div class="form-group">
                        <input type="text" placeholder="Libelle" class="form-control" required="" aria-required="true" name="libelleModif">
            </td> 
            <td>        <button type="submit" class="btn btn-info" name="submitEdit"></span>&nbsp;Valider&nbsp;&nbsp;<span class="glyphicon glyphicon-chevron-right" ></span></button>
                    </div>
            </td>
                </form>
        <?php }    
        echo '<td><a href="Accueil.php?action=delete&table=carburant&id='.$row['ID'].'">Supprimer</a>';
        echo "</td>";
    }?>                                
    </tr>
</table>


<form method="post">
    <div class="form-group">
        <input type="text" placeholder="Libelle" class="form-control" required="" aria-required="true" name="libelleCarburant">
        <button type="submit" class="btn btn-info" name="submitCarburant"></span>&nbsp;Ajouter&nbsp;&nbsp;<span class="glyphicon glyphicon-chevron-right" ></span></button>
    </div>
</form><br/>

<!-- *****************************************************Affichage du tableau tarif***************************************************** -->

<?php
$query = "SELECT * FROM tarifs";
$result = $bd->query($query);
?>

<table class="table">
    <caption>Tarifs</caption>
    <tr>
        <th><p class="text-error">Id</p></th>
        <th><p class="text-error">Prix</p></th>
        <th><p class="text-error">Id carburant</p></th>
        <th><p class="text-error">Id puissance</p></th>
        <th><p class="text-error">Modifier</p></th>
        <th><p class="text-error">Supprimer</p></th>
    </tr>
    <?php

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {?>
        <tr>
            <td><?php echo $row['ID']; ?></td>
            <td><?php echo $row['PRIX']; ?></td> 
            <td><?php echo $row['IDCARBURANT']; ?></td>                                    
            <td><?php echo $row['IDPUISSANCE']; ?> </td>
            <td><?php echo '<a href="Accueil.php?action=edit&table=tarifs&id='.$row['ID'].'">Modifier</a>'; ?></td>
            <td><?php echo '<a href="Accueil.php?action=delete&table=tarifs&id='.$row['ID'].'">Supprimer</a>'; ?></td>
    <?php } ?>                                    
        </tr>
</table><br/>


<?php
// Action Edit, Delete, Add

// Edit  Delete
if (isset($_GET["action"]) != "")
{
    $action = $_GET["action"];
    $idTableau = $_GET["table"];
    $idLigne = $_GET["id"];

   /*  if ($action == "edit")
    {
        editLigne($idTableau, $idLigne, $bd);
    } */ 
    /* else */  if ($action == "delete")
    {
        deleteLigne($idTableau, $idLigne, $bd);
    }
}

// Add
if(isset($_POST['submitPuissance']))
{
    $idTableau = "puissance";
    $libelle= $_POST['libellePuissance'];

    AddLigne($idTableau, $libelle, $bd);
}

else if(isset($_POST['submitCarburant']))
{
    $idTableau = "carburant";
    $libelle= $_POST['libelleCarburant'];
    AddLigne($idTableau, $libelle, $bd);
}


if(isset($_POST['submitEdit']))
{
    $idTableau = $_GET['idTableau'];
    $idLigne = $_GET['id'];
    $libelle= $_POST['libelleModif'];

    editLigne($idTableau, $idLigne, $libelle, $bd);
}
?>

