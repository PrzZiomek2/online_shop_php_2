<?php

 include('includes/functions.php');
include('includes/config.php');

if(!isset($_SESSION["cart"])){
  $_SESSION["cart"] = array();
};

$totalCount = array_reduce( $_SESSION["cart"], function ($sum, $entry) {
  $sum += $entry["item_quantity"]; 
  return $sum;
}, 0);

$cartCountNumb = $totalCount ? "(" . $totalCount .")" : "";

 ?> 

<!DOCTYPE html>
<html>

<head>
	<title>Online Shop</title>
	<meta charset="utf-8"  />
   <meta http-equiv="X-UA-Compatibile" content="IE=edge">
   <meta name="viewport"content="width=device-width, initial-scale=1.0">

   <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    />
    <!-- Google Fonts Roboto -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"
    />

    <link rel="stylesheet" href="css/mdb.min.css" />
    <link rel="stylesheet" href="css/customs/main.css" />
    <link rel="stylesheet" href="css/customs/pages/products.css" />

    <style>
          #navbarNav{
          justify-content: flex-end;
        }

        .product{
          border: 1px solid #eaeaec;
          margin: 20px;  
          text-align: center;
          background-color: #b7b5b5;
          border-radius: 10px;
          padding-top: 20px;
          padding-bottom: 15px;
          width: 350px;
        }

        .product img,
        .productImg{
          vertical-align: middle;
            width: 100px;
            height: 200px;
            object-fit: contain;
        }

        .product h5{
            color: white;
            font-size: 1.45rem;
            margin-top: 20px;
            text-transform: capitalize;  
        }

        table, th, tr{
          text-align: center;
        }

        .pageTitle{
          text-align: center;
          color: #89939b;
          background-color: #efefef;
          padding: 1rem;
        }

        table th{
          background-color: #efefef;
          font-size: 1.2rem;
        }

        td{
          font-size: 1rem;
        }

      .shopContent{
          display: flex;
          flex-wrap: wrap;
      }

      .submitButton{
        margin: 10px 0;
        background-color: #877e7e;
        color: white;
        font-size: 0.8rem;
      }

      .submitButton:hover{
        background-color: #e2cece;
      }

      .productsAmount{
        margin: 10px auto 15px auto;
        width: 40%;
        padding: 0px 5px;
        border-radius: 5px;
      }

      .cartWrapper{
        margin: 40px;
      }

      .pageTable{
        border: 2px solid #b7b5b5;
      }

      tr, th, td{
        border: 2px solid #b7b5b5;
      }

      .table-bordered>:not(caption)>*>* {
          border-width: 2px;
      }

      .loginForm{
        border: 2px solid #b7b5b5;
        margin: 40px;
        padding: 40px;
        border-radius: 10px;
      }

      .loginForm .form-control{
        border: 1px solid #bdbdbd;
      }

      .loginTitle{
        text-align: center;
      }

      .loginSubmit{
        margin-top: 40px;
        font-size: 1rem;
      }

      .sessionMsg{
        text-align: center;
        color: white;
        margin: 1rem auto;
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        top: 0;
        background: #e56666;
        font-size: 1.2rem;
        width: 50%;
      }

      .sectionHeader{
        font-weight: 300;
        letter-spacing: 1px;
        text-align: center;
        margin-bottom: 30px;
        font-size: 3rem;
      }

       .sectionHeader-dashboard{
        margin-bottom: 0px;
        font-size: 1.5rem;
      }

      .sectionHeader-dashboard:hover,
      .addItem a:hover,
      .cart_clear a:hover{
        color: #7da6ec;
      }

      span.sectionHeader-dashboard{
        margin: 0 10px;
      }

      .Products_item_imgWrapper img{
        width: 100%;
        height: 100%;
      }

      .Products_item_imageCell{
        width: 135px;
      }

      .addItem,
      .cart_clear{
        margin: 40px auto;
      }

      .addItem a,
      .cart_clear a
      {
        font-size: 1.2rem;
      }

    </style>
</head>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Sklep Online</a>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/project_2/">Główna</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="cart.php"><?php echo "Koszyk" . $cartCountNumb; ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="dashboard.php">Panel</a>
        </li>
        <li class="nav-item">
          <?php 
            if(!isset($_SESSION['id'])){  
          ?>  
            <a class="nav-link" href="login.php">Zaloguj</a>
          <?php
            }else{
         ?>
            <a class="nav-link" href="logout.php">Wyloguj</a>
          <?php
            }
          ?>
          
        </li>
      </ul>
    </div>
  </div>
</nav>

<body>

<?php

getMessage();

 ?>