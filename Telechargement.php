<?php
session_start();
include 'Fonctions.php';

if (isset ($_SESSION['login']))
{

	?>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link href="style/css/bootstrap.css" rel="stylesheet" />
	</head>
	<body class="page">
		<div class='container'>
			<section class="row">
				<div class="col-xs-12">
					<div class="hpanel3">
						<div class="panel-body">
							<div class="col-xs-3">
								<img class="img-responsive"  src="./images/logo.jpg" id="logoGSB" alt="Laboratoire Galaxy-Swiss Bourdin" title="Laboratoire Galaxy-Swiss Bourdin">
							</div>

							<div class="col-xs-9 ">
								<h1>Télécharger l'application</h1> </div>
							</div>
						</div>

						<div class="col-xs-12">  
							<br>
							<div class="hpanel3">

								<div class="panel-body">
									<form method="post"> 
										<button type="submit" class="btn btn-danger pull-right" name="deconnexion">
											</span>
												&nbsp;Deconnexion&nbsp;&nbsp;
											</span>
										</button>
									</form>
									<br>
									<div id="android">
										<h1 class="titre text-info">
											Utilisateur Android
										</h1>
										<br>

										<img class="img-thumbnail img-responsive center-block" id="QR" style="width : 35%;" src="./images/android_qr.jpg">
										<br>

										<div class="text-center small">	
											Scannez le code avec votre téléphone android <br> pour télécharger l'application mobile. 
										</div>
										<br>
									</div>

									<div id='ios'>
										<h2 class="titre text-info">
											Utilisateur iOS
										</h2>
									</div>
									<br>
																		<?php
									if(isset($_POST['submit']))
									{
										$email = $_POST['email']; 
										$destinataire = "titouan.allender@hotmail.fr";
										$arobase = "@";
										$position = strpos($email, $arobase);
										if(empty($_POST['email']) || $position===false)
										{
											echo "<div class='text-center text-danger'> Veuillez entrer un e-mail valide. </div>";
										}
										else
										{
											mail($destinataire, "Demande d'inscription application frais iOS", $email);
											echo "Votre demande d'utilisation de l'application iOS a bien été envoyé";
										}
									}
									?>
									<form method="post" >
										<input type="email" name="email" style="text-align : center; width : 60%;" class="center-block form-control" placeholder="Entrez votre e-mail">
										<input type="submit" class="center-block btn btn-success" value="Envoyer" style="margin-top : 5px;" name="submit"/>
									</form>
									<div class="text-center small">	 
										Entrez votre email pour envoyer une demande d'accès a l'application mobile iOS. 
										<br> Vous receverez par la suite un email contenant une invitation a se joindre 
										<br>au programme de test de l'application frais kilométrique.
									</div>
									<br>

									
								</div>	
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</body>
<?php
}

if(isset($_POST['deconnexion']))
{
	deconnexion();
}

?>




