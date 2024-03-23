<?php

   $host = "atlas.dsv.su.se";
   $database = "db_21370799";
   $username = "usr_21370799";
   $password = "370799";
   $port = "3306";
         
   $connection = new mysqli($host, $username, $password, $database, $port);
    
   
   $allInfo = "SELECT DISTINCT *
                  FROM product
		  ";

   $result = $connection->query($allInfo);

   while ($row = $result->fetch_assoc()){

         echo($row['name'])."  ";
         echo($row['pris'])." ";
         echo($row['rea'])." ";    
         echo($row['typ'])."  ";
         echo($row['mimetype'])."  ";
         echo($row['filename'])."  ";
         echo($row['bild'])."  ";
         echo "<br>";
      
    }        



   $connection->close();
  
   

?>