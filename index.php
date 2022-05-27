<?php
	session_start();
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
            $query = "SELECT * FROM pet WHERE STATUS > 0 ";
            if(isset($_POST['size']) && strlen($_POST['size']) > 0)
            {
                $size_q = $_POST['size'];
                $query = $query." AND SIZE ='$size_q'";
            }
            
            if(isset($_POST['nature']) && strlen($_POST['nature']) > 0)
            {
                $nature_q = $_POST['nature'];
                $query = $query." AND NATURE ='$nature_q'";
            }



			$id = $_SESSION['id'];
			if($rezult = $polaczenie->query($query))
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
                    <h2> Zaginione Pupile</h2>
                </div>
            </div>
		        <img class="first" src = "src/dog.jpg">
	        </div>
        </div>	

        <div class="annoucment_cont">
            <div class = "annoucment_cont_left">	
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
                                    echo"<td><b>Wielkość pupila: </b>".$lin['SIZE']." </td>";
                                    echo"</tr>";
                                    echo"<tr>";
                                    echo"<td><b>Umaszczenie: </b>". $lin['COLOR']. "</td>";
                                    echo"</tr>";
                                    echo"<tr>";
                                    echo"<td><b>Zachowanie: </b>". $lin['NATURE']. "</td>";
                                    echo"</tr>";
                                    $petid = $lin['PET_ID'];
                                    echo"<form action = \"pet_annoucment.php\" method = \"post\">";
                                    echo "<input type = \"hidden\" name = \"id_pet\" value = \"$petid\" />";
                                    echo"<tr>";
                                    echo"<td></td><td><input type = \"submit\" class=\"button\" value=\"Wiecej\"></td>";
                                    echo"</form>";
                                    echo"</tr>";
                                    echo "</Table>";
                                echo "</div>";
                            echo"</div>";
                        }
        // usunięcie rezultatów
                        $rezult->free_result();
                            
                            }
        // else don't find pet wit this filter                    
                            else
                            {
                                ?>
                                <div class="main_container">
                                <header>
                                    <?php require_once "header2.php"; 
                                    ?>
                                    
                                </header>
                                <div class="content">
                                    
                                   <h2> Profile Pupili</h2>
                        
                                </div>
                                <div class="annoucment_cont">
                                    <div class = "annoucment_cont_left">	
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
                                                            echo"<td><b>Wielkość pupila: </b>".$lin['SIZE']." </td>";
                                                            echo"</tr>";
                                                            echo"<tr>";
                                                            echo"<td><b>Umaszczenie: </b>". $lin['COLOR']. "</td>";
                                                            echo"</tr>";
                                                            echo"<tr>";
                                                            echo"<td><b>Zachowanie: </b>". $lin['NATURE']. "</td>";
                                                            echo"</tr>";
                                                            
                                                            echo"<tr>";
                                                            echo"<td></td><td><a href = \"prof_edit.php\"> <button class=\"button\" role=\"button\">Edytuj</button></td>";
                                                            echo"</tr>";
                                                            echo "</Table>";
                                                        echo "</div>";
                                                    echo"</div>";
                                                }

                            }

        // else don't find pet wit this filter





                        $polaczenie->close();
                        }
                        else
                        {
                            echo "dupa222222";
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
            </div>
            <div class = "annoucment_cont_right">
                <div class="sercher">
                    <form method = "post">
                        <section class="sauce-selection">
                            <label for="breed">Rasa Pupila:</label><br>
                            <input list="breeds" id="breed" name="breed" placeholder="Wpisz rase">
                            <datalist id="breeds">
                             <?php require_once "breed.html";
                              ?>
                            </datalist>
                        </section>
                        </br>
                        Umaszczenie:<br/><input type= "text" name = "color" /><br/> 
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
                            <section class="nature-type">
                                <label for="nature">Usposobienie:</label>
                                </br>
                                <!-- Wielkość listy rozwijanej -->
                                <!--  onfocus='this.size=6;' onblur='this.size=6;' onfocusout='this.size=null;' onchange='this.size=6; this.blur();'> -->
                                <select name="nature" id="nature">
                                <option value=""></option>
                                <option value="sesame">Łagodny</option>
                                <option value="potatoe">Agresywny</option>

                            </select>
                        </section>
                        </br>
                        <section class="sauce-selection">
                            <label for="sector">Województwo:</label><br>
                            <input list="sectors" id="sector" name="sector" placeholder="Wpisz województwo">
                            <datalist id="sectors">
                            <option value="Dolnośląskie"></option>
                            <option value="Kujawsko-pomorskie"></option>
                            <option value="Lubelskie"></option>
                            <option value="Lbuskie"></option>
                            <option value="Łódzkie"></option>
                            <option value="Małopolskie"></option>
                            <option value="Mazowieckie"></option>
                            <option value="Opolskie"></option>
                            <option value="Podkarpackie"></option>
                            <option value="Podlaskie"></option>
                            <option value="Pomorskie"></option>
                            <option value="Śląskie"></option>
                            <option value="Świętokrzyskie"></option>
                            <option value="Warmińsko-mazurskie"></option>
                            <option value="Wielkopolskie"></option>
                            <option value="Zachodniopomorskie"></option>
                            </datalist>
                        </section>
                        </br>
                        <section class="sauce-selection">
                            <label for="breed">Miejscowość:</label><br>
                            <input list="breeds" id="breed" name="breed" placeholder="Wpisz miejscowość">
                            <datalist id="breeds">
                            <option value="ketchup"></option>
                            <option value="mayo"></option>
                            <option value="mustard"></option>
                            </datalist>
                        </section>
                      </br>
                      <input type = "submit" value = "Szukaj" />
                    </form>
                </div>
                <div class="sercher">	
            <A href = "add_pet.php"> <button class="button" role="button">Zgłoś zaginięcie pupila</button> </a>
        </div>
            </br>
            </div>    
        </div>    

        <?php
            require_once "footer.php";
        ?>
    </div>
</body>
</html>	
	