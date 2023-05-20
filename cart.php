<?php

include('includes/header.php');

if (isset($_GET["action"])){
   if ($_GET["action"] == "delete"){
       foreach ($_SESSION["cart"] as $keys => $value){
           if ($value["product_id"] == $_GET["id"]){
               unset($_SESSION["cart"][$keys]);
               setMessage("Produkt został usuniety z koszyka");
               echo("<meta http-equiv='refresh' content='1'>");
           }
       }
   }
}

  if (isset($_GET['clear_cart'])) {
    $_SESSION["cart"] = array(); var_dump($_SESSION["cart"]);
   header("Location: cart.php"); 
  }

?>    
   
<?php

getMessage();

?>
<h3 class="title2">Koszyk</h3>
    <main>
        <div class="table-responsive">
            <table class="table table-bordered">
            <tr>
                <th width="30%">Nazwa produktu</th>
                <th width="13%">Widok</th>
                <th width="10%">Ilość</th>    
                <th width="10%">Łączna kwota</th>
                <th width="17%">Usuń</th>
            </tr>

            <?php             
                if(!empty($_SESSION["cart"])){
                    $total = 0;
                    foreach ($_SESSION["cart"] as $key => $value) {
                        ?>
                        <tr>
                            <td><?php echo $value["item_name"]; ?></td>
                            <td><img src="./images/<?php echo $value['image']; ?>"></td>
                            <td><?php echo $value["item_quantity"]; ?></td>
                            <td>$ <?php echo $value["product_price"]; ?></td>
                            <td>
                                $ <?php echo number_format($value["item_quantity"] * $value["product_price"], 2); ?></td>
                            <td><a href="Cart.php?action=delete&id=<?php echo $value["product_id"]; ?>"><span
                                        class="text-danger">Usuń produkt</span></a></td>

                        </tr>
                        <?php
                        $total = $total + ($value["item_quantity"] * $value["product_price"]);
                    }
                        ?>
                        <tr>
                            <td colspan="3" align="right">Suma</td>
                            <th align="right"><?php echo number_format($total, 2); ?> zł</th>
                            <td></td>
                        </tr>
                        <?php
                    }
                ?>
            </table>
        </div>
    </main> 
        <div class="cart_clear">
                <a class=class="btn btn-primary" href='cart.php?clear_cart=true'>Wyczyść koszyk</a>      
        </div>           
<?php

include('includes/footer.php');

?>