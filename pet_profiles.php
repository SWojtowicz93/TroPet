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
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Noto+Serif:wght@400;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="main.css">
	<link rel="stylesheet" href="socialmedia.css">
</head>
<?php
require_once "connect.php";
	mysqli_report(MYSQLI_REPORT_STRICT);
	
	try
	{		
//połączenie z bazą danych
		$polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
		if($polaczenie->connect_errno!=0)
		{
				throw new Exception(mysqli_connect_errno());
		}	
		else
		{

			$id = $_SESSION['id'];
			if($rezult = $polaczenie->query("SELECT * FROM pet WHERE OWNER_ID = '$id'"))
			{
			$user_exist2 = $rezult->num_rows;
			if($user_exist2>0)
			{

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
                    <h2> Twoje zgłoszenia</h2>
                </div>
            </div>
		        <img class="first" src = "src/dog.jpg">
	        </div>
        </div>
	
	<?php
//Wyciąganie poszcególnych danych z bzy danych
		$line = $rezult->fetch_all(MYSQLI_ASSOC);
//Wyciąganie poszcególnych danych z bzy danych
		foreach ($line as $lin)
		{
			echo "<div class=\"content\">";
				echo "<div class =\"left_content\">";
					echo "<img src = \"src\dog_prof.jpg\">";
				echo "</div>";
				echo "<div class=\"right_content\">";
					echo "<Table>";
					echo"<tr>";
					echo"<td><b>Imię pupila: </b>".$lin['PET_NAME']."</td>";
					echo"</tr>";
					echo"<tr>";
					echo"<td><b>Rasa: </b>".$lin['BREED']."</td>";
					echo"</tr>";
					echo"<tr>";
					echo"<td><b>Wielkość pupila: ".$lin['SIZE']." </td>";
					echo"</tr>";
					echo"<tr>";
					echo"<td><b>Umaszczenie: </b>". $lin['COLOR']. "</td>";
					echo"</tr>";
					echo"<tr>";
					echo"<td><b>Zachowanie: </b>". $lin['NATURE']."dupa". "</td>";
					echo"</tr>";				
					echo"<tr>";
					$petid = $lin['PET_ID'];
					var_dump($petid);
					echo"<form action = \"pet_edit.php\" method = \"post\">";
					echo "<input type = \"hidden\" name = \"id_pet\" value = \"$petid\" />";
					echo"<tr>";
					echo"<td></td><td><input type = \"submit\" class=\"button\" value=\"Wiecej\"></td>";
					echo"</tr>";
					echo"</form>";
					echo "</Table>";
				echo "</div>";
			echo"</div>";
		}
// usunięcie rezultatów
		$rezult->free_result();
				
		}
		$polaczenie->close();
		}
		else
		{
			throw new Exception($polaczenie->error);
		}
		}
		}
		catch(Exception $e)
		{
			echo '<span style = "color:red;"> kurwa błąd servera!</span>';
			echo '<br/> Informacja developerska'.$e;
		}		

	?>	

		<br/> <br/>
		<div class="content">	
		<A href = "add_pet.php"> <button class="button" role="button">Dodaj pupila</button> </a>
		</div>
		<?php
		require_once "footer.php";
		?>
</div>
</body>
</html>	
	