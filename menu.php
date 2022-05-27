<div class="menu">
	<div class="el_menu"><a href="user_profil.php">Profil użytkownika</a></div>
	<div class="el_menu"><a href="pet_profiles.php">Twoje ogłoszenia</a></div>
	<div class="el_menu"><a href="add_pet.php">Zgłoś zaginięcie</a></div>
	<div class="el_menu"><a href="index.php">Ogłoszenia</a></div>
	<div class="el_menu"><a href="aboutus.php">O nas</a></div>
	<div class="el_menu"><a href="writetous.php">Napisz do nas</a></div>	
	<?php 
		if ($_SESSION['zalogowany'] == true)
			{
	?>
			<div class="el_menu"><a href="logout.php">Wyloguj</a></div>	
	<?php
		
		}
		else
		{
	?>
			<div class="el_menu"><a href="logout.php">Zaloguj</a></div>
	<?php	
		}
	?>
</div>	