<?php
     $conn = mysqli_connect("localhost", "nishant", "test123", "book_db");

     // Check the connection
     if(!$conn){
         echo "Connection Error: " . mysqli_connect_error();
     }
?>