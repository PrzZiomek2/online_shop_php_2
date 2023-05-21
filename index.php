<?php 

include('includes/database.php');
include('includes/header.php');

  if (isset($_POST["hidden_name"]) && !empty($_POST["quantity"])){    

    if (in_array($_POST["id"], array_column($_SESSION["cart"],"product_id"))){
        setMessage("Produkt " . $_POST['hidden_name'] . " już jest w koszyku");
    }
    else{
        $count = count($_SESSION["cart"]);
        $cartItems = array(
           'product_id' => $_POST["id"],
           'image' => $_POST["image"],
           'item_name' => $_POST["hidden_name"],
           'product_price' => $_POST["hidden_price"],
           'item_quantity' => $_POST["quantity"],
        );
        array_push($_SESSION["cart"], $cartItems);
        setMessage("Produkt " . $_POST['hidden_name'] . " został dodany do koszyka");
        echo("<meta http-equiv='refresh' content='1'>");
    }

   }
?>
<?php

getMessage();

?>

<main>
    <h2 class="pageTitle">Oferta</h2>

   <div style="margin: 20px">
   <section class="shopContent"> 
      <?php
            if($stm = $connect->prepare('SELECT * FROM products')) {
               $stm->execute();
               $result = $stm->get_result();

                while ($row = mysqli_fetch_array($result)) {

                    ?>
                      <form method="post">

                            <div class="product">
                                <div class="img-responsive"><img src="./images/<?php echo $row['image']; ?>"></div>
                                <h5><?php echo $row["title"]; ?></h5>
                                <h5 class="text-danger"><?php echo $row["price"]; ?> zł</h5>
                                <input type="hidden" name="id" class="form-control" value="<?php echo $row["id"]; ?>">
                                <input type="hidden" name="image" class="form-control" value="<?php echo $row["image"]; ?>">
                                <input type="number" name="quantity" class="productsAmount" value="1">
                                <input type="hidden" name="hidden_name" value="<?php echo $row["title"]; ?>">
                                <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>">
                                <input type="submit" name="add" class="btn submitButton"value="Dodaj do koszyka">
                            </div>
                        </form>
                    <?php
                }
            }
        ?>
   </div>
        </section>
    
</main>

<?php

include('includes/footer.php');

?>    