<?php

    session_start();
   
    $host = "atlas.dsv.su.se";
    $database = "db_21370799";
    $username = "usr_21370799";
    $password = "370799";
    $port = "3306";

    $conn = new mysqli($host, $username, $password, $database, $port);

    $containsP = 0;
    $session_ID = session_id();

  if(isset($_SESSION['products'])){

    foreach($_SESSION['products'] as $product => $amount){


    if($amount>0){


      $containsP = 1;
     }
 
    }
 

}


    if(isset($_POST['Förnamn'])&&isset($_POST['Efternamn'])&&isset($_POST['Email'])&&isset($_POST['Adress'])&&$containsP==1){


	 $fornamn = $_POST['Förnamn'];
     $efternamn = $_POST['Efternamn']; 
     $email = $_POST['Email']; 
     $adress = $_POST['Adress']; 
		
	 $sql = "INSERT INTO finished_order(fornamn, efternamn, email, adress, order_ID) VALUES (?, ?, ?, ?, ?)";
		 
     $preparedQ = $conn->prepare($sql);
		
	 $preparedQ -> bind_param('sssss',$fornamn ,$efternamn , $email , $adress, $session_ID);
		
	 $preparedQ -> execute();	
   

    foreach($_SESSION['products'] as $product => $amount){
 
     if($amount>0){
           
            $sql = "INSERT INTO quantity(name, antal, session_ID) VALUES (?, ?, ?)";

            $preparedQ = $conn -> prepare($sql);
    
            $preparedQ -> bind_param('sis', $product, $amount, $session_ID);

            $preparedQ -> execute();

    }

   
   
 

    }
		
		

 
    

     session_unset();


     session_destroy();

      


}



    

      header("location: Kassa.php");
      exit(); 
    






?>