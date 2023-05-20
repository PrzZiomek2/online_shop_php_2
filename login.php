<?php 

include('includes/database.php');


include('includes/header.php');

if(isset($_POST["email"])){
   if(empty($_POST["email"]) || empty($_POST["password"])){
      setMessage("pola email i hasło powinny być wypełnione");
   }else{
      if($stm = $connect -> prepare("SELECT * FROM users WHERE email = ? AND password = ? AND active = 1")){
         $hashed = SHA1($_POST['password']);
         $stm -> bind_param("ss", $_POST['email'], $hashed);
         $stm -> execute();
         $result = $stm -> get_result();
         $user = $result -> fetch_assoc();
   
         if($user){
            $_SESSION["id"] = $user["id"];
            $_SESSION["email"] = $user["email"];
            $_SESSION["username"] = $user["username"];
            setMessage("Pomyślnie zalogowano");
   
            header("Location: dashboard.php"); 
            die();
         }
         else{
            setMessage("Niepoprawny email lub hasło");
         }
   
         $stm -> close();
   
      }else{ 
         echo "fetching user data failed!";
      }
   }
}

?>

<?php

getMessage();

 ?>
<div class="container mt-5">
   <div class="row justify-content-center">
      <div class="col-md-6">
         <form method="post">
            <div class="form-outline mb-4">
               <input type="email" id="email" name="email" class="form-control" />
               <label class="form-label" for="email">Email</label>
            </div>
            <div class="form-outline mb-4">
               <input type="password" id="password" name="password" class="form-control" />
               <label class="form-label" for="password">Hasło</label>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Zaloguj</button>
      </form>
   </div>
   </div>
</div>
