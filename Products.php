<?php

     header("Cache-Control: no-store, no-cache, must-revalidate");
      header("Pragma: no-cache");
      header("Expires: 0");

     $host = "atlas.dsv.su.se";
     $database = "db_21370799";
     $username = "usr_21370799";
     $password = "370799";
     $port = "3306";
         
     $connection = new mysqli($host, $username, $password, $database, $port);

     if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
     }
     
     
     $type = $_GET['type'];
 
     $allInfo = '';

     if($type=='rea'){
		 
		 
	 $allInfo = "SELECT DISTINCT *
                 FROM product
                 WHERE rea > 0";	 
		 
		 
	 }

     else{
     $allInfo = "SELECT DISTINCT *
                 FROM product
                 WHERE typ = ?";
	 }
     $preparedQ = $connection->prepare($allInfo);

   if($type!='rea'){
     $preparedQ->bind_param("s", $type);
}

     $preparedQ->execute();

 
     $result = $preparedQ->get_result();

     $html = '';
       
     if($type=='rea'){
		 
		 
	 $html = file_get_contents("Home.html");	 
		 
		 
      }	
     else{
     
    $html = file_get_contents("Products.html");

}
      $delimiter = "<!--===entries===-->";
      $array = explode($delimiter ,$html);

      $mediumblob;


      $allEntries = array();   

      while ($row = $result->fetch_assoc()){


         $newPrice = 0;
         

         $intermediateReplace = $array[2];
         
         $intermediateReplace = str_replace("---namn---", $row['name'], $intermediateReplace);
         if (!empty($row['rea'])) {
  
          $newPrice = $row['pris']-$row['rea'];     
          $intermediateReplace = str_replace("---rea---", $row['rea'], $intermediateReplace);
          $intermediateReplace = str_replace("---pris---", $newPrice, $intermediateReplace);
   
       }  

          else{
         
           $intermediateReplace = str_replace("---pris---", $row['pris'], $intermediateReplace);
           $intermediateReplace = str_replace("Rea: ---rea---", '', $intermediateReplace);
   
          
        } 
          
        
        
	  
         $intermediateReplace = str_replace("---image_src---", 'UpdatePicture.php?name='.$row['name'], $intermediateReplace);

         $intermediateReplace = str_replace("---product---", $row['name'], $intermediateReplace);   
		  
         
                

         array_push($allEntries, $intermediateReplace);
      
    }  

    
                 
      

      $array[1] = implode('', $allEntries);

      unset($array[2]);

      $newHtml = implode($delimiter, $array);             
      
      $connection->close();
 
      echo($newHtml);


      



?>