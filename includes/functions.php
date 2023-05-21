<?php

function secure(){
   if(!isset($_SESSION['id'])){
      setMessage("Najpierw logowanie");
      echo "<script type='text/javascript'>window.location.href='http://localhost/project_2/'</script>";
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
      echo "<p class='sessionMsg'>" . $_SESSION['message'] . "<p/>";
      unset($_SESSION['message']);
   }
}


?>    