<!DOCTYPE html>
<?php

session_start();
include 'Fonctions.php';
$bd = new PDO('mysql:host=localhost;dbname=gsb', 'root','');

if (isset ($_SESSION['login']))
{
	echo '<script language="Javascript">document.location.replace("http://localhost/Appli_web/Accueil.php");</script>';
}
else {

?>

<script >

</script>


<head>
	<title>Connexion</title>
	<meta charset="utf-8">
	<link href="style/css/bootstrap.css" rel="stylesheet" />
</head>


<body class="page">

	

	<div class='container'>

		<!-- Présentation -->
		<section class="row">
			<div class="col-xs-12">

				
					<div class="hpanel">
						<div class="panel-body">


							<div class="col-xs-3">
								<img class="img-responsive"  src="./images/logo.jpg" id="logoGSB" alt="Laboratoire Galaxy-Swiss Bourdin" title="Laboratoire Galaxy-Swiss Bourdin">
							</div>
							<div class="col-xs-9 ">
								<h1 >Remboursement des frais kilométriques</h1>
								
							</div>

						</div>
					</div>
				
				
				<div class="hpanel hblue">
					<div class="panel-body">
						
						<div class="col-xs-6 col-sm-3 col-md-8">

							<form method="POST">
								<div class="form-group"><label>identifiant</label> <input type="text" placeholder="identifiant" class="form-control" required="" aria-required="true" name="id"></div>
								<div class="form-group"><label>Password</label> <input type="password" placeholder="Password" class="form-control" name="password"></div>
								<button type="submit" class="btn btn-info" name="submitConnexion"></span>&nbsp;Connexion&nbsp;&nbsp;<span class="glyphicon glyphicon-chevron-right"></span></button>
                            </div>
							</form>
						</div>

					</div>
				</div>
			</div>

			</section>
		</div>



	</body>
<?php
}
	if(isset($_POST['submitConnexion']))
{
    $identifiant = $_POST['id'];
    $motdepasse = $_POST['password'];

    connexion($identifiant,$motdepasse,$bd);
}
?>