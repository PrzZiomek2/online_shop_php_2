<?php

include('includes/database.php');
include('includes/header.php');
secure();

if (isset($_POST['username'])){

    if(empty($_POST['username']) || empty($_POST['email']) || $_POST['password']){ 
        setMessage("Wszystkie pola powinny być wypełnione");
    }
    else{
        if ($stm = $connect->prepare('INSERT INTO users (username,email, password, active) VALUES (?, ?, ?, ?)')){
        
            $hashed = SHA1($_POST['password']);
            $stm->bind_param('ssss', $_POST['username'], $_POST['email'], $hashed,  $_POST['active']);
            $stm->execute();
            
            setMessage("Nowy użytkownik" . $_SESSION['username'] . " został dodany");
            header('Location: users.php');
            $stm->close();
            die();
    
        } else {
            echo 'Could not prepare statement!';
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
        <h1 class="display-1">Dodaj użytkownika</h1>
       
        <form method="post">
                <div class="form-outline mb-4">
                    <input type="text" id="username" name="username" class="form-control" />
                    <label class="form-label" for="username">Użytkownik</label>
                </div>
                <div class="form-outline mb-4">
                    <input type="email" id="email" name="email" class="form-control" />
                    <label class="form-label" for="email">Email</label>
                </div>
                <div class="form-outline mb-4">
                    <input type="password" id="password" name="password" class="form-control" />
                    <label class="form-label" for="password">Hasło</label>
                </div>
                <div class="form-outline mb-4">
                    <select name="active" class="form-select" id="active" >
                        <option value="1">Aktywny</option>
                        <option value="0">Nieaktywny</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Zapisz</button>
            </form>
       
        </div>

    </div>
</div>


<?php


include('includes/footer.php');
?>