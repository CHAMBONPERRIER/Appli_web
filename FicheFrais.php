<?php
 
// Create connection
$connexion=new PDO('mysql:host=localhost;dbname=gsb', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
 

$requete = "SELECT * FROM fichefrais";
$result = $connexion->query($requete);
mb_internal_encoding('UTF-8');



?>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>

<table class="table">
    <caption>Demandes de remboursement</caption>
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
	            $result2 = $connexion->prepare($query2);
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
	            $result2 = $connexion->prepare($query2);
	            $result2->execute();
	            while ($row2 = $result2->fetch(PDO::FETCH_ASSOC))
	            {
	                echo $row2['LOGIN'];

	            }
			?>
			</td>
            <td>
            	<form action="#" method="post">
				<select name="valuelist">;
					<?php
					$requeteetat = "SELECT * FROM etat";
					$resultselect = $connexion->query($requeteetat);
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

				?>

<?php
				echo '<input type="hidden" name="id" value='.$row['ID'].'>'; 
				echo '<input type="submit" name="Submit" value="Valider">';
				//var_dump($voila);
?>

				</form>
<?php
			if(isset($_POST['Submit']))
			{
				$sql = "UPDATE fichefrais SET IDETAT = '".$_POST['valuelist']."' where ID = '".$_POST['id']."'";
				$req= $connexion->query($sql);
				echo '<script language="Javascript">document.location.replace("http://localhost/Appli_web/ficheFrais.php");</script>';
			}
?> 
			</td>

                              
		</tr>
	<?php } ?>
</table>



