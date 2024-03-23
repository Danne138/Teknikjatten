<?php 
ob_start();
?>
<?php 
    


     $host = "atlas.dsv.su.se";
     $database = "db_21370799";
     $username = "usr_21370799";
     $password = "370799";
     $port = "3306";
         
     $connection = new mysqli($host, $username, $password, $database, $port);

     if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
     }
     
     $name = $_GET['name'];
  
     $sql = "SELECT *
             FROM product
             WHERE name = ?";

     $preparedQuery = $connection->prepare($sql);
  
     $preparedQuery->bind_param("s", $name);

     $preparedQuery->execute();


     $result = $preparedQuery -> get_result();

     $filePath;

     while($row = $result->fetch_assoc()){

        echo($row['mimetype']);	
        $mimeType = $row['mimetype'];
        $blob = $row['bild'];
        $filePath = 'Produkter/'.$row['filename'];
        $decodedData = base64_decode($row['bild']);
        file_put_contents($filePath, $decodedData, FILE_APPEND);
  
        header("Content-type: $row[mimetype]");
        ob_clean();
        flush(); 
        readfile($filePath); 
         
        
 }
 
   $connection->close();


    

?>
<?php
ob_end_flush();
?>