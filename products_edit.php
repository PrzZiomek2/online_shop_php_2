<?php

include('includes/database.php');

include('includes/header.php');
secure();

if (isset($_POST['title'])) {
    $filename = $_FILES["image"]["name"];

    if(empty($_POST['title']) || empty($_POST['price']) || empty($filename)){
        setMessage("Wszystkie pola powinny być wypełnione");
    }
    else{
        if ($stm = $connect->prepare('UPDATE products set title = ?, image = ?, price = ? WHERE id = ?')) {
            $stm->bind_param('sssi', $_POST['title'], $filename, $_POST['price'], $_GET['id']);
            $stm->execute();
    
            $stm->close();

            $tempname = $_FILES["image"]["tmp_name"]; var_dump($tempname);
            $folder = "./images/" . $filename;
            move_uploaded_file($tempname, $folder);

            setMessage("Produkt  " . $_GET['id'] . " został zaktualizowany");
            header('Location: products.php');
            die();
    
        } else {var_dump($_POST['price']);
            echo 'Could not prepare post update statement!';
        }
    }
}


if (isset($_GET['id'])) {

    if ($stm = $connect->prepare('SELECT * from products WHERE id = ?')) {
        $stm->bind_param('i', $_GET['id']);
        $stm->execute();

        $result = $stm->get_result();
        $product = $result->fetch_assoc();

        if ($product) {

            ?>
            <?php

            getMessage();

            ?>
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <h1 class="display-1">Edytuj produkt</h1>

                        <form method="post" enctype="multipart/form-data">
                            <div class="form-outline mb-4">
                                <input type="text" id="title" name="title" class="form-control"
                                    value="<?php echo $product['title'] ?>" />
                                <label class="form-label" for="title">Title</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input class="form-control" id="image" accept=".png, .jpg, .jpeg" name="image" type="file" name="uploadfile" value="<?php echo "./images/" . $product['image'] ?>" />
                                <label class="form-label" for="image">Zdjęcie</label>
                            </div>
                            <!--
                                <div class="form-outline mb-4">
                                    <input type="date" id="date" name="date" class="form-control" value="<?php echo $product['date'] ?>" />
                                    <label class="form-label" for="date">Date</label>
                                </div>
                            -->
                            <div class="form-outline mb-4">
                                <input type="number" id="price" name="price" class="form-control" value="<?php echo $product['price'] ?>" />
                                <label class="form-label" for="price">price</label>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Zapisz</button>
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