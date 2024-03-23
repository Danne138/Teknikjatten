<script>

      fetch('UpdatePicture.php')
            .then(response => response.json())
            .then(data => {
                
                console.log(data.message);
            })
            .catch(error => {
                
                console.error('Error:', error);
     });
    
   


</script>