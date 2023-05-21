<?php

include('includes/database.php');
include('includes/header.php');
secure();

if (isset($_POST['username'])) {

    if(empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password'])){ 
        setMessage("Wszystkie pola powinny być wypełnione");
    }else{
        if ($stm = $connect->prepare('UPDATE users set  username = ?,email = ? , active = ?  WHERE id = ?')) {
            $name_escape = mysqli_real_escape_string($connect, $_POST['username']);
            $email_escape = mysqli_real_escape_string($connect, $_POST['email']);

            $stm->bind_param('sssi', $name_escape, $email_escape, $_POST['active'], $_GET['id']);
            $stm->execute();
    
            $stm->close();
    
            if (isset($_POST['password'])) {
                if ($stm = $connect->prepare('UPDATE users set  password = ? WHERE id = ?')) {
                    $password_escape = mysqli_real_escape_string($connect, $_POST['password']);

                    $hashed = SHA1($password_escape);
                    $stm->bind_param('si', $hashed, $_GET['id']);
                    $stm->execute();
    
                    $stm->close();
    
                } else {
                    echo 'Could not prepare password update statement!';
                }
            }
    
            setMessage("Użytkownik  " . $_GET['id'] . " został zaktualizowany");
            echo("<meta http-equiv='refresh' content='1'>");
            die();
    
        } else {
            echo 'Could not prepare user update statement statement!';
        }
    }

}


if (isset($_GET['id'])) {

    if ($stm = $connect->prepare('SELECT * from users WHERE id = ?')) {
        $stm->bind_param('i', $_GET['id']);
        $stm->execute();

        $result = $stm->get_result();
        $user = $result->fetch_assoc();

        if ($user) {

            ?>
            <?php

            getMessage();

            ?>
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <h1 class="sectionHeader">Edytuj użytkownika</h1>

                        <form method="post">
                            <div class="form-outline mb-4">
                                <input type="text" id="username" name="username" class="form-control active"
                                    value="<?php echo $user['username'] ?>" />
                                <label class="form-label" for="username">Imię i Nazwisko</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input type="email" id="email" name="email" class="form-control active" 
                                    value="<?php echo $user['email'] ?>" />
                                <label class="form-label" for="email">Email</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input type="password" id="password" name="password" class="form-control" />
                                <label class="form-label" for="password">Hasło</label>
                            </div>

                            <!-- Active select -->
                            <div class="form-outline mb-4">
                                <select name="active" class="form-select" id="active">
                                    <option <?php echo ($user['active']) ? "selected" : ""; ?> value="1">Aktywny</option>
                                    <option <?php echo ($user['active']) ? "" : "selected"; ?> value="0">Nieaktywny</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">Zapisz zmiany</button>
                        </form>



                    </div>

                </div>
            </div>


            <?php
        }
        $stm->close();
     

    } else {
        echo 'Could not prepare statement!';
    }

} else {
    echo "No user selected";
    die();
}

include('includes/footer.php');
?>