<?php
	session_start();
	if((!isset($_POST['login'])) || (!isset($_POST['haslo']))) {
	header('Location: log_in.php');
	exit();
}
	
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
		$login = $_POST['login'];
		$haslo = $_POST['haslo'];
	// wstrzykiwanie msql
		$login = htmlentities($login,ENT_QUOTES, "UTF-8");
	// ZAPYTANIE DO BAZY
		if($rezult = @$polaczenie->query(sprintf("SELECT * FROM uzytkownik WHERE user = '%s'",
		mysqli_real_escape_string($polaczenie,$login))));
		{
	//sprawdzenie ile wierszy zostało zwróconych
			$user_exist = $rezult->num_rows;
			if($user_exist>0)
			{
	//Wyciąganie poszcególnych danych z bzy danych
				$line = $rezult->fetch_assoc();
				
				if(password_verify($haslo, $line['pass']))
				{
	// twożenie zmiennej potwierdzające zalogowanie
					$_SESSION['zalogowany'] = true;
	//Wyciąganie poszcególnych danych z bzy danych
					
					$_SESSION['id'] = $line['id_user'];
					$_SESSION['user'] = $line['user'];
					$id = $_SESSION['id'];
					
	// usunięcie błędu o złym logowaniu
					unset($_SESSION['blad']);
	// usunięcie rezultatów
					$rezult->free_result();
				}
				else
				{
	// komunikat o błędzie logowania			
					$_SESSION['blad'] = '<span style = "color:red">Nieprawidłowy
					login lub hasło!(hash)</span>';
					header('Location: index.php');
				}
			}
			else
			{
	// komunikat o błędzie logowania			
				$_SESSION['blad'] = '<span style = "color:red">Nieprawidłowy
				login lub hasło!</span>';
				header('Location: index.php');
			}
		}



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
					
					$_SESSION['first_name'] = $line['first_name'];
					$_SESSION['last_name'] = $line['last_name'];
					$_SESSION['tel_number'] = $line['tel_number'];
					$_SESSION['address'] = $line['address'];					
					$_SESSION['city'] = $line['city'];
					$_SESSION['country'] = $line['country'];
					$_SESSION['post_code'] = $line['post_code'];					
	// usunięcie rezultatów
					$rezult->free_result();
					header('Location: index.php');
				
			}
			else
			{
	// komunikat o błędzie logowania			
				$_SESSION['blad'] = '<span style = "color:red">Nieprawidłowy
				login lub hasło!</span>';
				header('Location: index.php');
			}
		}

	
		








		
	// zamknięcie połączenia
		$polaczenie->close();
	}




?>
