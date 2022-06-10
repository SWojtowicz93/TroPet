<?php
	session_start();
	
	if(isset($_POST['email']))
	{
//Udana walidacja?
		$everything_OK = true;
		
//Sprawdź Nickname
		$nick = $_POST['nick'];
//Sprawdz długość Nickname
		if((strlen($nick)<3 || (strlen($nick)>20)))
		{
			$everything_OK = false;
			$_SESSION['e_nick'] = "Nick musi posiadać od 3 do 20 znaków!";
		}
		if(ctype_alnum($nick)==false)
		{
			$everything_OK = false;
			$_SESSION['e_nick'] = "Nick nie może posiadać tylko litery i cyfry (bez polskich znaków)";
		}
//Sprawdź empty
		$email = $_POST['email'];
// formuła prawidłowego adresu e-mail 
		$sprawdz = '/^[a-zA-Z0-9.\-_]+@[a-zA-Z0-9\-.]+\.[a-zA-Z]{2,4}$/';

		if(!preg_match($sprawdz, $email))
		{
			$everything_OK = false;
			$_SESSION['e_email'] = "Adres e-mail nieprawidłowy";
		}
		
//Sprawdź Hasło
		$haslo1 = $_POST['haslo1'];
		$haslo2 = $_POST['haslo2'];
		
//Sprawdź długość
		if((strlen($haslo1)<6))
		{
			$everything_OK = false;
			$_SESSION['e_haslo1'] = "Hasło musi posiadać conajmniej 6 znaków";			
		}
//Sprawdź czy hasła są takie same
		if($haslo1 != $haslo2)
		{
			$everything_OK = false;
			$_SESSION['e_haslo2'] = "Hasła nie są identyczne";			
		}
// hashowanie hasła
		 $haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);

		
		if(!isset($_POST['regulamin']))
		{
			$everything_OK = false;
			$_SESSION['e_regulamin'] = "Musisz zaakceptować regulamin";
		}
//Zapamiętanie wprowadzonych danych		
		$_SESSION['fr_nick'] = $nick;	
		$_SESSION['fr_email'] = $email;	
		$_SESSION['fr_haslo1'] = $haslo1;	
		$_SESSION['fr_haslo2'] = $haslo2;
		if(isset($_POST['regulamin']))$_SESSION['fr_regulamin'] = true;
		
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
//Czy email już istnieje
				$rezultat = $polaczenie->query("SELECT id_user FROM uzytkownik WHERE email='$email'");
				
				if(!$rezultat) throw new Exception($polaczenie->error);
				
				$ile_takich_maili = $rezultat->num_rows;
				if($ile_takich_maili>0)
					{
						$everything_OK = false;
						$_SESSION['e_email']="Podany mail już istnieje";
					
					}
//Czy nick już istnieje
				$rezultat = $polaczenie->query("SELECT id_user FROM uzytkownik WHERE user='$nick'");
				
				if(!$rezultat) throw new Exception($polaczenie->error);
				
				$ile_takich_nickow = $rezultat->num_rows;
				if($ile_takich_nickow>0)
					{
						$everything_OK = false;
						$_SESSION['e_nick']="Podany nick już istnieje";
					
					}
				if($everything_OK == true)
				{
//Walidacja udała się na wszystkich danych	
					if($polaczenie->query("INSERT INTO uzytkownik VALUES(NULL, 
					'$nick', '$haslo_hash', '$email')"))
					{
							$_SESSION['udanarejestracja'] = true;
							header('Location: welcome.php');
					}
					else
					{
						throw new Exception($polaczenie->error);
					}
				}
				$polaczenie->close();
			}
		}
		catch(Exception $e)
		{
			echo '<span style = "color:red;"> kurwa błąd servera!</span>';
			echo '<br/> Informacja developerska'.$e;
		}
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
	<style>
	.error
	{
		color:red;		
		margin-bottom: 10px;
		font-size: 18px;
	}
	</style>
</head>

<body>

<header>
		<?php require_once "header.php"; 
		?>
	
	</header>
<div class="content">
	
	Find_Me - załóż darmowe konto<br/><br/>
	
	<form method = "post">
		
		Nickname:<br/><input type = "text" value="<?php
		if (isset($_SESSION['fr_nick']))
		{
			echo $_SESSION['fr_nick'];
			unset($_SESSION['fr_nick']);
		}
		?>" name = "nick" /> <br/>
		<?php
		if(isset($_SESSION['e_nick']))
		{
			echo '<div class = "error">'.$_SESSION['e_nick'].'</div>';
			unset($_SESSION['e_nick']);
		}
		?>
		
		Email:<br/><input type = "text" value="<?php
		if (isset($_SESSION['fr_email']))
		{
			echo $_SESSION['fr_email'];
			unset($_SESSION['fr_email']);
		}
		?>" name = "email" /><br/>
		<?php
		if(isset($_SESSION['e_email']))
		{
			echo '<div class = "error">'.$_SESSION['e_email'].'</div>';
			unset($_SESSION['e_email']);
		}
		?>
		Hasło:<br/><input type = "password" value="<?php
		if (isset($_SESSION['fr_haslo1']))
		{
			echo $_SESSION['fr_haslo1'];
			unset($_SESSION['fr_haslo1']);
		}
		?>" name = "haslo1" /> <br/>
		<?php
		if(isset($_SESSION['e_haslo1']))
		{
			echo '<div class = "error">'.$_SESSION['e_haslo1'].'</div>';
			unset($_SESSION['e_haslo1']);
		}
		?>		
		Powtórz hasło:<br/><input type= "password" value="<?php
		if (isset($_SESSION['fr_haslo2']))
		{
			echo $_SESSION['fr_haslo2'];
			unset($_SESSION['fr_haslo2']);
		}
		?>" name = "haslo2" /><br/> 
		<?php
		if(isset($_SESSION['e_haslo2']))
		{
			echo '<div class = "error">'.$_SESSION['e_haslo2'].'</div>';
			unset($_SESSION['e_haslo2']);
		}
		?>			
		<label>
		<input type="checkbox" name = "regulamin" <?php
		if(isset($_SESSION['fr_regulamin']))
		{
			echo "checked";
			unset($_SESSION['fr_regulamin']);
		}
		?>/> <b>Akceptuje regulamin</b><br/>
		</label>
		<?php
		if(isset($_SESSION['e_regulamin']))
		{
			echo '<div class = "error">'.$_SESSION['e_regulamin'].'</div>';
			unset($_SESSION['e_regulamin']);
		}
		?>	
		<input type = "submit" value = "Zarejestrój się" />

	
	</form>
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
	