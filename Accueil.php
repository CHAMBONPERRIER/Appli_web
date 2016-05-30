<?php
session_start();
include 'Fonctions.php';
include 'ConnexionBd.php';

if (isset ($_SESSION['metier'])) // Check if the user is connected to the website
{ 
	if ($_SESSION['metier'] == "comptable") // Check if the user is "comptable" or not to adapt the access
	{?>

		<!-- ****************************************************************** Header ***************************************************************** -->
		<head>
			<title>Accueil</title>
			<meta charset="utf-8">
			<link href="style/css/bootstrap.css" rel="stylesheet" />
		</head>

		<!-- ****************************************************************** Body ***************************************************************** -->
		<body class="page">
			<div class='container'>
				<section class="row">
					<div class="col-xs-12">
						<div class="hpanel">
							<div class="panel-body">
								<div class="col-xs-3">
									<img class="img-responsive"  src="./images/logo.jpg" id="logoGSB" alt="Laboratoire Galaxy-Swiss Bourdin" title="Laboratoire Galaxy-Swiss Bourdin">
								</div>

								<div class="col-xs-9 ">
									<h1>Gestion des données</h1>    
								</div>

							</div>

						</div>
						&nbsp

					</div>

					<?php
					// ***************************************************** Engine power display ***************************************************** 
					$queryPower = "SELECT * FROM puissance";
					$resultPower = $bd->query($queryPower);
					?>

					<div class="panel-body">
						<div class="col-xs-12">             
							<div class="hpanel3">
								<div class="panel-body">
									<form method="post"> <button type="submit" class="btn btn-danger pull-right" name="deconnexion"></span>&nbsp;Deconnexion&nbsp;&nbsp;</span></button>
										<button type="submit" class="btn btn-info" name="accesFicheFrais"></span>&nbsp;Accès aux fiches de frais&nbsp;&nbsp;</span></button>
									</form>

									<table class="table">
										<div class="panel-body">
											<div class="col-xs-12 ">
												<h3>Puissance</h3>                         
											</div>

											<?php
											if(isset($_POST['submitDeletePuissance']))
											{
												$query = "DELETE FROM puissance WHERE ID = ".$_POST['idTabPuissance']."";
												$result= $bd->query($query);

												if ($result == false)
												{
													echo '<div class="text-center text-danger"> ';
													echo "Impossible de supprimer cette donnée car celle ci est utilisée par un tarif";
												}
												else{
													echo '<script language="Javascript">document.location.replace("http://172.16.9.54/Appli_web/Accueil.php");</script>';		
												}
											}
											?>


										</div>         

										<tr>
											<th><p class="text-error">Libelle</p></th>
											<th><p class="text-error"></p></th> <!-- Even if there is no title, we instanciate these tags to have uniform table -->
											<th><p class="text-error"></p></th>
										</tr>

										<?php
										while ($rowPower = $resultPower->fetch(PDO::FETCH_ASSOC)) // We check every line of the result of the query
										{ ?>
											<tr>
												<form method="post"> <!-- Data is displayed as a form to allow fast edit of it -->                 
													<td>
													  <input type="text" placeholder="Libelle" class="form-control" required="" aria-required="true" name="libelleModif" value=<?php echo "'".$rowPower['LIBELLE']."'" ?>>       
													</td>

													<td>
														<button type="submit" class="btn btn-info" name="submitEditPuissance"></span>&nbsp;Mettre à jour&nbsp;&nbsp;</button>
														<?php // We use hidden input to recognize later wich lane is used for the edit/delete
														echo '<input type="hidden" name="idTabPuissance" value='.$rowPower['ID'].'>'; ?>                            
													</td>
													
													<td>
														<button type='submit' class="glyphicon glyphicon-remove" name="submitDeletePuissance"></button>
													</td>

												</form>

											</tr>
										<?php } ?>

									</table>

									<form method="post">
										<!-- New data form -->
										<div class="form-group">
											<div class="col-xs-10">
												<input type="text" placeholder="Libelle" class="form-control" required="" aria-required="true" name="libellePuissance">
											</div>

											<button type="submit" class="btn btn-info" name="submitPuissance"></span>&nbsp;Ajouter&nbsp;&nbsp;</button>
										</div>

									</form><br/>
									
									<?php
									// ***************************************************** Fuel display ***************************************************** 
									$queryFuel = "SELECT * FROM carburant";
									$resultFuel = $bd->query($queryFuel);
									?>

									<table class="table">
										<div class="panel-body">
											<div class="col-xs-12s ">
												<h3>Carburant</h3>                         
											</div>

											<?php
											if(isset($_POST['submitDeleteCarburant']))
											{
												
												$query = "DELETE FROM carburant WHERE ID = ".$_POST['idTabCarburant']."";
												$result= $bd->query($query);

												if ($result == false)
												{
													echo '<div class="text-center text-danger"> ';
													echo "Impossible de supprimer cette donnée car celle ci est utilisée par un tarif";
												}
												else{
													echo '<script language="Javascript">document.location.replace("http://172.16.9.54/Appli_web/Accueil.php");</script>';
												}
											}
											?>

										</div>
										
										<tr>
											<th><p class="text-error">Libelle</p></th>
											<th><p class="text-error"></p></th>
											<th><p class="text-error"></p></th>
										</tr>

										<?php
										while ($rowFuel = $resultFuel->fetch(PDO::FETCH_ASSOC))
										{ ?>
											<form method="post">  
												<tr>
													<td>
														<input type="text" placeholder="Libelle" class="form-control" required="" aria-required="true" name="libelleModif" value=<?php echo "'".$rowFuel['LIBELLE']."'" ?>>       
													</td>

													<td>
														<button type="submit" class="btn btn-info" name="submitEditCarburant"></span>&nbsp;Mettre à jour&nbsp;&nbsp;</button>
														<?php echo '<input type="hidden" name="idTabCarburant" value='.$rowFuel['ID'].'>';  ?>					
													</td>
	
													<td>
														<button type='submit' class="glyphicon glyphicon-remove" name="submitDeleteCarburant"></button>
													</td>
													
												</tr>
											
											</form>			
										<?php } ?>

									</table>

									<form method="post">
										<div class="form-group">
											<div class="col-xs-10">
												<input type="text" placeholder="Libelle" class="form-control" required="" aria-required="true" name="libelleCarburant">
											</div>

											<button type="submit" class="btn btn-info" name="submitCarburant"></span>&nbsp;Ajouter&nbsp;&nbsp;</button>
										</div>

									</form>

									<?php
									// ***************************************************** Rate display ***************************************************** 
									$query = "SELECT * FROM tarifs";
									$result = $bd->query($query);

									$queryListeCarburant = "SELECT * FROM carburant";
									$resultListeCarburant = $bd->query($queryListeCarburant);

									$queryListePuissance = "SELECT * FROM puissance";
									$resultListePuissance = $bd->query($queryListePuissance);
									?>

									<table class="table">
										<div class="panel-body">
											<div class="col-xs-12 ">
												<h3>Tarifs</h3> 
												<?php
												if(isset($_POST['submitDeleteTarif']))
												{
													$queryDeleteTarif = "DELETE FROM tarifs WHERE ID = ".$_POST['idTabTarif']."";
													$resultDeleteTarif= $bd->query($queryDeleteTarif);
													if ($resultDeleteTarif == false)
													{
														echo '<div class="text-center text-danger"> ';
														echo "Impossible de supprimer cette donnée car celle ci est utilisée par une fiche de frais";
													}
													else
													{
														echo '<script language="Javascript">document.location.replace("http://172.16.9.54/Appli_web/Accueil.php");</script>';
													}
												} ?>               
											</div>

										</div>
										
										<tr>
											<th><p class="text-error">Prix</p></th>
											<th><p class="text-error">Carburant</p></th>
											<th><p class="text-error">Puissance</p></th>
											<th><p class="text-error"></p></th>
											<th><p class="text-error"></p></th>
										</tr>

										<?php
										while ($row = $result->fetch(PDO::FETCH_ASSOC))
										{ ?>
											<tr>
												<form method="post">
													<td>
														<input type="text" placeholder="Prix" class="form-control" required="" aria-required="true" name="prixModifs" value=<?php echo "'".$row['PRIX']."'" ?>>
													</td> 
													
													<td>
														<select class="form-control" name="valuelist1">
															<?php 			
															//Affichage de la première liste déroulante : Carburant
															$resultselect = $bd->query($queryListeCarburant);
															while ($rowselect = $resultselect->fetch(PDO::FETCH_ASSOC)) 
															{ 
																if ($row['IDCARBURANT'] == $rowselect['ID'])
																{
																	echo '<option   value='.$rowselect['ID']. ' selected="selected">'.$rowselect['LIBELLE'].'</option>';
																}
																else
																{
																	echo '<option   value='.$rowselect['ID'].'>'.$rowselect['LIBELLE'].'</option>';
																}
															} ?>

														</select>
													</td>

													<td>
														<select class="form-control" name="valuelist2">
															<?php 			
															//Affichage de la première liste déroulante : Carburant
															$resultselect2 = $bd->query($queryListePuissance);
															while ($rowselect2 = $resultselect2->fetch(PDO::FETCH_ASSOC)) 
															{ 
																if ($row['IDPUISSANCE'] == $rowselect2['ID'])
																{
																	echo '<option   value='.$rowselect2['ID']. ' selected="selected">'.$rowselect2['LIBELLE'].'</option>';
																}
																else
																{
																	echo '<option   value='.$rowselect2['ID'].'>'.$rowselect2['LIBELLE'].'</option>';
																}
															} ?>
														</select>

													</td>

													<?php echo '<input type="hidden" name="id" value='.$row['ID'].'>'; ?>

													<td>
														<button type="submit" class="btn btn-info" name="submitEditTarif"></span>&nbsp;Mettre à jour&nbsp;&nbsp;</button>
														<?php echo '<input type="hidden" name="idTabTarif" value='.$row['ID'].'>'; ?>                            
													</td>

													<td>
														<button type='submit' class="glyphicon glyphicon-remove" name="submitDeleteTarif"></button>
													</td>

												</form>

											</tr>

										<?php } ?>

									</table>

							 		<div class="form-group"> 
										
										<form method="post">
											<div class="col-xs-2">
												<input type="text" placeholder="Prix" class="form-control" required="" aria-required="true" name="prix">
											</div>

											<div class="col-xs-4"> 

												<!-- Power dropdown liste display -->
												<select class='form-control' name='libelleCarburantT'>
													<option>Selectionner un carburant</option>
													<?php
													while ($rowListeCarburant = $resultListeCarburant->fetch(PDO::FETCH_ASSOC))
													{
														echo "<option value=".$rowListeCarburant['LIBELLE'].">".$rowListeCarburant['LIBELLE']."</option>";
													} ?>					
												</select>
											
											</div>

											<div class="col-xs-4">
													
												<!-- Fuel dropdown liste display -->
												<select class='form-control' name='libellePuissanceT'>
													<option>Selectionner une puissance</option>

													<?php
													while ($rowListePuissance = $resultListePuissance->fetch(PDO::FETCH_ASSOC))
													{
														echo "<option value=".$rowListePuissance['LIBELLE'].">".$rowListePuissance['LIBELLE']."</option>";
													} ?>
												</select>
											
											</div>

											<button type="submit" class="btn btn-info" name="submitTarif"></span>&nbsp;Ajouter&nbsp;&nbsp;</button>

										</form>

									</div>

								</div>

							</div>

						</div>

				</section>

			</div>

		</body>


			<!-- ***************************************************** PHP ***************************************************** -->

	<?php
	}
}

if ($_SESSION['metier'] == "visiteur") // If the user is visitor
{
	echo '<script language="Javascript">document.location.replace("http://172.16.9.54/Appli_web/Telechargement.php");</script>';
}

if ($_SESSION['metier'] != "visiteur" && $_SESSION['metier'] != "comptable") {
	echo '<script language="Javascript">document.location.replace("http://172.16.9.54/Appli_web/index.php");</script>';
}

// Add, Edit, Delete
// ************************************************************ Add ************************************************************ 
if(isset($_POST['submitPuissance']))
{
	$libelle= $_POST['libellePuissance'];
	$query="INSERT INTO puissance(ID, LIBELLE) VALUES (NULL, :libelle)";
	$statement = $bd->prepare($query);
    $statement->execute(array('libelle'=> $libelle));
    echo '<script language="Javascript">document.location.replace("http://172.16.9.54/Appli_web/Accueil.php");</script>';
}

if(isset($_POST['submitCarburant']))
{
	$libelle= $_POST['libelleCarburant'];
	$query="INSERT INTO  carburant(ID, LIBELLE) VALUES (NULL, :libelle)";
	$statement = $bd->prepare($query);
    $statement->execute(array('libelle'=> $libelle));
    echo '<script language="Javascript">document.location.replace("http://172.16.9.54/Appli_web/Accueil.php");</script>';
}

if(isset($_POST['submitTarif']))
{
	$carburant = $_POST['libelleCarburantT'];
	$query = "SELECT ID FROM carburant WHERE LIBELLE='$carburant'";
	$carburant2 = $bd->query($query);

	$puissance = $_POST['libellePuissanceT'];
	$query = "SELECT ID FROM puissance WHERE LIBELLE='$puissance'";
	$puissance2 = $bd->query($query);

	$prix = $_POST['prix'];

	while ($row = $carburant2->fetch(PDO::FETCH_ASSOC))
    {
        $idCarburant = $row['ID']; 
    }

    while ($row = $puissance2->fetch(PDO::FETCH_ASSOC))
    {
        $idPuissance = $row['ID']; 
    }

    $query="INSERT INTO tarifs(ID, PRIX, IDCARBURANT, IDPUISSANCE) VALUES (NULL, :prix, :idCarburant, :idPuissance)";
    $statement = $bd->prepare($query);
    $statement->execute(array('prix'=> $prix, 'idCarburant'=>$idCarburant, 'idPuissance'=>$idPuissance));
    echo '<script language="Javascript">document.location.replace("http://172.16.9.54/Appli_web/Accueil.php");</script>';
}

// ************************************************************ Edit ************************************************************ 
if(isset($_POST['submitEditCarburant']))
{
	$query="UPDATE carburant SET LIBELLE = :libelleModif where ID = :idTabCarburant";
	$statement = $bd->prepare($query);
    $statement->execute(array('libelleModif'=> $_POST['libelleModif'], 'idTabCarburant'=>$_POST['idTabCarburant']));
	echo '<script language="Javascript">document.location.replace("http://172.16.9.54/Appli_web/Accueil.php");</script>';
}

if(isset($_POST['submitEditPuissance']))
{
	$query="UPDATE puissance SET LIBELLE = :libelleModif where ID = :idTabPuissance";
	$statement = $bd->prepare($query);
    $statement->execute(array('libelleModif'=> $_POST['libelleModif'], 'idTabPuissance'=>$_POST['idTabPuissance']));
	echo '<script language="Javascript">document.location.replace("http://172.16.9.54/Appli_web/Accueil.php");</script>';
}

if(isset($_POST['submitEditTarif']))
{
	$query = "UPDATE tarifs SET PRIX = :prix, IDCARBURANT = :idCarburant, IDPUISSANCE = :idPuissance where ID = :idTabTarif";
	$statement = $bd->prepare($query);
	$statement->execute(array('prix'=> $_POST['prixModifs'], 'idCarburant'=> $_POST['valuelist1'], 'idPuissance'=>$_POST['valuelist2'], 'idTabTarif'=>$_POST['idTabTarif']));


	echo '<script language="Javascript">document.location.replace("http://172.16.9.54/Appli_web/Accueil.php");</script>';
}

// ************************************************************ Delete ************************************************************ 


if(isset($_POST['deconnexion']))
{
	deconnexion();
}

if(isset($_POST['accesFicheFrais']))
{
	echo '<script language="Javascript">document.location.replace("http://172.16.9.54/Appli_web/FicheFrais.php");</script>';
}
?>