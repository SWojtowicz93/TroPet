<?php
	session_start();
	
	if(isset($_POST['nick']))
	{
		$everything_OK = true;	

		$nick = $_POST['nick'];
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

		$old_haslo = $_POST['old_haslo'];
		if((strlen($old_haslo)<2 || (strlen($old_haslo)>20)))
		{
			$everything_OK = false;
			$_SESSION['e_old_haslo'] = "old_haslo musi posiadać od 6 do 20 znaków!";
		}

		$haslo1 = $_POST['haslo1'];
		$haslo2 = $_POST['haslo2'];
		
		if((strlen($haslo1)<6))
		{
			$everything_OK = false;
			$_SESSION['e_haslo1'] = "Hasło musi posiadać conajmniej 6 znaków";			
		}

		if($haslo1 != $haslo2)
		{
			$everything_OK = false;
			$_SESSION['e_haslo2'] = "Hasła nie są identyczne";			
		}

		 $haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);
		
//Zapamiętanie wprowadzonych danych	
	
		$_SESSION['fr_old_haslo'] = $old_haslo;
		$_SESSION['fr_nick'] = $nick;		
		$_SESSION['fr_haslo1'] = $haslo1;	
		$_SESSION['fr_haslo1'] = $haslo1;	
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
				if ($nick === $_POST['login'])
				{
					$rezultat = $polaczenie->query("SELECT id_user FROM uzytkownik WHERE user='$nick'");
					
					if(!$rezultat) throw new Exception($polaczenie->error);
					
					$ile_takich_nickow = $rezultat->num_rows;
					if($ile_takich_nickow>0)
						{
							$everything_OK = false;
							$_SESSION['e_nick']="Podany nick już istnieje";
						
						}
				}

				if($everything_OK == true)
				{
//Walidacja udała się na wszystkich danych
					$id = $_SESSION['id'];
					if($polaczenie->query("UPDATE uzytkownik SET user='$nick', pass='$haslo_hash' WHERE id_user=$id"))
					{
							$_SESSION['udanazmiana'] = true;
							header('Location: changed.php');
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
		margin-top: 10px;
		margin-bottom: 10px;
	}
	</style>
</head>
<body>
	<div class="main_container">
	<header>
		<?php require_once "header.php"; 
		?>
	
	</header>
		<div class="content">
			<div class="in_content">
				<h2>TroPet - Dodaj profil pupila<br/><br/></h2>
				
				<form method = "post">
					
				Nick:<br/><input type = "text" value="<?php
					if (isset($_SESSION['fr_nick']))
					{
						echo $_SESSION['fr_nick'];
						unset($_SESSION['fr_nick']);
					}
					else
					{
					echo $_SESSION['user'];
					}
					?>" name = "nick" /> <br/>
					<?php
					if(isset($_SESSION['e_nick']))
					{
						echo '<div class = "error">'.$_SESSION['e_nick'].'</div>';
						unset($_SESSION['e_nick']);
					}
					?>
					
					<br/>
					Stare hasło:<br/><input type = "text" value="<?php
					if (isset($_SESSION['fr_old_haslo']))
					{
						echo $_SESSION['fr_old_haslo'];
						unset($_SESSION['fr_old_haslo']);
					}
					?>" name = "old_haslo" /><br/>
					<?php
					if(isset($_SESSION['e_old_haslo']))
					{
						echo '<div class = "error">'.$_SESSION['e_old_haslo'].'</div>';
						unset($_SESSION['e_fold_haslo']);
					}
					?>
					<br/>
					Nowe hasło:<br/><input type = "text" value="<?php
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
					<br/>
					Powtórz haslo:<br/><input type= "text" value="<?php
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
					<br/>
					<div style ="float:left; padding-top:16px; width:50%; text-align:center;">		
						<input type = "submit" class="button" value = "Edytuj" />
					</div>	
					</form>
				
				
					<div style ="float:left;">	
						<a href = "user_profil.php"> <button class="button" role="button">Powrót</button>
					</div>
			</div>	
	</div>
	<?php
	require_once "footer.php";
	?>
</div>
<?php
		if(isset($_SESSION['blad']))
			echo $_SESSION['blad'];
?>

</body>
</html>	
	