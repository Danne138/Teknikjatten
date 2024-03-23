<?php 

       $host = "atlas.dsv.su.se";
     $database = "db_21370799";
     $username = "usr_21370799";
     $password = "370799";
     $port = "3306";
         
     $connection = new mysqli($host, $username, $password, $database, $port);
         
      $table = "DELETE FROM quantity WHERE name = 'Sony 235'
";

   $connection->query($table);

?>