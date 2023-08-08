<?php
include "config.php";

if(empty($_POST['username'])){
 echo " UserName is empty! ";
 return false;
}
else if (empty($_POST['password'])){
  echo " Password is empty! ";
  return false;
}
else{
 $username = $_POST['username'];
 $password = $_POST['password'];
 $string = "SELECT * FROM Usuario
 WHERE Usuario.Usuario = '" .$username . "' AND Usuario.Password = '" .$password."';";
 $query =$conn->query($string);
 if($query->num_rows){
   session_start();
   $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
   $_SESSION["IDUsuario"] = $row['IDUsuario'];
   if($_SESSION["IDUsuario"] != 1) header("location: home.php");
   else header("location: admin.php");
 }
 else{
   echo " Accesso Denegado ";
 }
}
?>