<!DCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Find_Me - znajdź swojego pupila</title>
	<link rel="stylesheet" href="main.css">
	<link rel="stylesheet" href="socialmedia.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Noto+Serif:wght@400;700&display=swap" rel="stylesheet">
</head>

<?php
require_once "connect.php";
//połączenie z bazą danych
$polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
//sprawdzenie połączenia z bazą danych
	if($polaczenie->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno;
	}
	else
	{

		$id = $_POST['id_pet'];
		if($rezult = @$polaczenie->query(sprintf("SELECT * FROM pet WHERE PET_ID = $id",
		mysqli_real_escape_string($polaczenie,$login))));
		{
		//sprawdzenie ile wierszy zostało zwróconych
			$user_exist2 = $rezult->num_rows;
			if($user_exist2>0)
			{
		//Wyciąganie poszcególnych danych z bzy danych
				$line = $rezult->fetch_assoc();
		//Wyciąganie poszcególnych danych z bzy danych
					
					$first_name = $line['PET_NAME'];
					$last_name = $line['BREED'];
					$tel_number = $line['SIZE'];
					$address = $line['COLOR'];					
					$city = $line['NATURE'];
					$country = $line['STATUS'];
					$post_code = $line['OWNER_ID'];
					
		// usunięcie rezultatów
					$rezult->free_result();
				
			}
		}
	}
?>


<body>
<div class="main_container">
	<header>
		<?php require_once "header.php"; 
		?>
	
	</header>

	<div class="content">
		<div style = "width: 100%;">
		<h2>Zaginiony Pupil</h2>
		<Table>

			<tr>
				<td><b>Imie: </b><?php echo $first_name; ?></td>
			</tr>
			<tr>
				<td><b>Rasa: </b><?php echo $last_name; ?></td>
			</tr>
			<tr>
				<td><b>Rozmiar pupila </b><?php echo $tel_number; ?></td>
			</tr>
			<tr>
				<td><b>Status </b><?php echo $country; ?></td>
			</tr>
			<tr>
				<td><b>Usposobienie </b><?php echo $city; ?></td>
			</tr>
			<tr>
				<td><b>Kolor </b><?php echo $address; ?></td>
			</tr>
			<tr>
				<td><b>ID właściciela </b><?php echo $post_code; ?></td>
			</tr>

		</Table>
		<br/>
		<br/>
		<a href = "haslo_edit.php"> <button class="button" role="button">Pokaż dane właściciela</button>
		<a href = "announcements.php"> <button class="button" role="button">Powrót</button>
		</div>	
	</div>
	<?php
	require_once "footer.php";
	?>
</div>
</body>
</html>	
	