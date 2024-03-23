function confirmItem(){

     
        
       alert("Product added!");

}

function addProduct(s){
    fetch('AddProduct.php?name='+encodeURIComponent(s))
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });

 
   document.location.reload(true);
}

function removeProduct(s){
    fetch('RemoveProduct.php?name='+encodeURIComponent(s))
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
   
   document.location.reload(true);
}
  



