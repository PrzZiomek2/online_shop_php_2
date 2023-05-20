<?php

function secure(){
   if(!isset($_SESSION['id'])){
      setMessage("Najpierw logowanie");
      header("Location: /project_2/"); 
      die();
   }
}

function setMessage($msg){
   {
      $_SESSION['message'] = $msg;
   }
}

function getMessage(){
   if(isset($_SESSION['message'])){
      echo "<p>" . $_SESSION['message'] . "<p/>";
      unset($_SESSION['message']);
   }
}


?>    