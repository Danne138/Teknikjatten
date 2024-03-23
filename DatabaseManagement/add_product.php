<?php

   $host = "atlas.dsv.su.se";
   $database = "db_21370799";
   $username = "usr_21370799";
   $password = "370799";
   $port = "3306";
         
   $connection = new mysqli($host, $username, $password, $database, $port);
    
   $connection->begin_transaction();


    try{

      $filePath = "Produkter/sony_235.jpeg";
      $fileContents = file_get_contents($filePath);
      $encodedData = base64_encode($fileContents);
      $fileName = basename($filePath);
      $name = "Sony 235";
      $value = 1500;
      $type = "Hörlur";
      $mimeType = "image/jpeg";
       
      $quantityQuery = "INSERT INTO quantity (name) VALUES (?)";
      $quantityStatement = $connection->prepare($quantityQuery);
      $quantityStatement->bind_param('s', $name);
      $quantityStatement->execute();      

      $forminfo = "INSERT product(name, pris, bild, typ, mimetype, filename)
                  VALUES(?, ?, ?, ?, ?, ?)"; 

      $preparedQ = $connection->prepare($forminfo);
      $preparedQ->bind_param('sissss', $name, $value, $encodedData, $type, $mimeType, $fileName);
      $preparedQ->execute();
   
      $connection->commit();
     

  }

 
  catch (Exception $e) {
    // Rollback the transaction in case of any errors
    $connection->rollback();
    echo "Error: " . $e->getMessage();
}
          


    



$connection->close();
  
   

?>