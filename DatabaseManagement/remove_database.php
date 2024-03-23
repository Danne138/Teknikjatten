<?php

   $host = "atlas.dsv.su.se";
   $database = "db_21370799";
   $username = "usr_21370799";
   $password = "370799";
   $port = "3306";
         
   $connection = new mysqli($host, $username, $password, $database, $port);



   

   $table = "CREATE TABLE product(
      
	   
           
           name VARCHAR(255) PRIMARY KEY,
           pris INT,
           bild MEDIUMTEXT,
           typ VARCHAR(255),
           mimetype VARCHAR(255),
           filename VARCHAR(255),
           FOREIGN KEY (name) REFERENCES quantity(name)

    )";

    $connection->query($table);

          


    



$connection->close();
  
   

?>