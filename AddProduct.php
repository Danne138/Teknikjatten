<?php

  header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
  header("Pragma: no-cache");
  header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
  


   if (session_status() == PHP_SESSION_NONE){

        session_start();
        $sessionID = session_id();

        if(!isset($_SESSION['products'])){ 

        $_SESSION['products'] = array();

        $host = "atlas.dsv.su.se";
        $database = "db_21370799";
        $username = "usr_21370799";
        $password = "370799";
        $port = "3306";
         
        $connection = new mysqli($host, $username, $password, $database, $port);

        $sql = "SELECT name FROM product";
     
        $query = $connection -> query($sql);

        while($row = $query->fetch_assoc()){

             $_SESSION['products'][$row['name']] = 0;



         }

    }
        
        

      }

   

   if ($_SERVER["REQUEST_METHOD"] == "POST"){
    
      $name = $_POST["name"];
      $_SESSION['products'][$name]++;
   


}

 if(isset($_GET['name'])){
   
   $name = $_GET['name'];
   $_SESSION['products'][$name]++;

  
 
}

 
     header('Location: ' . $_SERVER['HTTP_REFERER']);
     exit;


   

?>