<?php
	session_start();
	
	if((isset($_SESSION['zalogowany']))&&($_SESSION['zalogowany']==true))
	{
		header('Location: index.php');
		exit();
	}
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


<header>
		<?php require_once "header.php"; 
		?>
	
	</header>
<div class="login">
	Tropet - znajdź swojego pupila<br/><br/>
	
	<form action = "login.php" method = "post">
		
		Login:<br/><input type = "text" name = "login" /> <br/>

		Hasło:<br/><input type = "password" name = "haslo" /> <br/> <br/>
		
		<input type = "submit" value = "Zaloguj się" />

	
	</form>
	<br/>
	<A href = "rejestracja.php"> Zarejestruj się </a>
	<br/>
</div>	
<?php
		if(isset($_SESSION['blad']))
			echo $_SESSION['blad'];
			unset($_SESSION['blad']);
?>
	<?php
	require_once "footer.php";
	?>
</body>
</html>	
	