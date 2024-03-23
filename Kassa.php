<?php

  header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
  header("Pragma: no-cache");
  header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
       
  session_start();

  if(isset($_SESSION['products'])){
     $host = "atlas.dsv.su.se";
     $database = "db_21370799";
     $username = "usr_21370799";
     $password = "370799";
     $port = "3306";
      
	  $connection = new mysqli($host, $username, $password, $database, $port);
		
      $html = file_get_contents("Kassa.html");
      $delimiter = "<!--===entries===-->";
      $array = explode($delimiter ,$html);

      $mediumblob;


      $allEntries = array();   

      $totalPrice = 0; 

     foreach($_SESSION['products'] as $product => $amount){

       
       
       if($amount>0){  
        
         
         
         $sql = "SELECT * FROM product WHERE name=?";
     
         $preparedQ = $connection -> prepare($sql);
		    
		 $preparedQ -> bind_param("s", $product);
		   
		 $preparedQ -> execute();
		   
		   
		 $results = $preparedQ -> get_result();
		   
		   
		   
		   
		   $intermediateReplace = $array[2];
		  


         while($row = $results -> fetch_assoc()){
			 
			 
			

            

            $newPrice = 0;
         
            $intermediateReplace = str_replace("---namn---", $row['name'], $intermediateReplace);
            
              
             if (!empty($row['rea'])) {

              
              $newPrice = $row['pris']-$row['rea'];	
			  $totalPrice+=$newPrice*$amount;
              $intermediateReplace = str_replace("---pris---", $newPrice, $intermediateReplace);
        
           }  
             else{

            $intermediateReplace = str_replace("---pris---", $row['pris'], $intermediateReplace); 
			$totalPrice+=$row['pris']*$amount;	  

        } 
	  
             $intermediateReplace = str_replace("---image_src---", 'UpdatePicture.php?name='.$row['name'], $intermediateReplace);

             $intermediateReplace = str_replace("---product---", $row['name'], $intermediateReplace);

             $intermediateReplace = str_replace("---antal---", $amount, $intermediateReplace);
    
             
		     array_push($allEntries, $intermediateReplace);   
         
                

          
   
       }
		
		 
    }

 }


      
      
      

    
                 
      $array[3] = str_replace("---Totalt---", $totalPrice,  $array[3]); 

      $array[1] = implode('', $allEntries);

      unset($array[2]);

      $newHtml = implode($delimiter, $array); 
	  
	   
      
      $connection->close();
 
      echo($newHtml);
 

      

 } 
 else{

   $html = file_get_contents("Kassa.html");
   echo($html);


}    



?>
