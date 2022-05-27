<?php
	session_start();
	
	if(isset($_POST['nick']))
	{
		$everything_OK = true;	

		$nick = $_POST['nick'];
		if((strlen($nick)<2 || (strlen($nick)>20)))
		{
			$everything_OK = false;
			$_SESSION['e_nick'] = "Nick musi posiadać od 3 do 20 znaków!";
		}

		if(ctype_alnum($nick)==false)
		{
			$everything_OK = false;
			$_SESSION['e_nick'] = "Nick może posiadać tylko litery (bez polskich znaków)";
		}

		$firstname = $_POST['firstname'];
		if((strlen($firstname)<2 || (strlen($firstname)>20)))
		{
			$everything_OK = false;
			$_SESSION['e_firstname'] = "Imie musi posiadać od 2 do 20 znaków!";
		}

		$lastname = $_POST['lastname'];
		if((strlen($lastname)<2 || (strlen($lastname)>20)))
		{
			$everything_OK = false;
			$_SESSION['e_lastname'] = "Nazwisko musi posiadać od 2 do 20 znaków!";
		}
		
		$number = $_POST['number'];
		if((strlen($number)<9 || (strlen($number)>10)))
		{
			$everything_OK = false;
			$_SESSION['e_number'] = "Numer musi posiadac 9 cyfr";
		}

		$address = $_POST['address'];
		if((strlen($address)<2 || (strlen($address)>20)))
		{
			$everything_OK = false;
			$_SESSION['e_address'] = "Ulica musi posiadać od 2 do 20 znaków!";
		}	

		$city = $_POST['city'];
		if((strlen($city)<2 || (strlen($city)>20)))
		{
			$everything_OK = false;
			$_SESSION['e_city'] = "Misato musi posiadać od 2 do 20 znaków!";
		}

		$country = $_POST['country'];
		if((strlen($country)<2 || (strlen($country)>20)))
		{
			$everything_OK = false;
			$_SESSION['e_country'] = "Kraj musi posiadać od 2 do 20 znaków!";
		}
		$post_code = $_POST['post_code'];
		if((strlen($post_code)<2 || (strlen($post_code)>20)))
		{
			$everything_OK = false;
			$_SESSION['e_post_code'] = "Kod pocztowy musi posiadać od 2 do 20 znaków!";
		}		
//Zapamiętanie wprowadzonych danych	
	
		$_SESSION['fr_nick'] = $nick;
		$_SESSION['fr_firstname'] = $firstname;	
		$_SESSION['fr_lastname'] = $lastname;	
		$_SESSION['fr_number'] = $number;	
		$_SESSION['fr_address'] = $address;	
		$_SESSION['fr_city'] = $city;		
		$_SESSION['fr_country'] = $country;
		$_SESSION['fr_post_code'] = $post_code;

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

				if($everything_OK == true)
				{
//Walidacja udała się na wszystkich danych
					$id = $_SESSION['id'];


				if($rezult = $polaczenie->query("SELECT * FROM pet WHERE OWNER_ID = '$id'"))
			{
			$user_exist2 = $rezult->num_rows;
			if($user_exist2>0)
			{
				if($polaczenie->query("UPDATE user_info SET first_name='$firstname', last_name='$lastname', tel_number=$number, address='$address', city='$city', country='$country', post_code='$post_code' WHERE id_user=$id"))
				{
						$_SESSION['udanazmiana'] = true;
						header('Location: welcome.php');
						
				}
				else
				{
					throw new Exception($polaczenie->error);
				}
				if ($_SESSION['udana_edycja'] = true)
				{
				header('Location: changed.php');
				}
	
			}
			else
			{
				if($polaczenie->query("INSERT INTO user_info (id_user_info, id_user, first_name, last_name, tel_number, address, city, country, post_code) VALUES (NULL, 15, '$firstname', '$lastname', 123456789, '$address', '$city', '$country', '$post_code' )"))
				{
						$_SESSION['udanazmiana'] = true;
						header('Location: welcome.php');
						
				}
				else
				{
					throw new Exception($polaczenie->error);

				}
				if ($_SESSION['udana_edycja'] = true)
				{
				header('Location: changed.php');
				}
			}
	$polaczenie->close();
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
			echo $id;
		}
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
<div class="main_container">
	<header>
		<?php require_once "header.php"; 
		?>
	
	</header>
	<div class="content">
		<div class="in_content">

			<h2>Profil użytkownika</h2>
			<br/><br/>
			<form method = "post">
				<table>
				
			<tr><td><b>Nick:  </b></td><td><input type = "text" value="<?php
				if (isset($_SESSION['fr_nick']))
				{
					echo $_SESSION['fr_nick'];
					unset($_SESSION['fr_nick']);
				}
				else
				{
				echo $_SESSION['user'];
				}
				?>" name = "nick" /></td>
			</tr>
			<tr><td></td><td><?php
				if(isset($_SESSION['e_nick']))
				{
					echo '<div class = "error">'.$_SESSION['e_nick'].'</div>';
					unset($_SESSION['e_nick']);
				}
				?>
			</td></tr>	
				
			<tr><td><b>Imie:  </b></td><td><input type = "text" value="<?php
				if (isset($_SESSION['fr_firstname']))
				{
					echo $_SESSION['fr_firstname'];
					unset($_SESSION['fr_firstname']);
				}
				else
				{
					echo $_SESSION['first_name'];
				}
				?>" name = "firstname" /></td>
			</tr>
			<tr><td></td><td><?php
				if(isset($_SESSION['e_firstname']))
				{
					echo '<div class = "error">'.$_SESSION['e_firstname'].'</div>';
					unset($_SESSION['e_firstname']);
				}
				?>
			</td></tr>
			<tr><td><b>Nazwisko:  </b></td><td><input type = "text" value="<?php
				if (isset($_SESSION['fr_lastname']))
				{
					echo $_SESSION['fr_lastname'];
					unset($_SESSION['fr_lastname']);
				}
				else
				{
					echo $_SESSION['last_name'];
				}
				?>" name = "lastname" /> </td>
			</tr>
			<tr><td></td><td><?php
				if(isset($_SESSION['e_lastname']))
				{
					echo '<div class = "error">'.$_SESSION['e_lastname'].'</div>';
					unset($_SESSION['e_lastname']);
				}
				?>
			</td></tr>
			<tr><td><b>number:  </b></td><td><input type= "text" value="<?php
				if (isset($_SESSION['fr_number']))
				{
					echo $_SESSION['fr_number'];
					unset($_SESSION['fr_number']);
				}
				else
				{
					echo $_SESSION['tel_number'];
				}
				?>" name = "number" /></td>
			</tr>
			<tr><td></td><td><?php
				if(isset($_SESSION['e_number']))
				{
					echo '<div class = "error">'.$_SESSION['e_number'].'</div>';
					unset($_SESSION['e_number']);
				}
				?>
			</td></tr>
			<tr><td><b>address:  </b></td><td><input type= "text" value="<?php
				if (isset($_SESSION['fr_address']))
				{
					echo $_SESSION['fr_address'];
					unset($_SESSION['fr_address']);
				}
				else
				{
					echo $_SESSION['address'];
				}
				?>" name = "address" /></td>
				</tr>
			<tr><td></td><td><?php
				if(isset($_SESSION['e_address']))
				{
					echo '<div class = "error">'.$_SESSION['e_address'].'</div>';
					unset($_SESSION['e_address']);
				}
				?>
			</td></tr>

			<tr><td><b>city:  </b></td><td><input type= "text" value="<?php
				if (isset($_SESSION['fr_city']))
				{
					echo $_SESSION['fr_city'];
					unset($_SESSION['fr_city']);
				}
				else
				{
					echo $_SESSION['city'];
				}
				?>" name = "city" /></td>
			</tr>
			<tr><td></td><td><?php
				if(isset($_SESSION['e_city']))
				{
					echo '<div class = "error">'.$_SESSION['e_acity'].'</div>';
					unset($_SESSION['e_city']);
				}
				?>
			</td></tr>	
			<tr><td><b>country:  </b></td><td><input type= "text" value="<?php
				if (isset($_SESSION['fr_country']))
				{
					echo $_SESSION['fr_country'];
					unset($_SESSION['fr_country']);
				}
				else
				{
					echo $_SESSION['country'];
				}
				?>" name = "country" /></td>
				</tr>
				<tr><td></td><td><?php
				if(isset($_SESSION['e_country']))
				{
					echo '<div class = "error">'.$_SESSION['e_country'].'</div>';
					unset($_SESSION['e_country']);
				}
				?>
			</td></tr>	

			<tr><td><b>post_code:  </b></td><td><input type= "text" value="<?php
				if (isset($_SESSION['fr_post_code']))
				{
					echo $_SESSION['fr_post_code'];
					unset($_SESSION['fr_post_code']);
				}
				else
				{
					echo $_SESSION['post_code'];
				}
				?>" name = "post_code" /><br/></td>
				</tr>
			<tr><td></td><td><?php
				if(isset($_SESSION['e_post_code']))
				{
					echo '<div class = "error">'.$_SESSION['e_post_code'].'</div>';
					unset($_SESSION['e_post_code']);
				}
				?>
			</td></tr>
				</table>
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
	