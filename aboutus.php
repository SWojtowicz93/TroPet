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
                    <h2> O NAS I NIE TYLKO</h2>
                </div>
            </div>
		        <img class="first" src = "src/dog.jpg">
	        </div>
        </div>

        <div class="content_about">
            <div class = "about_cont_left">
            <h3>Lorem ipsum dolor sit amet</h3>  <br/>  
            <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip 
                ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse 
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, 
                sunt in culpa qui officia deserunt mollit anim id est laborum."	
            </p>    
            <br/> 
            <h3>Lorem ipsum dolor sit amet</h3>   
            <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,
                sunt in culpa qui officia deserunt mollit anim id est laborum."	
            </p> 
            <br/> <br/>
            </div>
            <div class = "about_cont_right">
            <img src = "src\daisy.jpg">
            </div>
        </div> 

        <div class="content_about">
            <div class = "about_cont_right">
   
            <img src = "src\IMG_20210404_165713.jpg">
            <br/> <br/>
            </div>
            <div class = "about_cont_left">
            <h3>Lorem ipsum dolor sit amet</h3>  <br/>  
            <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,
                sunt in culpa qui officia deserunt mollit anim id est laborum."	
            </p> 
            <br/>  
            <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,
                sunt in culpa qui officia deserunt mollit anim id est laborum."	
            </p> 
            </div>
        </div> 

        <?php
            require_once "footer.php";
        ?>   
    </div>    


    </div>
</body>
</html>	
	