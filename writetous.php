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
                    <h2> Napisz do nas</h2>
                </div>
            </div>
		        <img class="first" src = "src/dog.jpg">
	        </div>
        </div>

    <div class="content">
    <form action="/action_page.php">
        <label for="first_name">Imie</label>
        <input type="text" class="input_contact" id="first_name" name="firstname" placeholder="Podaj Twoje Imie..">
        
        <label for="addres_email">Adres Email</label>
        <input type="text" class="input_contact" id="addres_email" name="email" placeholder="Podaj Adres Email..">

        <label for="temat">Temat</label>
        <select id="temat" name="temat">
        <option value="Problem z stroną">Problem z stroną</option>
        <option value="Propozycja zmian">Propozycja zmian</option>
        <option value="Wsparcie">Wsparcie</option>
        <option value="Inne">Inne</option>
        </select>

        <label for="subject">Subject</label>
        <textarea id="subject" name="subject" placeholder="Napisz wiadomość.." style="height:200px"></textarea>

        <input type="submit" class="input_contact" value="Submit">
    </form>
    </div>
</div>
</body>
</html>
