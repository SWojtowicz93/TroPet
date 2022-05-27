<?php
	session_start();
	
	if(!isset($_SESSION['udane_dodanie']))
	{
		header('Location: log_in.php');
		exit;
	}
	else
	{
		unset($_SESSION['udane_dodanie']);
	}
//Usuwanie zmiennych błędów rejestracji	
if(isset($_SESSION['fr_nick'])) unset($_SESSION['fr_nick']);
if(isset($_SESSION['fr_email'])) unset($_SESSION['fr_email']);
if(isset($_SESSION['fr_hsalo1'])) unset($_SESSION['fr_haslo1']);
if(isset($_SESSION['fr_haslo2'])) unset($_SESSION['fr_haslo2']);
if(isset($_SESSION['fr_regulamin'])) unset($_SESSION['fr_regulamin']);
//Usuwanie zmiennych podanych w formularzu	
if(isset($_SESSION['e_nick'])) unset($_SESSION['e_nick']);
if(isset($_SESSION['e_email'])) unset($_SESSION['e_email']);
if(isset($_SESSION['e_hsalo1'])) unset($_SESSION['e_haslo1']);
if(isset($_SESSION['e_haslo2'])) unset($_SESSION['e_haslo2']);
if(isset($_SESSION['e_regulamin'])) unset($_SESSION['e_regulamin']);

?>
<!DCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Tropet - znajdź swojego pupila</title>
	<link rel="stylesheet" href="main.css">
	<link rel="stylesheet" href="socialmedia.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Noto+Serif:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
	<div class="content">
		<h1>Twój pupil zosta dodany<br/><br/></h1>
	

		<A href = "index.php" style="margin: auto;"><button class="button" role="button">Powrót</button></a>
<?php
		if(isset($_SESSION['blad']))
			echo $_SESSION['blad'];
?>
	</div>
	<?php
	require_once "footer.php";
	?>
</body>
</html>	
	