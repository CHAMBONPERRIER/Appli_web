<?php

session_start();
include 'Fonctions.php';
include 'ConnexionBd.php';


$requete = "SELECT * FROM fichefrais";
$result = $bd->query($requete);

if (isset ($_SESSION['metier']))
{ 
    if ($_SESSION['metier'] == "comptable") {
?>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link href="style/css/bootstrap.css" rel="stylesheet" />
</head>
<body class="page">
	<div class='container'>
		<section class="row">

			<table class="table">
				<div class="col-xs-12">
					<div class="hpanel">
						<div class="panel-body">
							<div class="col-xs-3">
                            <img class="img-responsive"  src="./images/logo.jpg" id="logoGSB" alt="Laboratoire Galaxy-Swiss Bourdin" title="Laboratoire Galaxy-Swiss Bourdin">
                        </div>

<div class="col-xs-9 ">
							<h1>Gestion des fiches de frais</h1> </div>
						</div>
					</div>
					&nbsp
				</table>
				<div class="col-xs-12">  

					<div class="hpanel3">
						<div class="panel-body">
							<form method="post"> <button type="submit" class="btn btn-danger pull-right" name="deconnexion"></span>&nbsp;Deconnexion&nbsp;&nbsp;</span></button>
							<button type="submit" class="btn btn-info" name="accesGestionDonnee"></span>&nbsp;Accès à la gestion des données&nbsp;&nbsp;</span></button></form>
							<table  class="table">
								<tr>
									<!-- <th><p class="text-error">Id</p></th> -->
									<th><p class="text-error">Tarif (au km)</p></th>
									<th><p class="text-error">Kilometres</p></th>
									<th><p class="text-error">Date</p></th>
									<th><p class="text-error">Total</p></th>
									<th><p class="text-error">Visiteur</p></th>
									<th><p class="text-error">Etat</p></th>
								</tr>


								<?php
								while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
									?>
									<tr>

										<!-- <<td><?php echo $row['ID']; ?></td> -->
										<td>
											<?php
											$query2 = "SELECT PRIX FROM tarifs WHERE ID = '".$row['IDTARIF']."'";
											$result2 = $bd->prepare($query2);
											$result2->execute();
											while ($row2 = $result2->fetch(PDO::FETCH_ASSOC))
											{
												echo $row2['PRIX']."€";

											}
											?>
										</td>
										<td><?php echo $row['KILOMETRES']; ?></td>
										<td><?php echo $row['DATEFICHE']; ?></td>
										<td><?php echo $row['TOTAL']; ?></td>
										<td>
											<?php
											$query2 = "SELECT LOGIN FROM user WHERE ID = '".$row['IDVISITEUR']."'";
											$result2 = $bd->prepare($query2);
											$result2->execute();
											while ($row2 = $result2->fetch(PDO::FETCH_ASSOC))
											{
												echo $row2['LOGIN'];

											}
											?>
										</td>
										<td>
											<form action="#" method="post">
												<div class="col-xs-8">
												<select class="form-control" name="valuelist">;
													<?php
													$requeteetat = "SELECT * FROM etat";
													$resultselect = $bd->query($requeteetat);
													while ($rowselect = $resultselect->fetch(PDO::FETCH_ASSOC)) 
													{ 
														if ($row['IDETAT'] == $rowselect['ID']) {
															echo '<option   value='.$rowselect['ID']. ' selected="selected">'.$rowselect['LIBELLE'].'</option>';
														}
														else
														{
															echo '<option   value='.$rowselect['ID'].'>'.$rowselect['LIBELLE'].'</option>';
														}
													}
													echo "</select>";
													echo "</div>";

													?>

													<?php
													echo '<input type="hidden" name="id" value='.$row['ID'].'>'; 
													?>
													
													<button type="submit" class="btn btn-info" name="Submit"></span>&nbsp;Mettre à jour&nbsp;&nbsp;</button>
													

												</form>
												<?php
												if(isset($_POST['Submit']))
												{
													$sql = "UPDATE fichefrais SET IDETAT = '".$_POST['valuelist']."' where ID = '".$_POST['id']."'";
													$req= $bd->query($sql);
													echo '<script language="Javascript">document.location.replace("http://172.16.9.54/Appli_web/FicheFrais.php");</script>';
												}
												?> 
											</td>
										</tr>
										<?php } ?>
									</table>
								</div>
							</div>
						</diV>
					</section>
				</body>
<?php

}}


if ($_SESSION['metier'] == "visiteur")
{
    echo '<script language="Javascript">document.location.replace("http://172.16.9.54/Appli_web/telechargement.php");</script>';
}

if ($_SESSION['metier'] != "metier" && $_SESSION['metier'] != "comptable")
{
	echo '<script language="Javascript">document.location.replace("http://172.16.9.54/Appli_web/Index.php");</script>';
}

if(isset($_POST['deconnexion']))
{
    deconnexion();
}

if(isset($_POST['accesGestionDonnee']))
{
    echo '<script language="Javascript">document.location.replace("http://172.16.9.54/Appli_web/Accueil.php");</script>';
}

?>


