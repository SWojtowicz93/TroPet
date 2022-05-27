<?php
	session_start();
	
	if(!isset($_SESSION['zalogowany'])){
		header('Location: log_in.php');
		exit();
	}
?>
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

		$id = $_SESSION['id'];
		if($rezult = @$polaczenie->query(sprintf("SELECT * FROM user_info WHERE id_user = $id",
		mysqli_real_escape_string($polaczenie,$login))));
		{
		//sprawdzenie ile wierszy zostało zwróconych
			$user_exist2 = $rezult->num_rows;
			if($user_exist2>0)
			{
		//Wyciąganie poszcególnych danych z bzy danych
				$line = $rezult->fetch_assoc();
		//Wyciąganie poszcególnych danych z bzy danych
					
					$first_name = $line['first_name'];
					$last_name = $line['last_name'];
					$tel_number = $line['tel_number'];
					$address = $line['address'];					
					$city = $line['city'];
					$country = $line['country'];
					$post_code = $line['post_code'];
					
					$_SESSION['first_name'] = $line['first_name'];
					$_SESSION['last_name'] = $line['last_name'];
					$_SESSION['tel_number'] = $line['tel_number'];
					$_SESSION['address'] = $line['address'];					
					$_SESSION['city'] = $line['city'];
					$_SESSION['country'] = $line['country'];
					$_SESSION['post_code'] = $line['post_code'];
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
	<div class="container">		
	        <div class = "zdj">
                <div class="title">
                    
                <div class="title-bg">
                    <h2> Profil użytkownika</h2>
                </div>
            </div>
		        <img class="first" src = "src/dog.jpg">
	        </div>
        </div>
	<div class="content">
		<div style = "width: 100%;">
		<Table>
			<tr>
				<td><b>Nick: </b><?php echo $_SESSION['user']; ?></td>
			</tr>
			<tr>
				<td><b>Imie: </b><?php echo $first_name; ?></td>
			</tr>
			<tr>
				<td><b>Nazwisko: </b><?php echo $last_name; ?></td>
			</tr>
			<tr>
				<td><b>Nr. kontaktowy: </b><?php echo $tel_number; ?></td>
			</tr>
			<tr>
				<td><b>Kraj: </b><?php echo $country; ?></td>
			</tr>
			<tr>
				<td><b>Miasto: </b><?php echo $city; ?></td>
			</tr>
			<tr>
				<td><b>Nr. domu/mieszkania </b><?php echo $address; ?></td>
			</tr>
			<tr>
				<td><b>Kod pocztowy: </b><?php echo $post_code; ?></td>
			</tr>

		</Table>
		<br/>
		<br/>
		<a href = "haslo_edit.php"> <button class="button" role="button">Edytuj dane logowania</button>
		<a href = "prof_edit.php"> <button class="button" role="button">Edytuj dane</button>
		</div>	
	</div>
	<?php
	require_once "footer.php";
	?>
</div>
</body>
</html>	
	