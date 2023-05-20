<?php

include('includes/database.php');
include('includes/header.php');

secure();

if (isset($_GET['delete'])){
    if ($stm = $connect->prepare('DELETE FROM products where id = ?')){
        $stm->bind_param('i',  $_GET['delete']);
        $stm->execute();
        

        setMessage("Produkt  " . $_GET['delete'] . " został usunięty");
        header('Location: products.php');
        $stm->close();
        die();

    } else {
        echo 'Could not prepare statement!';
    }

}

if ($stm = $connect->prepare('SELECT * FROM products')){
    $stm->execute();

    $result = $stm->get_result();
    
    if ($result->num_rows >0){

?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
        <h1 class="display-1">Zarządzanie produktami</h1>
        <table class="table table-striped table-hover">
         <tr>
            <th>ID</th>
            <th>Tytuł</th>
            <th>Treść</th>
            <th>Cena</th>
            <th>Zdjęcie</th>
            <th>Data dodania</th>
            <th>Akcje</th>
         </tr>

         <?php while($record = mysqli_fetch_assoc($result)){  ?>
        <tr>

        <td><?php echo $record['id']; ?> </td>
        <td><?php echo $record['title']; ?> </td>
        <td><?php echo $record['content']; ?> </td>
        <td><?php echo $record['price']; ?> zł</td>
        <td>
            <div class="Products_item_imgWrapper"><img src="./images/<?php echo $record['image']; ?>"></div>
        </td>
        <td><?php echo $record['added']; ?> </td>
        <td>
            <a href="products_edit.php?id=<?php echo $record['id']; ?>">Edytuj</a> | 
            <a href="products.php?delete=<?php echo $record['id']; ?>">Usuń</a></td>
        </tr>
        
        
        <?php } ?> 


        </table>

        <a href="products_add.php"> Dodaj nowy produkt</a>
       
        </div>

    </div>
</div>


<?php
   } else {
    echo 'Nie znaleziono produktów';

?>

    <div>
        <a href="products_add.php"> Dodaj produkt</a>
    </div>
    
<?php
   }

    
   $stm->close();

} else {
   echo 'Could not prepare statement!';
}
include('includes/footer.php');
?>