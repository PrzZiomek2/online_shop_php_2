<?php

include('includes/database.php');
include('includes/header.php');

secure();

if (isset($_POST['title'])){
    $filename = $_FILES["image"]["name"];

    if(empty($_POST['title']) || empty($_POST['price']) || empty($filename)){
        setMessage("Wszystkie pola powinny być wypełnione");
    }
    else{
        if ($stm = $connect->prepare('INSERT INTO products (title, image, price) VALUES (?, ?, ?)')){
            $title_escape = mysqli_real_escape_string($connect, $_POST['title']);
            $price_escape = mysqli_real_escape_string($connect, $_POST['price']);
        
            $tempname = $_FILES["image"]["tmp_name"];
            $folder = "./images/" . $filename;
            move_uploaded_file($tempname, $folder);
    
            $stm->bind_param('sss', $title_escape, $filename, $price_escape);
            $stm->execute();
    
            setMessage("Produkt " . $title_escape . " został dodany");
            echo "<script type='text/javascript'>window.location.href='http://localhost/project_2/products.php'</script>"; 
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
        <h1 class="sectionHeader">Dodaj produkt</h1>
       
        <form method="post" enctype="multipart/form-data">
                <div class="form-outline mb-4">
                    <input type="text" id="title" name="title" class="form-control" />
                    <label class="form-label" for="title">Tytuł</label>
                </div>
                <!-- to do if enough time left  
                    <div class="form-outline mb-4">
                        <textarea name="content" id="content" ></textarea>
                    </div>
    
                        <div class="form-outline mb-4">
                            <input type="date" id="date" name="date" class="form-control" ?>" />
                            <label class="form-label" for="date">Date</label>
                        </div>
                -->
                <div>
                    <label class="image-label" for="image">Zdjęcie</label>
                    <div class="form-outline mb-4">
                        <input class="form-control" id="image" name="image" accept=".png, .jpg, .jpeg" type="file" name="uploadfile" />
                    </div>
                </div>
                <div class="form-outline mb-4">
                    <input type="number" id="price" name="price" class="form-control"" />
                    <label class="form-label" for="price">price</label>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Zapisz</button>
            </form>    
        </div>

    </div>
</div>
<?php
include('includes/footer.php');
?>