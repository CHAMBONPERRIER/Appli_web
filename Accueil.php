<?php
session_start();
include 'Fonctions.php';
$bd = new PDO('mysql:host=localhost;dbname=gsb', 'root','');
?>


<head>
    <title>Accueil</title>
    <meta charset="utf-8">
    <link href="style/css/bootstrap.css" rel="stylesheet" />
</head>

<!-- ****************************************** Script d'affichage données/formulaire de modification *************************************** -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $(".form").hide();   
        $(".glyphicon-pencil").click(function()
        {
            $(".donnee").hide();
            $(".glyphicon-pencil").hide();

            //var idJS = $( "td" ).attr( "id" );
            //alert(idJS);
            //$("#$idJS.form").show();
            $(".form").show();
        });
    });
</script>

<!-- ****************************************************************** Corps ***************************************************************** -->

<body class="page">
    <div class='container'>

        <!-- Présentation -->
        <section class="row">
            <div class="col-xs-12">
                <div class="hpanel2">
                    <div class="panel-body">
                        <div class="col-xs-3">
                            <img class="img-responsive"  src="./images/logo.jpg" id="logoGSB" alt="Laboratoire Galaxy-Swiss Bourdin" title="Laboratoire Galaxy-Swiss Bourdin">
                        </div>

                        <div class="col-xs-9 ">
                            <h1>Page de remboursement des frais kilométriques</h1>                         
                        </div>

                    </div>

                </div>
                &nbsp

            </div>

            <?php
            // ***************************************************** Affichage du tableau puissance ***************************************************** 
            $query = "SELECT * FROM puissance";
            $result = $bd->query($query);
            ?>

            <div class="panel-body">
                <div class="col-xs-10">             
                    <div class="hpanel3">
                        <div class="panel-body">
                            <table class="table">
                                <div class="panel-body">
                                    <div class="col-xs-9 ">
                                        <h3>Puissance</h3>                         
                                    </div>

                                </div>
         
                                <thead class="thead-inverse">
                                    <tr>
                                        <th><p class="text-error">Libelle</p></th>
                                        <th><p class="text-error">Modifier</p></th>
                                        <th><p class="text-error">Supprimer</p></th>
                                    </tr>

                                </thead>
             
                                <?php
                                while ($row = $result->fetch(PDO::FETCH_ASSOC))
                                { ?>
                                    <tr>

                                        <td class="donnee"><?php echo $row['LIBELLE']; ?></td>
                                        <?php echo '<td class="form" id='.$row['ID']."";?>
                                        <td class="form" id="">
                                            <form method="post">   
                                                <input type="text" placeholder="Libelle" class="form-control" required="" aria-required="true" name="libelleModif" value=<?php echo "'".$row['LIBELLE']."'" ?>>       
                                        </td>

                                        <td class="form">
                                                <button type="submit" class="btn btn-info" name="submitEditPuissance"></span>&nbsp;Valider&nbsp;&nbsp;<span class="glyphicon glyphicon-chevron-right" ></span></button>
                                                <?php echo '<input type="hidden" name="idTabPuissance" value='.$row['ID'].'>'; ?>                            
                                        </td>

                                        <td class="donnee"><button type='button' class="glyphicon glyphicon-pencil"></button></td>
                                        <td><button type='submit' class="glyphicon glyphicon-remove" name="submitDeletePuissance"></button></td>
                                            </form>

                                <?php } ?>

                                    </tr>

                            </table>

                            <form method="post">
                                <div class="form-group">
                                    <input type="text" placeholder="Libelle" class="form-control" required="" aria-required="true" name="libellePuissance">
                                    <button type="submit" class="btn btn-info" name="submitPuissance"></span>&nbsp;Ajouter&nbsp;&nbsp;<span class="glyphicon glyphicon-chevron-right" ></span></button>
                                </div>
                            </form><br/>
                     
                            <?php
                            // ***************************************************** Affichage du tableau carburant ***************************************************** 
                            $query = "SELECT * FROM carburant";
                            $result = $bd->query($query);
                            ?>

                            <table class="table">
                                <div class="panel-body">
                                    <div class="col-xs-9 ">
                                        <h3>Carburant</h3>                         
                                    </div>

                                </div>
                                
                                <tr>
                                    <th><p class="text-error">Libelle</p></th>
                                    <th><p class="text-error">Modifier</p></th>
                                    <th><p class="text-error">Supprimer</p></th>
                                </tr>

                                <?php
                                while ($row = $result->fetch(PDO::FETCH_ASSOC))
                                {?>
                                    <tr>
                                        <td class="donnee"><?php echo $row['LIBELLE']; ?></td> 
                                        <td class="form">
                                            <form method="post">   
                                                <input type="text" placeholder="Libelle" class="form-control" required="" aria-required="true" name="libelleModif" value=<?php echo "'".$row['LIBELLE']."'" ?>>       

                                        </td>
                                        <td class="form">
                                                <button type="submit" class="btn btn-info" name="submitEditCarburant"></span>&nbsp;Valider&nbsp;&nbsp;<span class="glyphicon glyphicon-chevron-right" ></span></button>
                                                <?php echo '<input type="hidden" name="idTabCarburant" value='.$row['ID'].'>';  ?>
                                            
                                        </td>

                                        <td class="donnee"><button type='button' class="glyphicon glyphicon-pencil"></button></td>
                                        <td><button type='submit' class="glyphicon glyphicon-remove" name="submitDeleteCarburant"></button></td>
                                            </form>
                                        
                                <?php } ?>

                                    </tr>

                            </table>

                            <form method="post">
                                <div class="form-group">
                                    <input type="text" placeholder="Libelle" class="form-control" required="" aria-required="true" name="libelleCarburant">
                                    <button type="submit" class="btn btn-info" name="submitCarburant"></span>&nbsp;Ajouter&nbsp;&nbsp;<span class="glyphicon glyphicon-chevron-right" ></span></button>
                                </div>

                            </form>

                            <?php
                            // ***************************************************** Affichage du tableau tarif ***************************************************** 
                            $query = "SELECT * FROM tarifs";
                            $result = $bd->query($query);
                            ?>

                            <table class="table">
                                <div class="panel-body">
                                    <div class="col-xs-9 ">
                                        <h3>Tarifs</h3>                         
                                    </div>

                                </div>
                               
                                <tr>
                                    <th><p class="text-error">Prix</p></th>
                                    <th><p class="text-error">Carburant</p></th>
                                    <th><p class="text-error">Puissance</p></th>
                                    <th><p class="text-error">Modifier</p></th>
                                    <th><p class="text-error">Supprimer</p></th>
                                </tr>

                                <?php

                                while ($row = $result->fetch(PDO::FETCH_ASSOC))
                                { ?>
                                    <tr>
                                        <td><?php echo $row['PRIX']; ?></td> 

                                        <?php
                                        $query2 = "SELECT LIBELLE FROM carburant WHERE ID = ".$row['IDCARBURANT'];
                                        $result2 = $bd->query($query2);
                                        while ($row2 = $result2->fetch(PDO::FETCH_ASSOC))
                                        {
                                            echo '<td class="donnee">';
                                            echo $row2['LIBELLE'];
                                            echo "</td>";
                                        }

                                        $query3 = "SELECT LIBELLE FROM puissance WHERE ID = ".$row['IDPUISSANCE'];
                                        $result3 = $bd->query($query3);
                                        while ($row3 = $result3->fetch(PDO::FETCH_ASSOC))
                                        {
                                            echo '<td class="donnee">';
                                            echo $row3['LIBELLE'];
                                            echo "</td>";
                                        } ?>

                                        <td class="donnee"><button type='button' class="glyphicon glyphicon-pencil"></button></td>
                                        <td class="form">
                                            <form method="post"> 

                                        <?php
                                        echo "</td>";

                                        echo '<td class="form">';
                                        ?>   

                                        </td>

                                        <td class="form">
                                                <button type="submit" class="btn btn-info" name="submitEditTarif"></span>&nbsp;Valider&nbsp;&nbsp;<span class="glyphicon glyphicon-chevron-right" ></span></button>
                                                <?php echo '<input type="hidden" name="idTabTarif" value='.$row['ID'].'>'; ?>                            
                                        </td>

                                        <td><button type='submit' class="glyphicon glyphicon-remove" name="submitDeleteTarif"></button></td>
                                            </form>
                                <?php } ?>

                                    </tr>

                            </table>

                            <form method="post">
                                <div class="form-group">    
                                    <?php

                                    //Affichage de la première liste déroulante : Carburant
                                    echo "<select class='form-control' name='libelleCarburantT'>";
                                        echo "<option>Selectionner un carburant</option>";

                                        $query = "SELECT * FROM Carburant";
                                        $result = $bd->query($query);
                                        while ($row = $result->fetch(PDO::FETCH_ASSOC))
                                        {
                                            echo "<option value=".$row['LIBELLE'].">".$row['LIBELLE']."</option>";
                                        }
                                    echo "</select>";


                                    //Affichage de la deuxième liste déroulante : Puissance
                                    echo "<select class='form-control' name='libellePuissanceT'>";
                                        echo "<option>Selectionner une puissance</option>";

                                        $query = "SELECT * FROM puissance";
                                        $result = $bd->query($query);
                                        while ($row = $result->fetch(PDO::FETCH_ASSOC))
                                        {
                                            echo "<option value=".$row['LIBELLE'].">".$row['LIBELLE']."</option>";
                                        }
                                    echo "</select>";
                                    ?>

                                    <input type="text" placeholder="Prix" class="form-control" required="" aria-required="true" name="prix">
                                    <button type="submit" class="btn btn-info" name="submitTarif"></span>&nbsp;Ajouter&nbsp;&nbsp;<span class="glyphicon glyphicon-chevron-right" ></span></button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>


<!-- ***************************************************** Appel des fonctions suivant l'action de l'utilisateur ***************************************************** -->

<?php
// Action Ajouter, Modifier, Supprimer

// ************************************************************ Ajouter ************************************************************ 
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

else if(isset($_POST['submitTarif']))
{
    $idTableau = "tarifs";

    $carburant = $_POST['libelleCarburantT'];
    $query = "SELECT ID FROM carburant WHERE LIBELLE='$carburant'";
    $carburant2 = $bd->query($query);

    $puissance = $_POST['libellePuissanceT'];
    $query = "SELECT ID FROM puissance WHERE LIBELLE='$puissance'";
    $puissance2 = $bd->query($query);

    $prix = $_POST['prix'];
    AddLigneTarif($idTableau, $carburant2, $puissance2, $prix, $bd);
}

// ************************************************************ Modifier ************************************************************ 
if(isset($_POST['submitEditCarburant']))
    {
        $sql = "UPDATE carburant SET LIBELLE = '".$_POST['libelleModif']."' where ID = ".$_POST['idTabCarburant']."";
        $reqTest= $bd->query($sql);
        echo '<script language="Javascript">document.location.replace("http://localhost/Appli_web/Accueil.php");</script>';
    }

if(isset($_POST['submitEditPuissance']))
    {
        $sql = "UPDATE puissance SET LIBELLE = '".$_POST['libelleModif']."' where ID = ".$_POST['idTabPuissance']."";
        $reqTest= $bd->query($sql);
        echo '<script language="Javascript">document.location.replace("http://localhost/Appli_web/Accueil.php");</script>';
    }

// ************************************************************ Supprimer ************************************************************ 

if(isset($_POST['submitDeleteCarburant']))
{
    $sql = "DELETE FROM carburant WHERE ID = ".$_POST['idTabCarburant']."";
    var_dump($sql);
    $reqTest= $bd->query($sql);
    echo '<script language="Javascript">document.location.replace("http://localhost/Appli_web/Accueil.php");</script>';
}

if(isset($_POST['submitDeletePuissance']))
    {
        $sql = "DELETE FROM puissance WHERE ID = ".$_POST['idTabPuissance']."";
        $reqTest= $bd->query($sql);
        echo '<script language="Javascript">document.location.replace("http://localhost/Appli_web/Accueil.php");</script>';
    }

if(isset($_POST['submitDeleteTarif']))
    {
        $sql = "DELETE FROM tarifs WHERE ID = ".$_POST['idTabTarif']."";
        $reqTest= $bd->query($sql);
        echo '<script language="Javascript">document.location.replace("http://localhost/Appli_web/Accueil.php");</script>';
    }


//q=$connexion->prepare($sql);
    //$q->bindValue('id',1);
    //$q->execute();
    //$sql="WHERE ID=id"


?>