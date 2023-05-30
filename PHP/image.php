<?php
require 'connection.php';
if(isset($_POST["submit"])){
  $name = $_POST["name"];
  if($_FILES["Registre_commerce_Org"]["error"] == 4){
    echo
    "<script> alert('Image Does Not Exist'); </script>"
    ;
  }
  else{
    $fileName = $_FILES["Registre_commerce_Org"]["name"];
    $fileSize = $_FILES["Registre_commerce_Org"]["size"];
    $tmpName = $_FILES["Registre_commerce_Org"]["tmp_name"];

    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = explode('.', $fileName);
    $imageExtension = strtolower(end($imageExtension));
    if ( !in_array($imageExtension, $validImageExtension) ){
      echo
      "
      <script>
        alert('Invalid Image Extension');
      </script>
      ";
    }
    else if($fileSize > 1000000){
      echo
      "
      <script>
        alert('Image Size Is Too Large');
      </script>
      ";
    }
    else{
      $newImageName = uniqid();
      $newImageName .= '.' . $imageExtension;

      move_uploaded_file($tmpName, 'img/' . $newImageName);
      $query = "INSERT INTO organisateur VALUES('', '$name', '$newImageName')";
      mysqli_query($conn, $query);
      echo
      "
      <script>
        alert('Successfully Added');
        document.location.href = 'login.html';
      </script>
      ";
    }
  }
}
?>