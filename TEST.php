<!DOCTYPE html>
<head>
	<title>Accueil</title>
	<meta charset="utf-8">
	<link href="style/css/bootstrap.css" rel="stylesheet" />
</head>
<div id="wrapper">  
	<?php

	session_start();
	include 'Fonctions.php';




	$bd = new PDO('mysql:host=localhost;dbname=gsb', 'root','');

	$query = "SELECT * FROM puissance";
	$result = $bd->query($query);
	?>
	<body class="page">
		<div class="panel-body">
			<div class="col-xs-10">             
				<div class="hpanel">
					<div class="panel-body">
						<table class="table">

							<div class="panel-body">


								<div class="col-xs-9 ">
									<h3>Puissance</h3>                         
								</div>

							</div>


							<thead class="thead-inverse">
								<tr>
									<th><p class="text-error">Id</p></th>
									<th><p class="text-error">Libelle</p></th>
									<th><p class="text-error">Modifier</p></th>
									<th><p class="text-error">Supprimer</p></th>
								</tr>
							</thead>
							<?php

							while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
							<tr>
								<td><?php echo $row['ID']; ?></td>
								<td><?php echo $row['LIBELLE']; ?></td>
								<td><?php echo '<a href="modifier.php?id='.$row['ID'].'">Modifier</a>'; ?></td>
								<td><?php echo '<a href="supprimer.php?id='.$row['ID'].'">Supprimer</a>'; ?></td> 
								<?php } ?>                                    
							</tr>
						</table><br/>
					</div>
				</div>
			</div>
		</div>
	</body>
<div>  