<?php

   $host = "atlas.dsv.su.se";
   $database = "db_21370799";
   $username = "usr_21370799";
   $password = "370799";
   $port = "3306";
         
   $conn = new mysqli($host, $username, $password, $database, $port);


   $sql = "UPDATE product SET typ = 'Laptop' WHERE name='HP 2132'";

   if ($conn->query($sql) === TRUE) {
    
     echo "Added successfully";
} 
   


$conn->close();
  
   

?>