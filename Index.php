<?php
session_start();
include 'Fonctions.php';
include 'ConnexionBd.php';

if (isset ($_SESSION['login']))
{
	echo '<script language="Javascript">document.location.replace("http://172.16.9.54/Appli_web/Accueil.php");</script>';
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
								<h1>Remboursement des frais kilométriques</h1>
								
							</div>

						</div>
					</div>


					<div class="hpanel hblue">
						<div class="panel-body text-center" style="padding : 30px 80px 0px 80px;">

							<div class="text-center">
								<?php
								if(isset($_POST['submitConnexion']))
								{
									$identifiant = $_POST['id'];
									$motdepasse = sha1($_POST['password']);
									connexion($identifiant,$motdepasse,$bd);
								}
								?>
								<form method="POST">
									<input type="text" placeholder="identifiant" class="form-control text-center" required="" aria-required="true" name="id">
									<br>
									<input type="password" placeholder="Password" class="form-control text-center" name="password">
									<br>
									<button type="submit" class="btn btn-info center-block" name="submitConnexion"></span>&nbsp;Connexion&nbsp;&nbsp;</button>

								</form>
							</div>
						</div>

					</div>
				</div>
			</section>
</div>

<?php
}

$bd = null;
?>


</body>
