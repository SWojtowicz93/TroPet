<?php
	session_start();
	$id = $_POST['id_pet'];
	if(isset($_POST['pet_name']))
	{
//Udana walidacja?
		$everything_OK = true;
// Sprawdzenie imie pupila	
		$pet_name = $_POST['pet_name'];
		if((strlen($pet_name)<2 || (strlen($pet_name)>20)))
		{
			$everything_OK = false;
			$_SESSION['e_pet_name'] = "Imię pupila musi posiadać od 2 do 20 znaków!";
		}
		if(ctype_alnum($pet_name)==false)
		{
			$everything_OK = false;
			$_SESSION['e_pet_name'] = "Imie pupila może posiadać tylko litery (bez polskich znaków)";
		}
// Sprawdzenie rasy	
		$breed = $_POST['breed'];
		if((strlen($breed)<2 || (strlen($breed)>20)))
		{
			$everything_OK = false;
			$_SESSION['e_breed'] = "Rasa musi posiadać od 2 do 20 znaków!";
		}
		if(ctype_alnum($breed)==false)
		{
			$everything_OK = false;
			$_SESSION['e_breed'] = "rasa może posiadać tylko litery (bez polskich znaków)";
		}
		
// Sprawdzenie wielkosci	
		$size = $_POST['size'];
		if((strlen($size)<2 || (strlen($size)>20)))
		{
			$everything_OK = false;
			$_SESSION['e_size'] = "wielkosc musi posiadać od 2 do 20 znaków!";
		}
		if(ctype_alnum($size)==false)
		{
			$everything_OK = false;
			$_SESSION['e_size'] = "wielkosc może posiadać tylko litery (bez polskich znaków)";
		}
	
// Sprawdzenie umaszczenia	
		$color = $_POST['color'];
		if((strlen($color)<2 || (strlen($color)>20)))
		{
			$everything_OK = false;
			$_SESSION['e_color'] = "umaszczenia musi posiadać od 2 do 20 znaków!";
		}
		if(ctype_alnum($color)==false)
		{
			$everything_OK = false;
			$_SESSION['e_color'] = "umaszczenia może posiadać tylko litery (bez polskich znaków)";
		}
// Sprawdzenie usposobieinia	
		$nature = $_POST['nature'];
		if((strlen($nature)<2 || (strlen($nature)>20)))
		{
			$everything_OK = false;
			$_SESSION['e_nature'] = "usposobieinia musi posiadać od 2 do 20 znaków!";
		}
//Zapamiętanie wprowadzonych danych	
	
		$_SESSION['fr_pet_name'] = $pet_name;
		$_SESSION['fr_breed'] = $breed;	
		$_SESSION['fr_size'] = $size;	
		$_SESSION['fr_color'] = $color;	
		$_SESSION['fr_nature'] = $nature;
		
		
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
					if($polaczenie->query("UPDATE pet SET PET_NAME='$pet_name', BREED='$breed', SIZE='$size', COLOR='$color', NATURE='$nature', STATUS=1 WHERE PET_ID=$id"))
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
	<div class="container">		
	        <div class = "zdj">
                <div class="title">
                    
                <div class="title-bg">
                    <h2> Profil pupila</h2>
                </div>
            </div>
		        <img class="first" src = "src/dog.jpg">
	        </div>
        </div>
<div class="content">
	<div style = "width: 100%; text-align:left; margin-left: 10px; margin-top: 10px;">
	
	
	<form method = "post">
		
		Imie pupila:<br/><input type = "text" value="<?php
		if (isset($_SESSION['fr_pet_name']))
		{
			echo $_SESSION['fr_pet_name'];
			unset($_SESSION['fr_pet_name']);
		}
		?>" name = "pet_name" /> <br/>
		<?php
		if(isset($_SESSION['e_pet_name']))
		{
			echo '<div class = "error">'.$_SESSION['e_pet_name'].'</div>';
			unset($_SESSION['e_pet_name']);
		}
		?>
	</br>

		<section class="sauce-selection">
          <label for="breed">Rasa Pupila:</label><br>
          <input list="breeds" id="breed" name="breed" placeholder="Wpisz rase">
          <datalist id="breeds">
            <option value="ketchup"></option>
            <option value="mayo"></option>
            <option value="mustard"></option>
          </datalist>
        </section>
	</br>

		<!-- Rasa:<br/><input type = "text" value=" --><?php 
		// if (isset($_SESSION['fr_breed']))
		// {
			// echo $_SESSION['fr_breed'];
			// unset($_SESSION['fr_breed']);
		// }
		?><!--" name = "breed" /><br/>-->
		<?php
		if(isset($_SESSION['e_breed']))
		{
			echo '<div class = "error">'.$_SESSION['e_breed'].'</div>';
			unset($_SESSION['e_breed']);
		}
		?>
		
		Umaszczenie:<br/><input type= "text" value="<?php
		if (isset($_SESSION['fr_color']))
		{
			echo $_SESSION['fr_color'];
			unset($_SESSION['fr_color']);
		}
		?>" name = "color" /><br/> 
		<?php
		if(isset($_SESSION['e_color']))
		{
			echo '<div class = "error">'.$_SESSION['e_color'].'</div>';
			unset($_SESSION['e_color']);
		}
		?>
	</br>

		<section class="size-type">
        	<label for="size">Wielkość:</label>
				</br>
				<!-- Wielkość listy rozwijanej -->
				<!--  onfocus='this.size=6;' onblur='this.size=6;' onfocusout='this.size=null;' onchange='this.size=6; this.blur();'> -->
         		<select name="size" id="size">
					<option value=""></option>
					<option value="Maly">Mały</option>
					<option value="Sredni">Średni</option>
					<option value="Duzy">Duży</option>

          		</select>
        </section>

	</br>

		<!-- Wielkosść:<br/><input type = "text" value=" --> <?php
		// if (isset($_SESSION['fr_size']))
		// {
			// echo $_SESSION['fr_size'];
			// unset($_SESSION['fr_size']);
		// }
		?><!--" name = "size" /> --> 
		<?php
		if(isset($_SESSION['e_size']))
		{
			echo '<div class = "error">'.$_SESSION['e_size'].'</div>';
			unset($_SESSION['e_size']);
		}
		?>
		<input type = "hidden" name = "id_pet" value = <?php echo"'$id'"?> />
		<section class="nature-type">
        	<label for="nature">Usposobienie:</label>
				</br>
				<!-- Wielkość listy rozwijanej -->
				<!--  onfocus='this.size=6;' onblur='this.size=6;' onfocusout='this.size=null;' onchange='this.size=6; this.blur();'> -->
         		<select name="nature" id="nature">
					<option value=""></option>
					<option value="Łagodny">Łagodny</option>
					<option value="Agresywny">Agresywny</option>

          		</select>
        </section>


		<!-- Usposobienie:<br/><input type= "text" value=" -->
		<?php /*
		if (isset($_SESSION['fr_nature']))
		{
			echo $_SESSION['fr_nature'];
			unset($_SESSION['fr_nature']);
		}
		*/?>
		<!-- " name = "nature" /> -->
		<br/>
		<?php
		if(isset($_SESSION['e_nature']))
		{
			echo '<div class = "error">'.$_SESSION['e_nature'].'</div>';
			unset($_SESSION['e_nature']);
		}
		?>	
		<input type = "submit" class="button" value = "Dodaj pupila" />

	
	</form>
	<?php
			if(isset($_SESSION['blad']))
				echo $_SESSION['blad'];
	?>
	</div>
	</div>
	<?php
		require_once "footer.php";
	?>
</div>	
</body>
</html>	
	